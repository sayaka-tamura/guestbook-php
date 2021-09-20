 <?php
 
  function checkInput($var){ 
    // 配列かどうかのチェック
    if(is_array($var)){
      //$var が配列の場合、checkInput()関数をそれぞれの要素について呼び出す
      return array_map('checkInput', $var);
    } else {
      //NULLバイト攻撃（文字コードの値が0の文字を使いプログラムを誤作動させる攻撃）対策
      if(preg_match('/\0/', $var)){  
        die('不正な入力です。'); // die(): メッセージを出力し、現在のスクリプトを終了する
      }

      //文字エンコードのチェック
      if(!mb_check_encoding($var, 'UTF-8')){ 
        die('不正な入力です。');
      }
      
      //改行以外の制御文字及び最大文字数のチェック
      if(preg_match('/\A[\r\n\t[:^cntrl:]]{0,100}\z/u', $var) === 0){  
        die('不正な入力です。最大文字数は100文字です。また、制御文字は使用できません。');
      }
      return $var;
    } 
  }


  //エスケープ処理の関数
  function h($str){
    if(is_array($str)){
      //$strが配列の場合、h()関数をそれぞれの要素について呼び出す
      return array_map('h', $str);    
    }else{
      return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
  }

  function errorCheck($var){
      //POSTされたデータを変数に格納
      //最初は入力データがないのでこの初期化をしないとエラーとなる
      $m_name = isset($_POST['m_name']) ? $_POST['m_name'] : NULL;
      $m_mail = isset($_POST['m_mail']) ? $_POST['m_mail'] : NULL;
      $m_message = isset($_POST['m_message']) ? $_POST['m_message'] : NULL;

      //POSTされたデータを整形（前後にあるホワイトスペースを削除）してエスケープ処理
      $m_name = h(trim($m_name));
      $m_mail = h(trim($m_mail));
      $m_message = h(trim($m_message));

      $temp_array = array("m_name" => $m_name, "m_mail" => $m_mail, "m_message" => $m_message);

      $_SESSION["m_name"] = $m_name;
      $_SESSION["m_mail"] = $m_mail;
      $_SESSION["m_message"] = $m_message;

      $error = array();

      if($m_name == '') {
        $error[] = '*お名前は必須です。';
      } elseif (preg_match('/\A[[:^cntrl:]]{1,30}\z/u', $m_name) == 0) {   //制御文字でないことと文字数をチェック
        $error[] = '*お名前は30文字以内でお願いします。';
      }

      if($m_mail == ''){
        $error[] = '*E-mail アドレスは必須です。';
      } else {   //メールアドレスを正規表現でチェック
        $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
        if(!preg_match($pattern, $m_mail)){
          $error[] = '*メールアドレスの形式が正しくありません。';
        }
      }

      if($m_message == '') {
        $error[] = '*メッセージは必須です。';
      }elseif(preg_match('/\A[\r\n[:^cntrl:]]{1,100}\z/u', $m_message) == 0) {   //制御文字（改行を除く）でないことと文字数をチェック
        $error[] = '*メッセージは100文字以内でお願いします。';
      }

      if(isset($_POST['m_name']) && isset($_POST['m_mail']) && isset($_POST['m_message'])) {
        if(count($error) > 0){ 
          echo '<p style="color:red;">以下のエラーがあります。</p><p style="color:red;">';
          foreach($error as $value) {
            echo $value . "<br>";
          }
          echo '</p>';
        }
      }

      return $temp_array;
  }

?>
<?php
  if(empty($_POST)){
    echo "Ended this process";
    exit;
  }
  // Session Start
  session_start();
  
  // var_dump($_SESSION);
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Guset Book</title>
  </head>
  <body>
    <h1>Guset Book_3.Submit</h1>
        <!-- 処理結果を表示 -->

    <?php
      // Sanitize
      function h($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
      }

      $uname = $_SESSION["uname"];
      $email = $_SESSION["email"];
      $message = $_SESSION["message"];

      $uname = h($uname);
      $email = h($email);
      $message = h($message);

      // var_dump($uname);
      // var_dump($email);
      // var_dump($message);

      // メール本文の組み立て
      $to = "bbb@gmail.com";
      $title = "■ From Mail Foam";
      $ext_header = "From:{$email}";

      // 本文を組み立てるヒヤドキュメント
      $body = <<<EOM
      ----------------------------------------------
      【Mail from website】

      Name: {$uname}
      Mail Address: {$email}
      Message: {$message}
      ----------------------------------------------
      EOM;

      // メール送信の実行
      $rc = mb_send_mail($to, $title, $body, $ext_header);
      
      if(!$rc){
        echo "This mail has not been sent because of something wrong";
        exit;
      } else {
        echo "Hello";
        $_SESSION = NULL;
      }
    ?>
    
    <p>Mail has sent</p>
    <table border="1">
      <tr>
        <td>Name</td>
        <td　width="300"><?php echo $uname; ?></td>
      </tr>
      <tr>
        <td>Email Address</td>
        <td　width="300"<?php echo $email; ?></td>
      </tr>
      <tr>
        <td>Message</td>
        <td　width="300"><?php echo nl2br($message); ?></td>
      </tr>
    </table>
  </body>
</html>
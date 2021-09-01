<?php
  // Session Start
  session_start();

  // 変更内容の取得・検証・加工
  $m_name = chkString($_POST["m_name"], "Name");
  $m_mail = chkString($_POST["m_mail"], "E-mail address", true); // ture -> check 省略
  $m_message = chkString($_POST["m_message"], "Message");
  
  // 変更内容をセッション変数に格納
  $_SESSION["m_name"] = $m_name;
  $_SESSION["m_mail"] = $m_mail;
  $_SESSION["m_message"] = $m_message;

  // 入力値の検証・加工
  function chkString($temp="", $field, $accept_empty=false){
    // 未入力チェック
    if(empty($temp) AND !$accept_empty){
      echo $field. " には何か入力してください。";
      exit;
    }

    // 入力内容を安全な値に
    $temp = htmlspecialchars($temp, ENT_QUOTES, "UTF-8");
    
    // 加工後の文字列を返す
    return $temp;
  }
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Guset Book</title>
  </head>

  <body>
    <p>Confirmation for Update Page</p>
    <form method="post" action="update-submit.php">
      <table border="1">
        <tr>
          <td>Name</td>
          <td><?php echo $m_name; ?></td>
        </tr>
        <tr>
          <td>Email Address</td>
          <td><?php echo $m_mail; ?></td>
        </tr>
        <tr>
          <td>Message</td>
          <td><?php echo nl2br($m_message); ?></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" value="Update">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
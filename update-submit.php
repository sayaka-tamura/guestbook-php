<?php
  // Session Start
  session_start();
  if(empty($_SESSION)){
    echo "Ended this process";
    exit;
  }
  // 接続設定
  $dbtype = "mysql";
  $sv = "localhost";
  $dbname = "guestbook";
  $user = "root";
  $pass = "password";

  // DB に接続
  $dsn = "$dbtype:dbname=$dbname;host=$sv";
  $conn = new PDO($dsn, $user, $pass);

  // 変更内容の取得（変更データの主キーも含む）
  $m_id = $_SESSION["m_id"];
  $m_name = htmlspecialchars($_SESSION["m_name"],ENT_QUOTES,"UTF-8");
  $m_mail = htmlspecialchars($_SESSION["m_mail"],ENT_QUOTES,"UTF-8");
  $m_message = htmlspecialchars($_SESSION["m_message"],ENT_QUOTES,"UTF-8");
  
  // データの追加
  $sql = "UPDATE message SET m_name=:m_name, m_mail=:m_mail, m_message=:m_message, m_dt=NOW() WHERE m_id=:m_id";
  $stmt = $conn->prepare($sql);
  $stmt -> bindParam(":m_id", $m_id);
  $stmt -> bindParam(":m_name",$m_name);
  $stmt -> bindParam(":m_mail",$m_mail);
  $stmt -> bindParam(":m_message",$m_message);
  $stmt -> execute();

  // エラーチェック
  $error = $stmt->errorInfo();
  if($error[0] != "00000"){
    $message = "データの変更に失敗しました。{$error[2]}";
  } else {
    $message = "データを変更しました。";
  }

  // セッションデータの破棄
  $_SESSION = array();
  session_destroy();
?>

<!-- 処理結果の表示 -->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Guset Book</title>
  </head>
  <body>
    <p>Update Completion Page</p>
    <p><?php echo $message; ?></p>
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
    </table>
    <p><a href="index.php">To Top Page</a></p>
  </body>
</html>
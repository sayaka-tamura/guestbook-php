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

  // 入力内容の取得（$_SESSION から）
  $m_name = htmlspecialchars($_SESSION["m_name"],ENT_QUOTES,"UTF-8");
  $m_mail = htmlspecialchars($_SESSION["m_mail"],ENT_QUOTES,"UTF-8");
  $m_message = htmlspecialchars($_SESSION["m_message"],ENT_QUOTES,"UTF-8");
  
  // データの追加
  $sql = "INSERT INTO message (m_name, m_mail, m_message, m_dt) VALUES (:m_name, :m_mail, :m_message, NOW())";
  $stmt = $conn->prepare($sql);
  $stmt ->bindParam(":m_name",$m_name);
  $stmt ->bindParam(":m_mail",$m_mail);
  $stmt ->bindParam(":m_message",$m_message);
  $stmt -> execute();

  // エラーチェック
  $error = $stmt->errorInfo();
  if($error[0] != "00000"){
    $message = "データの追加に失敗しました。{$error[2]}";
  } else {
    $message = "データを追加しました。データ番号：" . $conn->lastInsertId();
  }

  // セッションデータの破棄
  $_SESSION = array();
  session_destroy();
  // var_dump($_SESSION);
?>

<!-- 処理結果の表示 -->
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Guset Book</title>
  </head>
  <body>
    <h1>Guset Book_3.Submit</h1>
        <!-- 処理結果を表示 -->

    <p>Additional Completion Page</p>
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
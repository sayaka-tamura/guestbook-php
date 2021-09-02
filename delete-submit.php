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

  // 削除データの主キーを取得
  $m_id = $_SESSION["m_id"];
  
  // データを削除
  $sql = "DELETE FROM message WHERE (m_id=:m_id);";
  $stmt = $conn->prepare($sql);
  $stmt -> bindParam(":m_id", $m_id);
  $stmt -> execute();

  // エラーチェック
  $error = $stmt->errorInfo();
  if($error[0] != "00000"){
    $message = "データの削除に失敗しました。{$error[2]}";
  } else {
    $message = "データを削除しました。";
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
    <p>Delete Completion Page</p>
    <p><?php echo $message; ?></p>
    <p><a href="index.php">To Top Page</a></p>
  </body>
</html>
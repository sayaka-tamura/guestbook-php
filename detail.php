<?php
  // 表示するデータの主キーを取得
  if(!isset($_GET["m_id"])){
    exit;
  } else {
    $m_id = $_GET["m_id"];
  }

  // 接続設定
  $dbtype = "mysql";
  $sv = "localhost";
  $dbname = "guestbook";
  $user = "root";
  $pass = "password";

  // DB 接続
  $dsn = "$dbtype:dbname=$dbname;host=$sv";
  $conn = new PDO($dsn, $user, $pass);

  // データの取得（1件のみ）
  $sql = "SELECT * FROM message WHERE (m_id = :m_id);";
  $stmt = $conn->prepare($sql);
  $stmt -> bindParam(":m_id", $m_id);
  $stmt -> execute();
  $row = $stmt->fetch();
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Guset Book</title>
  </head>

  <body>
    <p>Detail information Page</p>
      <table border="1">
        <tr>
          <td>Name</td>
          <td><?php echo $row["m_name"]; ?></td>
        </tr>
        <tr>
          <td>Email Address</td>
          <td><?php echo $row["m_mail"]; ?></td>
        </tr>
        <tr>
          <td>Message</td>
          <td><?php echo nl2br($row["m_message"]); ?></td>
        </tr>
      </table>
  </body>
</html>
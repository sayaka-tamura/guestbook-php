<?php
  // Session Start
  session_start();
  
  // 表示するデータの主キーを取得
  if(!isset($_GET["m_id"])){
    exit;
  } else {
    $m_id = $_GET["m_id"];
    $_SESSION["m_id"] = $m_id;  //主キーを$_SESSIONに格納
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

  // 変更するデータの取得
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
    <p>Update Information Page</p>
    <form  method="POST" action="update-confirm.php">
      <table border="1">
        <tr>
          <td>Name</td>
          <td><input type="text" name="m_name" size="30" value="<?php echo $row["m_name"]; ?>"></td>
        </tr>
        <tr>
          <td>Email Address</td>
          <td><input type="text" name="m_mail" size="30" value="<?php echo $row["m_mail"]; ?>"></td>
        </tr>
        <tr>
          <td>Message</td>
          <td><textarea cols="30" rows="5" name="m_message"><?php echo $row["m_message"]; ?></textarea></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" name="sub1" value="Confirm">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
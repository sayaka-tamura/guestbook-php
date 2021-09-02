<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Required meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <title>Guset Book</title>
</head>

<body>
  <h1>Guset Book</h1>
  <form method="post" action="confirm.php">
    <table border="1">
      <tr>
        <td>Name</td>
        <td><input type="text" name="m_name" size="30"></td>
      </tr>
      <tr>
        <td>Email Address</td>
        <td><input type="text" name="m_mail" size="30"></td>
      </tr>
      <tr>
        <td>Message</td>
        <td>
          <textarea name="m_message" cols="30" rows="5"></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" name="sub1" value="Confirm">
        </td>
      </tr>
    </table>
  </form>
  <?php
  // 接続設定
  $dbtype = "mysql";
  $sv = "localhost";
  $dbname = "guestbook";
  $user = "root";
  $pass = "password";

  // DB 接続
  $dsn = "$dbtype:dbname=$dbname;host=$sv";
  $conn = new PDO($dsn, $user, $pass);

  // データの取得
  $sql = "SELECT * FROM message ORDER BY m_id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // 取得したデータを一覧表示
  while ($row = $stmt->fetch()) {
    // ID出力
    echo "<hr>{$row["m_id"]}:" . "&nbsp;&nbsp;";
    if (!empty($row["m_mail"])) {
      // e-mail が入力されていたら、mailTo のリンク生成
      echo "<a href=\"mailto:" . $row["m_mail"] . "\">" . $row["m_name"] . "</a>&nbsp;&nbsp;";
    } else {
      // そうでなければ名前出力
      echo $row["m_name"] . "&nbsp;&nbsp;";
    }
    // 日付とメッセージ出力
    echo "(" . date("Y/m/d H:i", strtotime($row["m_dt"])) . ")";
    echo "<p>" . nl2br($row["m_message"]) . "</p>";

    // 変更・削除・詳細表示画面へのリンク
    echo "<a href=\"update.php?m_id=" . $row["m_id"] . "\">Update</a>" . "&nbsp;&nbsp;";
    echo "<a href=\"delete-confirm.php?m_id=" . $row["m_id"] . "\">Delete</a>" . "&nbsp;&nbsp;";
    echo "<a href=\"detail.php?m_id=" . $row["m_id"] . "\">Detail</a>";
  }
  ?>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
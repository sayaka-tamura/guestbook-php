<?php
// Session Start
session_start();
if (empty($_SESSION)) {
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
try {
  $dsn = "$dbtype:dbname=$dbname;host=$sv";
  $conn = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
  print "Connection Error: {$e->getMessage()}";
  exit;
}

// 入力内容の取得（$_SESSION から）
$m_name = htmlspecialchars($_SESSION["m_name"], ENT_QUOTES, "UTF-8");
$m_mail = htmlspecialchars($_SESSION["m_mail"], ENT_QUOTES, "UTF-8");
$m_message = htmlspecialchars($_SESSION["m_message"], ENT_QUOTES, "UTF-8");

// データの追加
$sql = "INSERT INTO message (m_name, m_mail, m_message, m_dt) VALUES (:m_name, :m_mail, :m_message, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":m_name", $m_name);
$stmt->bindParam(":m_mail", $m_mail);
$stmt->bindParam(":m_message", $m_message);
$stmt->execute();

// エラーチェック
$error = $stmt->errorInfo();
if ($error[0] != "00000") {
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
  <!-- Required meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <title>Guset Book</title>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="css/cover.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark">
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

    <header>
      <div>
        <h3 class="float-md-start mb-0"><a href="index.php">Guest Book</a></h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
          <a class="nav-link" href="#">Feature</a>
          <a class="nav-link" href="#">Contact</a>
        </nav>
      </div>
    </header>

    <main class="px-3 my-5">
      <p>Message Completion Page</p>
      <div class="form-group">
        <!-- 処理結果を表示 -->
        <p><?php echo $message; ?></p>
        <table class=" mx-auto mx-auto my-3 col-6">
          <tr class="my-2">
            <td class="my-1">Name</td>
            <td><?php echo $m_name; ?></td>
          </tr>
          <tr class="my-2">
            <td class="my-1">Email Address</td>
            <td><?php echo $m_mail; ?></td>
          </tr>
          <tr class="my-2">
            <td class="my-1">Message</td>
            <td><?php echo nl2br($m_message); ?></td>
          </tr>
          <td colspan="2">
            <input type="button" class="form-control mt-3 btn btn-info" value="To Top Page" onClick="location.href='index.php'">
          </td>
        </table>
      </div>
    </main>
    <footer class="my-5 text-white-50">
      <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
    </footer>

  </div>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
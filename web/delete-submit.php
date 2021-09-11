<?php
  // Session Start
  session_start();
  if (empty($_SESSION)) {
    echo "Ended this process";
    exit;
  }

  require("template/dbconnect.php");

  //DB接続関数を dbconnet.php から呼び出して接続
  $db = dbConnect();

  // 削除データの主キーを取得
  $m_id = $_SESSION["m_id"];

  // データを削除
  $sql = "DELETE FROM message WHERE (m_id=:m_id);";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(":m_id", $m_id);
  $stmt->execute();

  // エラーチェック
  $error = $stmt->errorInfo();
  if ($error[0] != "00000") {
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
        <p>Delete Completion Page</p>
        <p><?php echo $message; ?></p>
        <p class="mx-auto col-4">
          <input type="button" class="form-control mt-3 btn btn-info" value="To Top Page" onclick="location.href='index.php'">
        </p>
      </main>
      <footer class="my-5 text-white-50">
        <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
      </footer>
    </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>

</html>
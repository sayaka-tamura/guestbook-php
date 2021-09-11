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
  function chkString($temp = "", $field, $accept_empty = false)
  {
    // 未入力チェック
    if (empty($temp) and !$accept_empty) {
      echo $field . " には何か入力してください。";
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
      <p>Confirmation for Update Page</p>
      <form method="post" action="update-submit.php">
        <div class="form-group">
          <table class=" mx-auto mx-auto my-4 col-6">
            <tr class="my-2">
              <td class="my-1">Name</td>
              <td><?php echo $m_name; ?></td>
            </tr>
            <tr class="my-2">
              <td class="my-1">Email Address</td>
              <td><?php echo $m_mail; ?></td>
            </tr>
            <tr>
              <td class="my-1">Message</td>
              <td><?php echo nl2br($m_message); ?></td>
            </tr>
            <tr class="my-2">
              <td colspan="2">
                <input type="submit" class="form-control mt-3 btn btn-info" value="Update">
                <input type="button" class="form-control mt-3 btn btn-info" value="Go Back" onclick="location.href='index.php'">
              </td>
            </tr>
          </table>
      </form>
    </main>
    <footer class="my-5 text-white-50">
      <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
    </footer>
  </div>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>
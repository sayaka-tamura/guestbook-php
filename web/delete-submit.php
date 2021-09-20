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

  require("template/functions.php");
  
  // CRUD methods (DELETE)
  $message = deleteMsg($db, $m_id);

  // セッションデータの破棄
  $_SESSION = array();
  session_destroy();
?>

<!-- 処理結果の表示 -->
<html>

<?php require("template/head.php"); ?>

<?php require("template/header.php"); ?>

<main class="px-3 my-5">
  <p>Delete Completion Page</p>
  <p><?php echo $message; ?></p>
  <p class="mx-auto col-4">
    <input type="button" class="form-control mt-3 btn btn-info" value="To Top Page" onclick="location.href='index.php'">
  </p>
</main>

<?php require("template/footer.php"); ?>
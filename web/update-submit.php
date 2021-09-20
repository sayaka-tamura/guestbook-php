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

  // 変更内容の取得（変更データの主キーも含む）
  $m_id = $_SESSION["m_id"];
  $m_name = htmlspecialchars($_SESSION["m_name"], ENT_QUOTES, "UTF-8");
  $m_mail = htmlspecialchars($_SESSION["m_mail"], ENT_QUOTES, "UTF-8");
  $m_message = htmlspecialchars($_SESSION["m_message"], ENT_QUOTES, "UTF-8");

  require("template/functions.php");
  $message = updateMsg($db, $m_id, $m_name, $m_mail, $m_message);

  /*
  // データの追加
  $sql = "UPDATE message SET m_name=:m_name, m_mail=:m_mail, m_message=:m_message, m_dt=NOW() WHERE m_id=:m_id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(":m_id", $m_id);
  $stmt->bindParam(":m_name", $m_name);
  $stmt->bindParam(":m_mail", $m_mail);
  $stmt->bindParam(":m_message", $m_message);
  $stmt->execute();

  // エラーチェック
  $error = $stmt->errorInfo();
  if ($error[0] != "00000") {
    $message = "データの追加に失敗しました。{$error[2]}";
  } else {
    $message = "データを変更しました。";
  }
  */
  
  // セッションデータの破棄
  $_SESSION = array();
  session_destroy();
?>

<!-- 処理結果の表示 -->

<?php require("template/head.php"); ?>

<?php require("template/header.php"); ?>

<main class="px-3 my-5">
  <p>Update Completion Page</p>
    <div class="form-group">
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

<?php require("template/footer.php"); ?>
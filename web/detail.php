<?php
  // 表示するデータの主キーを取得
  if (!isset($_GET["m_id"])) {
    exit;
  } else {
    $m_id = $_GET["m_id"];
  }

  require("template/dbconnect.php");

  //DB接続関数を dbconnet.php から呼び出して接続
  $db = dbConnect();

  // Importing info for "Go Back Button"
  require("template/functions.php");
  list($h, $r) = severInfo();

  // データの取得（1件のみ）
  $sql = "SELECT * FROM message WHERE (m_id = :m_id);";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(":m_id", $m_id);
  $stmt->execute();
  $row = $stmt->fetch();
?>

<?php require("template/head.php"); ?>

<?php require("template/header.php"); ?>

<main class="px-3 my-5">
  <p>Detail information Page</p>
  <table class=" mx-auto mx-auto my-4 col-6">
      <tr class="my-2">
        <td class="my-1">Name</td>
        <td><?php echo $row["m_name"]; ?></td>
      </tr>
      <tr class="my-2">
        <td class="my-1">Email Address</td>
        <td><?php echo $row["m_mail"]; ?></td>
      </tr>
      <tr class="my-2">
        <td class="my-1">Message</td>
        <td><?php echo nl2br($row["m_message"]); ?></td>
      </tr>
      <td colspan="2">
        <input type="button" class="form-control mt-3 btn btn-info" value="Go Back" onclick="location.href='<?= $r ?>'">
      </td>
    </table>
</main>

<?php require("template/footer.php"); ?>
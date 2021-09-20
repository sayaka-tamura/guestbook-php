<?php

  require("template/functions.php");
  // 表示するデータの主キーを取得
  $m_id = getPrimaryKey();

  require("template/dbconnect.php");

  //DB接続関数を dbconnet.php から呼び出して接続
  $db = dbConnect();

  //任意の Primary Key に応じたメッセージ内容を表示
  $row = selectMsgOne($db, $m_id);

  // Importing info for "Go Back Button"
  list($h, $r) = severInfo();

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
        <?php
          if (!empty($r) && (strpos($r, $h) !== false)) : // strpos()-> 特定の文字列を含むかをチェック方法
        ?>
          <input type="button" class="form-control mt-3 btn btn-info" value="Go Back" onclick="location.href='<?= $r ?>'">
        <?php endif ?>
      </td>
    </table>
</main>

<?php require("template/footer.php"); ?>
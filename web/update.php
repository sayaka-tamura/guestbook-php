<?php
  // Session Start
  session_start();

  require("template/functions.php");
  
  // 表示するデータの主キーを取得
  $m_id = getPrimaryKey();

  //主キーを$_SESSIONに格納
  $_SESSION["m_id"] = $m_id;  

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
  <p>Update Information Page</p>
  <div class="form-group">
  <form method="POST" action="update-confirm.php">
      <table class=" mx-auto mx-auto my-4 col-6">
        <tr class="my-2">
          <td class="my-1">Name</td>
          <td><input type="text" class="form-control" name="m_name" value="<?php echo $row["m_name"]; ?>"></td>
        </tr>
        <tr class="my-2">
          <td class="my-1">Email Address</td>
          <td><input type="text" class="form-control" name="m_mail" value="<?php echo $row["m_mail"]; ?>"></td>
        </tr>
        <tr class="my-2">
          <td class="my-1">Message</td>
          <td><textarea rows="5" class="form-control" name="m_message"><?php echo $row["m_message"]; ?></textarea></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" class="form-control mt-3 btn btn-info" name="sub1" value="Confirm">
            
            <?php
              if (!empty($r) && (strpos($r, $h) !== false)) : // strpos()-> 特定の文字列を含むかをチェック方法
            ?>
              <input type="button" class="form-control mt-3 btn btn-info" value="Go Back" onclick="location.href='<?= $r ?>'">
            <?php endif ?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</main>

<?php require("template/footer.php"); ?>
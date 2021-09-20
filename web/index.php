<?php require("template/head.php"); ?>

<?php require("template/header.php"); ?>

<main class="px-3">
  <form method="post" action="confirm.php">
    <div class="form-group">
    <table class=" mx-auto mx-auto my-4 col-6">
      <tr>
        <td class="my-1">Name</td>
        <td><input type="text" class="form-control" name="m_name"></td>
      </tr>
      <tr>
        <td class="my-1">Email Address</td>
        <td><input type="text" class="form-control" name="m_mail"></td>
      </tr>
      <tr>
        <td class="my-1">Message</td>
        <td>
          <textarea name="m_message" class="form-control" rows="5"></textarea>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" class="form-control mt-3 btn btn-info" name="sub1" value="Confirm">
        </td>
      </tr>
    </table>
    </div>
  </form>

  <?php

    require("template/dbconnect.php");
    
    //DB接続関数を dbconnet.php から呼び出して接続
    $db = dbConnect();
    
    $sql = 'SELECT * FROM message';
    $stmt = $db->prepare($sql);
    $stmt->execute();

    while($row = $stmt->fetch()){
      // ID出力
      echo "<hr>".$row['m_id'].": &nbsp;&nbsp;";
      
      if(!empty($row["m_mail"])){
        // e-mail が入力されていたら、mailTo のリンク生成
        echo '<a class="text-info" href="mailto:'.$row['m_mail'].'">'.$row['m_name'].'</a>&nbsp;&nbsp;';
      } else{
        // そうでなければ名前出力
        echo $row["m_name"] . "&nbsp;&nbsp;";
      }        

    // 日付とメッセージ出力
    echo "(" . date("Y/m/d H:i", strtotime($row["m_dt"])) . ")";
    echo "<p>" . nl2br($row["m_message"]) . "</p>";

    // 変更・削除・詳細表示画面へのリンク
    echo "<button class='btn btn-light'><a class='link-dark' href=\"update.php?m_id=" . $row["m_id"] . "\">Update</a></button>" . "&nbsp;&nbsp;";
    echo "<button class='btn btn-light'><a class='link-dark' href=\"delete-confirm.php?m_id=" . $row["m_id"] . "\">Delete</a></button>" . "&nbsp;&nbsp;";
    echo "<button class='btn btn-light'><a class='link-dark' href=\"detail.php?m_id=" . $row["m_id"] . "\">Detail</a></button>";
  }

  ?>

</main>

<?php require("template/footer.php"); ?>
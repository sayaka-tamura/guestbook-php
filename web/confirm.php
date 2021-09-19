<?php
  // Session Start
  session_start();

  require("template/functions.php");

  list($h, $r) = severInfo();
  var_dump($h);
  var_dump($r);

  // 入力値の取得・検証・加工
  $m_name = chkString($_POST["m_name"], "Name");
  $m_mail = chkString($_POST["m_mail"], "E-mail address", true); // true -> check 省略
  $m_message = chkString($_POST["m_message"], "Message");

  // 入力値をセッション変数に格納
  $_SESSION["m_name"] = $m_name;
  $_SESSION["m_mail"] = $m_mail;
  $_SESSION["m_message"] = $m_message;

  // 入力値の検証・加工
  function chkString($temp = "", $field, $accept_empty = false)
  {
    // 未入力チェック
    if (empty($temp) and !$accept_empty) {
      require("alert.php");
      exit;
    }

    // 入力内容を安全な値に
    $temp = htmlspecialchars($temp, ENT_QUOTES, "UTF-8");

    // 戻り値
    return $temp;
  }

?>

<?php require("template/head.php"); ?>

<?php require("template/header.php"); ?>

<main class="px-3 my-5">
<p>Message Confirmation Page</p>
  <form method="post" action="submit.php">
    <div class="form-group">
      <table class=" mx-auto mx-auto my-4 col-6">
        <tr class="my-2">
          <td class="my-1">Name : </td>
          <td><?php echo $m_name; ?></td>
        </tr>
        <tr class="my-2">
          <td class="my-1">Email Address : </td>
          <td><?php echo $m_mail; ?></td>
        </tr>
        <tr class="my-2">
          <td class="my-1">Message : </td>
          <td><?php echo nl2br($m_message); ?></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" class="form-control mt-3 btn btn-info" value="Submit">

            <?php
              if (!empty($r) && (strpos($r, $h) !== false)) : // strpos()-> 特定の文字列を含むかをチェック方法
            ?>
              <input type="button" class="form-control mt-3 btn btn-info" value="Go Back" onclick="location.href='<?= $severInfo["r"] ?>'">
            <?php endif ?>
          </td>
        </tr>
      </table>
    </div>
  </form>
</main>

<?php require("template/footer.php"); ?>
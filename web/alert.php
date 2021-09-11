<?php require("template/head.php"); ?>

<?php require("template/header.php"); ?>

<main class="px-3 my-5">
  <p>Error page</p>
  <div class="my-5"><?php  echo "{$field}には何か入力してください";  ?></div>
  <p class="mx-auto col-4">
    <input type="button" class="form-control mt-3 btn btn-info" value="Go Back" onclick="location.href='index.php'">
  </p>
</main>

<?php require("template/footer.php"); ?>
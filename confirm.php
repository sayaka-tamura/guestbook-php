<?php
  if(empty($_POST)){
    echo "Ended this process";
    exit;
  }
  // Session Start
  session_start();

?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Guset Book</title>
  </head>

  <body>
    <h1>Guset Book_2.Confirm</h1>
    <p>Please Check Input Contents</p>
    <?php
      if(empty($_POST["uname"])){
        echo "Please type your name";
        exit;
      }
      if(empty($_POST["email"])){
        echo "Please type your email";
        exit;
      }
      if(empty($_POST["message"])){
        echo "Please type your message";
        exit;
      }

      function h($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
      }

      $uname = $_POST["uname"];
      $email = $_POST["email"];
      $message = $_POST["message"];

      // Email address validation
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "This is not email.";
        $email=null;
        exit;
      }
      
      $uname = h($uname);
      $email = h($email);
      $message = h($message);

      $_SESSION["uname"] = $uname;
      $_SESSION["email"] = $email;
      $_SESSION["message"] = $message;

      // var_dump($_SESSION);
    ?>
    
    <form method="post" action="submit.php">
      <table border="1">
        <tr>
          <td>Name</td>
          <td width="300"><?php echo $uname; ?></td>
        </tr>
        <tr>
          <td>Email Address</td>
          <td width="300"><?php echo $email; ?></td>
        </tr>
        <tr>
          <td>Message</td>
          <td width="300"><?php echo nl2br($message); ?></td>
        </tr>
        <tr>
          <td align="right" colspan="2">
            <input type="submit" name="sub1" value="Submit">
          </td>
        </tr>
      </table>
      <!-- hidden field -> Deleted -->
    </form>
  </body>
</html>
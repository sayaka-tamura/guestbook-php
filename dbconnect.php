<?php
  <!-- For localhost -->
  <!-- // 接続設定
  $dbtype = "mysql";
  $sv = "localhost";
  $dbname = "guestbook";
  $user = "root";
  $pass = "password";

  // DB 接続
  $dsn = "$dbtype:dbname=$dbname;host=$sv";
  $conn = new PDO($dsn, $user, $pass);

  return $conn; -->

  function dbConnect(){
    $db = parse_url($_SERVER['mysql://b741e354dd7070:4f8b9150@us-cdbr-east-04.cleardb.com/heroku_f3df070baf09f68?reconnect=true']);
    $db['guestbook'] = ltrim($db['path'], '/');
    $dsn = "mysql:host={$db['us-cdbr-east-04.cleardb.com']};dbname={$db['guestbook']};charset=utf8";
    $user = $db['root'];
    $password = $db['password'];
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
    );
    $dbh = new PDO($dsn,$user,$password,$options);
    return $dbh;
  }

  //DB接続関数を呼び出して接続
  $dbh = dbConnect();
?>
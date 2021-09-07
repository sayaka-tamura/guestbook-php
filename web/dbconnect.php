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
    $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
    $db['dbname'] = ltrim($db['path'], '/');
    $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
    
    $conn = new PDO($dsn, $db['user'], $db['pass']);
    return $conn;
  }

  //DB接続関数を呼び出して接続
  $conn = dbConnect();

  function h($var)
  {
      if (is_array($var)) {
          return array_map('h', $var);
      } else {
          return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
      }
  }
?>
<?php
  // 接続設定
  $dbtype = "mysql";
  $sv = "localhost";
  $dbname = "guestbook";
  $user = "root";
  $pass = "password";

  // DB 接続
  $dsn = "$dbtype:dbname=$dbname;host=$sv";
  $conn = new PDO($dsn, $user, $pass);

  return $conn;
  
  <!-- $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  $server = $url["localhost"];
  $username = $url["root"];
  $password = $url["password"];
  $db = substr($url["guestbook"], 1);

  $pdo = new PDO(
    'mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8mb4',
    $username,
    $password,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    ] -->
?>
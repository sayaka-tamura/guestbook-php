<?php

  //function dbConnect(){
    $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
    $db['dbname'] = ltrim($db['path'], '/');
    $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
    );

    try {
        $db = new PDO($dsn, $db['user'], $db['pass'], $options);
        return $db;
    } catch (PDOException $e) {
        echo 'Error: ' . h($e->getMessage());
    }
  //}

  function h($var)
  {
      if (is_array($var)) {
          return array_map('h', $var);
      } else {
          return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
      }
  }

  //DB接続関数を呼び出して接続
  //$db = dbConnect();
  
?>
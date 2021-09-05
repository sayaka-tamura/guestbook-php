<?php

$db = parse_url($_SERVER['mysql://b741e354dd7070:4f8b9150@us-cdbr-east-04.cleardb.com/heroku_f3df070baf09f68?reconnect=true']);
$db['heroku_f3df070baf09f68'] = ltrim($db['path'], '/');
$dsn = "mysql:host={$db['us-cdbr-east-04.cleardb.com']};dbname={$db['heroku_f3df070baf09f68']};charset=utf8";

try {
    $db = new PDO($dsn, $db['b741e354dd7070'], $db['password']);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM user';
    $prepare = $db->prepare($sql);
    $prepare->execute();

    echo '<pre>';
    $prepare->execute();
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    print_r(h($result));
    echo "\n";
    echo '</pre>';
} catch (PDOException $e) {
    echo 'Error: ' . h($e->getMessage());
}

function h($var)
{
    if (is_array($var)) {
        return array_map('h', $var);
    } else {
        return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
    }
}
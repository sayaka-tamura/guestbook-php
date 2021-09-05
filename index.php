<?php
    <!-- require('dbconnect.php'); -->
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


    $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
    $db['dbname'] = ltrim($db['path'], '/');
    $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
    
    try {
        $db = new PDO($dsn, $db['user'], $db['pass']);
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
    
    <!-- // 取得したデータを一覧表示
    while ($row = $stmt->fetch()) {
    // ID出力
    echo "<hr>{$row["m_id"]}:" . "&nbsp;&nbsp;";
    if (!empty($row["m_mail"])) {
        // e-mail が入力されていたら、mailTo のリンク生成
        echo "<a class='text-info' href=\"mailto:" . $row["m_mail"] . "\">" . $row["m_name"] . "</a>&nbsp;&nbsp;";
    } else {
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
    } -->
?>


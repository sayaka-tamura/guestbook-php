<?php

try{
	// 接続
	$db = new PDO('mysql:host=localhost;dbname=guestbook', 'root', 'passward');
	echo 'データベース接続成功';
	// 切断
	$db = null;
} catch(PDOException $e){
    echo "データベース接続失敗" . PHP_EOL;
	echo $e->getMessage();
	exit;
}

?>
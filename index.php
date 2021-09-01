<?php
	// データベースへ接続
	$db_link = mysqli_connect( 'localhost', 'root', 'password', 'guestbook');

    if($db_link){
            echo 'connect success!';
    } else {
        echo 'connect fail!';
    }
	
	// 接続エラーの確認
	if( mysqli_connect_errno($db_link) ) {
		echo mysqli_connect_errno($db_link) . ' : ' . mysqli_connect_error($db_link);
	}

	// 接続解除
	mysqli_close($db_link);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Example</title>
    </head>
    <body>
        <!-- ここではHTMLを書く以外のことは一切しない -->
    </body>
</html>
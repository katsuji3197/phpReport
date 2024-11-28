<?php
//データベース接続関数
function db_connect(){

	// .envファイルの読み込み
	if (file_exists(__DIR__ . '/../.env')) {
		$dotenv = parse_ini_file(__DIR__ . '/../.env');
		$host = $dotenv['DB_HOST'];
		$dbname = $dotenv['DB_NAME'];
		$user = $dotenv['DB_USER'];
		$password = $dotenv['DB_PASSWORD'];
	} else {
		die('.envファイルが見つかりません');
	}
	
	//DSNの作成
	$dsn = "mysql:host=".$host.";dbname=".$dbname.";charset=utf8";

	try {
		//データベースに接続
		$pdo = new PDO($dsn, $user, $password);
	
		//エラーが発生したら例外を投げる設定
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		//プリペアドステートメントを使えるようにする設定
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	  
		//print "接続しました<br />";
	
	} catch (PDOException $Exception) {
	
		//例外が発生したら接続エラーを出力
		die('接続エラー :' . $Exception->getMessage()."<br />");
	
	}
	return $pdo;
}
?>
<?php
/****************************************
 * メンバー取得
 * $sMemberId：メンバーID（未指定は空白）
 * $sLastName：苗字（未指定は空白）
 ****************************************/
function selectMember($sMemberId = "", $sLastName = ""){

	//初期化
	$arrResult = array();

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {
		//変数の準備
		$sSql  = "";
		$sWhere = "";
	
		//データ検索のSQLを作成
		$sSql .= "SELECT ";
		$sSql .= "	 * ";
		$sSql .= "FROM ";
		$sSql .= "	 webapp09 ";
		
		//データ検索の条件
		if($sMemberId != ""){
			//ID
			$sWhere .= ($sWhere == "") ? "WHERE " : "AND ";
			$sWhere .= "id = :id ";
		}
		if($sLastName != ""){
			//苗字
			$sWhere .= ($sWhere == "") ? "WHERE " : "AND ";
			$sWhere .= "last_name LIKE :last_name ";
		}
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sSql.$sWhere);
		
		//バインドの実行
		if($sMemberId != ""){
			//ID
			$stmh->bindValue(':id',  $sMemberId, PDO::PARAM_INT);
		}
		if($sLastName != ""){
			//苗字
			$stmh->bindValue(':last_name',  "%".$sLastName."%", PDO::PARAM_STR);
		}

		//SQL文の実行
		$stmh->execute();
		
		//実行結果を取得
		$arrResult = $stmh->fetchAll(PDO::FETCH_ASSOC);
	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");
	
	}
	
	return $arrResult;

}

/****************************************
 * メンバー登録
 * $sFirstName：名前
 * $sLastName：苗字
 ****************************************/
function insertMember($sFirstName, $sLastName){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {
		//データ検索の条件
		$sql = "INSERT INTO webapp09 (last_name, first_name)
				VALUES (:last_name, :first_name)";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':last_name',  $sLastName,  PDO::PARAM_STR);
		$stmh->bindValue(':first_name', $sFirstName, PDO::PARAM_STR);
		
		//SQL文の実行
		$stmh->execute();

		//登録成功を返却
		return true;

	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");
	
		//登録失敗を返却
		return false;

	}

}

/****************************************
 * メンバー更新
 * $sMemberId：メンバーID
 * $sFirstName：名前
 * $sLastName：苗字
 ****************************************/
function updateMember($sMemberId, $sFirstName, $sLastName){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {

		//データ検索の条件
		$sql = "UPDATE webapp09 
				SET
					last_name = :last_name, 
				    first_name = :first_name
				WHERE
					id = :id
		";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':id',         $sMemberId,  PDO::PARAM_INT);
		$stmh->bindValue(':last_name',  $sLastName,  PDO::PARAM_STR);
		$stmh->bindValue(':first_name', $sFirstName, PDO::PARAM_STR);
		
		//SQL文の実行
		$stmh->execute();
		
		//登録成功を返却
		return true;
	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");
	
		//登録失敗を返却
		return false;

	}

}

/****************************************
 * メンバー削除
 * $sMemberId：メンバーID
 ****************************************/
function deleteMember($sMemberId){

	//データベース接続関数の呼び出し
	$pdo = db_connect();

	try {

		//データ検索の条件
		$sql = "DELETE FROM webapp09 
				WHERE  id = :id
		";
		
		//ステートメントハンドラを作成
		$stmh = $pdo->prepare($sql);
		
		//バインドの実行
		$stmh->bindValue(':id', $sMemberId,  PDO::PARAM_INT);
		
		//SQL文の実行
		$stmh->execute();
		
		//登録成功を返却
		return true;
	
	} catch (PDOException $Exception) {
	
		//例外が発生したらエラーを出力
		die('実行エラー :' . $Exception->getMessage()."<br />");
	
		//登録失敗を返却
		return false;

	}

}

?>
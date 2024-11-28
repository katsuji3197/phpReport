<?php
//**************************************************
// 初期処理
//**************************************************
    //データベース接続関数の定義ファイルを読み込み
    require_once('../model/dbconnect.php');

    //データベース操作関数の定義ファイルを読み込み
    require_once('../model/dbfunction.php');

//**************************************************
// 変数取得
//**************************************************
    //ID
    $sMemberId = isset($_POST['id']) ? $_POST['id'] : "";

    //苗字
    $sLastName = isset($_POST['last_name']) ? $_POST['last_name'] : "";


//**************************************************
// 検索処理
//**************************************************
    //値を取得
    $arrResult = selectMember($sMemberId, $sLastName);


//**************************************************
// HTMLを出力
//**************************************************
    //画面へ表示
    if(count($arrResult) > 0){
        require_once('../view/index.html');
    } else {
        require_once('../view/none.html');
    }
?>
<?php
//**************************************************
// 初期処理
//**************************************************
    //SESSIONスタート
    session_start();

    //データベース接続関数の定義ファイルを読み込み
    require_once('../model/dbconnect.php');

    //データベース操作関数の定義ファイルを読み込み
    require_once('../model/dbfunction.php');

//**************************************************
// 変数取得
//**************************************************
    //ログインID
    $sLoginId = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : "";

    //ログインパスワード
    $sLoginPass = isset($_SESSION['login_pass']) ? $_SESSION['login_pass'] : "";

    //商品ID
    $nItemId = isset($_GET['item_id']) ? $_GET['item_id'] : "";


//**************************************************
// ログインチェック処理
//**************************************************
    //ログインチェックを取得
    $loginOk = loginCheck($sLoginId, $sLoginPass);

    //ログインOKならユーザIDとユーザ名を取得
    if($loginOk === true){
        $userId   = getUserId($sLoginId, $sLoginPass);
        $userName = getUserName($sLoginId, $sLoginPass);
    }

//**************************************************
// 検索処理
//**************************************************
    //商品詳細を取得
    $arrItem = selectItemDetail($nItemId);

//**************************************************
// カートに入れる処理
//**************************************************
    //メッセージ用の変数
    $resultMsg = "";

    //数量を取得
    $nItemNum = isset($_POST['item_num']) ? intval($_POST['item_num']) : 0;

    //商品追加（商品IDがあって、数量が1つ以上のとき）
    if($nItemId != "" && $nItemNum > 0){
        //カートへ追加処理
        $result = addCart($nItemId, $nItemNum, $userId);

        //メッセージ
        if($result === true){
            $resultMsg = "カートに".$nItemNum."件追加しました。";
        }
        else {
            $resultMsg = "カートに追加できませんでした。";
        }
    }


//**************************************************
// カート内の件数を取得
//**************************************************
    //ログインOKなら取得
    if($loginOk === true){
        $cartCnt = countCart($userId);
    }
    else {
        $cartCnt = "";
    }

//**************************************************
// HTMLを出力
//**************************************************
    //画面へ表示
    require_once('../view/detail.html');

?>
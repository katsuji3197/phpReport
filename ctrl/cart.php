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
    $nItemId = isset($_POST['item_id']) ? $_POST['item_id'] : "";

    //商品数量
    $nItemNum = isset($_POST['item_num']) ? $_POST['item_num'] : "";

//**************************************************
// ログインチェック処理
//**************************************************
    //ログインチェックを取得
    $loginOk = loginCheck($sLoginId, $sLoginPass);

    //ログインOKならユーザIDとユーザ名を取得
    if($loginOk === true){
        $userId   = getUserId($sLoginId, $sLoginPass);
        $userName = getUserName($sLoginId, $sLoginPass);
        $isAdmin  = isAdmin($sLoginId, $sLoginPass); // 管理者かどうかを判断
    }

//**************************************************
// 数量変更処理
//**************************************************
//メッセージ用の変数
$resultMsg = "";

//数量変更（商品IDがあるとき）
if($nItemId != ""){
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        // カートから削除処理
        $result = changeCart($nItemId, 0, $userId);

        //メッセージ
        if($result === true){
            $resultMsg = "商品を削除しました。";
        }
        else {
            $resultMsg = "商品を削除できませんでした。";
        }
    } else {
        //カートへ追加処理
        $result = changeCart($nItemId, $nItemNum, $userId);

        //メッセージ
        if($result === true){
            $resultMsg = "数量を変更しました。";
        }
        else {
            $resultMsg = "数量を変更できませんでした。";
        }
    }
}

//**************************************************
// 検索処理
//**************************************************
    //カート内一覧を取得
    $arrCart = selectCart($userId);

    //合計金額を計算
    $nTotalPrice = 0;
    foreach($arrCart as $item){
        $nTotalPrice += $item['item_price'] * $item['item_num'];
    }

//**************************************************
// HTMLを出力
//**************************************************
    //画面へ表示
    require_once('../view/cart.html');

?>
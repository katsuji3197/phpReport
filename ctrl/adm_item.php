<?php
// 初期処理
session_start();

// データベース接続関数の定義ファイルを読み込み
require_once('../model/dbconnect.php');

// データベース操作関数の定義ファイルを読み込み
require_once('../model/dbfunction.php');

// 変数取得
$sLoginId = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : "";
$sLoginPass = isset($_SESSION['login_pass']) ? $_SESSION['login_pass'] : "";

// ログインチェック
$loginOk = loginCheck($sLoginId, $sLoginPass);
$isAdmin = isAdmin($sLoginId, $sLoginPass);

if (!$loginOk || !$isAdmin) {
    header('Location: login.php');
    exit;
}

//ログインOKならユーザIDとユーザ名を取得
if($loginOk === true){
    $userId   = getUserId($sLoginId, $sLoginPass);
    $userName = getUserName($sLoginId, $sLoginPass);
    $isAdmin  = isAdmin($sLoginId, $sLoginPass); // 管理者かどうかを判断
}

// 変数取得
$nItemId = isset($_POST['item_id']) ? $_POST['item_id'] : "";
$sItemName = isset($_POST['item_name']) ? $_POST['item_name'] : "";
$bSaleStop = isset($_POST['sale_stop']) ? $_POST['sale_stop'] : "";
$sAction = isset($_POST['action']) ? $_POST['action'] : "";

// エラーメッセージ用の変数
$errorMsg = "";

// 商品削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $sAction === 'delete') {
    $result = deleteItem($nItemId);
    if ($result === true) {
        $errorMsg = "商品を削除しました。";
    } else {
        $errorMsg = "商品を削除できませんでした。";
    }
}

// 商品一覧を取得
$arrItem = selectItemAdmin($sItemName, $nItemId, $bSaleStop);

// カテゴリを取得
$arrCategory = getCategory();

// HTMLを出力
require_once('../view/adm_item.html');
?>
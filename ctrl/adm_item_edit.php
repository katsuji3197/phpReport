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

// 変数取得
$nItemId = isset($_POST['item_id']) ? $_POST['item_id'] : "";
$sItemName = isset($_POST['item_name']) ? $_POST['item_name'] : "";
$nItemPrice = isset($_POST['item_price']) ? $_POST['item_price'] : "";
$sItemExp = isset($_POST['item_exp']) ? $_POST['item_exp'] : "";
$nCategoryId = isset($_POST['category_id']) ? $_POST['category_id'] : "";
$bSaleStop = isset($_POST['stop_flg']) ? $_POST['stop_flg'] : "";
$sAction = isset($_POST['action']) ? $_POST['action'] : "";
$itemStock = isset($_POST['item_stock']) ? $_POST['item_stock'] : "";

// エラーメッセージ用の変数
$errorMsg = "";

// 商品編集処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $sAction === 'edit') {
    // 入力チェック
    if (mb_strlen($sItemName) > 20) {
        $errorMsg = "商品名は20文字以内で入力してください。";
    } elseif (!is_numeric($nItemPrice)) {
        $errorMsg = "商品価格は半角数字で入力してください。";
    } elseif (mb_strlen($sItemExp) > 500) {
        $errorMsg = "商品説明は500文字以内で入力してください。";
    } elseif (empty($nCategoryId)) {
        $errorMsg = "カテゴリを選択してください。";
    } elseif ($bSaleStop !== '0' && $bSaleStop !== '1') {
        $errorMsg = "販売状態を選択してください。";
    }

    // エラーメッセージがない場合は登録処理
    if (empty($errorMsg)) {
        $result = updateItem($nItemId, $sItemName, $sItemExp, $nItemPrice,  $itemStock, $nCategoryId, $bSaleStop);
        if ($result === true) {
            $errorMsg = "商品を編集しました。";
        } else {
            $errorMsg = "商品を編集できませんでした。";
        }
    }
}

// 商品情報を取得
$item = selectItemDetail($nItemId);

// カテゴリを取得
$arrCategory = getCategory();

// HTMLを出力
require_once('../view/adm_item_edit.html');
?>
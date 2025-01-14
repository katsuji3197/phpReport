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
$sItemName = isset($_POST['item_name']) ? $_POST['item_name'] : "";
$nItemPrice = isset($_POST['item_price']) ? $_POST['item_price'] : "";
$sItemExp = isset($_POST['item_exp']) ? $_POST['item_exp'] : "";
$nItemStock = isset($_POST['item_stock']) ? $_POST['item_stock'] : "";
$nCategoryId = isset($_POST['category_id']) ? $_POST['category_id'] : "";
$bSaleStop = isset($_POST['sale_stop']) ? $_POST['sale_stop'] : "";

// エラーメッセージ用の変数
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 入力チェック
    $errors = [];

    if (mb_strlen($sItemName) > 20) {
        $errors[] = "商品名は20文字以内で入力してください。";
    }
    if (!is_numeric($nItemPrice)) {
        $errors[] = "商品価格は半角数字で入力してください。";
    }
    if (mb_strlen($sItemExp) > 500) {
        $errors[] = "商品説明は500文字以内で入力してください。";
    }
    if (empty($nCategoryId)) {
        $errors[] = "カテゴリを選択してください。";
    }
    if ($bSaleStop !== '0' && $bSaleStop !== '1') {
        $errors[] = "販売状態を選択してください。";
    }

    // エラーメッセージを結合
    if (!empty($errors)) {
        $errorMsg = implode("<br>", $errors);
    }

    // エラーメッセージがない場合は登録処理
    if (empty($errorMsg)) {
        $result = addItem($sItemName, $sItemExp, $nItemPrice, $nItemStock, $nCategoryId, $bSaleStop);
        if ($result === true) {
            $errorMsg = "商品を追加しました。";
        } else {
            $errorMsg = "商品を追加できませんでした。";
        }
    }
}

// カテゴリを取得
$arrCategory = getCategory();

// HTMLを出力
require_once('../view/adm_item_add.html');
?>
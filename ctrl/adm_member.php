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
$nUserId = isset($_POST['user_id']) ? $_POST['user_id'] : "";
$sUserName = isset($_POST['user_name']) ? $_POST['user_name'] : "";
$sUserEmail = isset($_POST['user_email']) ? $_POST['user_email'] : "";
$sUserAddress = isset($_POST['user_address']) ? $_POST['user_address'] : "";
$sAction = isset($_POST['action']) ? $_POST['action'] : "";

// エラーメッセージ用の変数
$errorMsg = "";

// アカウント削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $sAction === 'delete') {
    $result = deleteUser($nUserId);
    if ($result === true) {
        $errorMsg = "アカウントを削除しました。";
    } else {
        $errorMsg = "アカウントを削除できませんでした。";
    }
}

// アカウント一覧を取得
$arrUsers = searchUsers($sUserName, $sUserEmail, $sUserAddress);

// HTMLを出力
require_once('../view/adm_member.html');
?>
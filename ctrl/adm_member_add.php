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

// エラーメッセージ用の変数
$errorMsg = "";

// 新規会員登録処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = isset($_POST['full_name']) ? $_POST['full_name'] : "";
    $postalCode = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
    $address = isset($_POST['address']) ? $_POST['address'] : "";
    $phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $isAdmin = isset($_POST['is_admin']) ? $_POST['is_admin'] : "0";

    // 入力チェック
    if (empty($fullName) || empty($postalCode) || empty($address) || empty($phoneNumber) || empty($email) || empty($password)) {
        $errorMsg = "すべての項目を入力してください。";
    } elseif (isEmailRegistered($email)) {
        $errorMsg = "このメールアドレスは既に登録されています。";
    } else {
        // 新規会員登録
        $result = registerNewUser($fullName, $postalCode, $address, $phoneNumber, $email, $password, $isAdmin);
        if ($result === true) {
            header('Location: adm_member.php');
            exit;
        } else {
            $errorMsg = "新規会員登録に失敗しました。";
        }
    }
}

// HTMLを出力
require_once('../view/adm_member_add.html');
?>
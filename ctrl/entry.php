<?php
// 初期処理
session_start();

// データベース接続関数の定義ファイルを読み込み
require_once('../model/dbconnect.php');

// データベース操作関数の定義ファイルを読み込み
require_once('../model/dbfunction.php');

// 変数取得
$fullName = isset($_POST['full_name']) ? $_POST['full_name'] : "";
$postalCode = isset($_POST['postal_code']) ? $_POST['postal_code'] : "";
$address = isset($_POST['address']) ? $_POST['address'] : "";
$phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";

// エラーメッセージ用の変数
$errorMsg = "";

// 会員登録処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // エラーメッセージ用の配列
    $errorMessages = [];

    // 入力チェック
    if (mb_strlen($fullName) > 20) {
        $errorMessages[] = "名前は20文字以内で入力してください。";
    }
    if (!preg_match('/^\d{7}$/', $postalCode)) {
        $errorMessages[] = "郵便番号は半角数字7桁で入力してください。";
    }
    if (empty($address)) {
        $errorMessages[] = "住所を入力してください。";
    }
    if (!preg_match('/^\d{1,12}$/', $phoneNumber)) {
        $errorMessages[] = "電話番号は半角数字12桁以内で入力してください。";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "メールアドレスの形式が正しくありません。";
    }
    if (empty($password)) {
        $errorMessages[] = "パスワードを入力してください。";
    }

    // メールアドレスの重複チェック
    if (empty($errorMessages) && isEmailRegistered($email)) {
        $errorMessages[] = "このメールアドレスは既に登録されています。";
    }

    // エラーメッセージがない場合は登録処理
    if (empty($errorMessages)) {
        $result = registerUser($fullName, $postalCode, $address, $phoneNumber, $email, $password);

        if ($result === true) {
            // 登録成功
            header('Location: login.php');
            exit;
        } else {
            // 登録失敗
            $errorMessages[] = "会員登録に失敗しました。";
        }
    }

    // エラーメッセージを表示
    if (!empty($errorMessages)) {
        foreach ($errorMessages as $message) {
            echo "<p style='color:red;'>$message</p>";
        }
    }
}

// エラーメッセージがある場合は表示
if (!empty($errorMsg)) {
    echo "<p style='color:red;'>$errorMsg</p>";
}

// entry.htmlを表示
require_once('../view/entry.html');
?>
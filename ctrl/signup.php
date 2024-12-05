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
// 変数定義
//**************************************************
    //エラーメッセージ用
    $arrErr = array();


//**************************************************
// 変数取得
//**************************************************
    //姓
    $sLastName = isset($_POST['last_name']) ? $_POST['last_name'] : "";

    //名
    $sFirstName = isset($_POST['first_name']) ? $_POST['first_name'] : "";

    //ログインID
    $sLoginId = isset($_POST['login_id']) ? $_POST['login_id'] : "";

    //ログインパスワード
    $sLoginPass = isset($_POST['login_pass']) ? $_POST['login_pass'] : "";

    //年齢
    $nAge = isset($_POST['age']) ? $_POST['age'] : "";

    //処理ステップ
    $nStepFlg = isset($_POST['step']) ? $_POST['step'] : "";


//**************************************************
// STEP1（確認画面）
//**************************************************
    if($nStepFlg == 1){

        // 姓チェック
        if($sLastName == ""){
            $arrErr['last_name'] = "姓を入力してください";
        }

        // 名チェック
        if($sFirstName == ""){
            $arrErr['first_name'] = "名を入力してください";
        }

        // ログインIDチェック
        if($sLoginId == ""){
            $arrErr['login_id'] = "ログインIDを入力してください";
        }
        else if(mb_strlen($sLoginId, "UTF-8") > 20) {
            $arrErr['login_id'] = "ログインIDは20文字以内で入力してください";
        }

        // パスワードチェック
        if($sLoginPass == ""){
            $arrErr['login_pass'] = "パスワードを入力してください";
        }
        else if(mb_strlen($sLoginPass, "UTF-8") > 20) {
            $arrErr['login_pass'] = "パスワードは20文字以内で入力してください";
        }

        // 年齢チェック
        if($nAge == ""){
            $arrErr['age'] = "年齢を入力してください";
        }
        else if(!is_numeric($nAge) || $nAge < 0 || $nAge > 120) {
            $arrErr['age'] = "正しい年齢を入力してください";
        }

        // エラーがなければ登録処理
        if(empty($arrErr)){
            $signupOk = signupUser($sLastName, $sFirstName, $sLoginId, $sLoginPass, $nAge);

            if($signupOk === true){
                //登録情報をSESSIONに保存
                $_SESSION['login_id']   = $sLoginId;
                $_SESSION['login_pass'] = $sLoginPass;

                //トップページへ遷移
                header("location: top.php");
                exit();
            } else {
                $arrErr['common'] = "サインアップに失敗しました。";
            }
        }
    }

//**************************************************
// HTMLを出力
//**************************************************
    //画面へ表示
    require_once('../view/signup.html');

?>
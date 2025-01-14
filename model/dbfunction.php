<?php
####################################################################################
### ユーザ関連
####################################################################################
/****************************************
 * ログインチェック
 * $sLoginId　：ログインID（未指定は空白）
 * $sLoginPass：ログインパスワード（未指定は空白）
 ****************************************/
function loginCheck($sLoginId = "", $sLoginPass = ""){

    //初期化
    $arrUser = array();

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //変数の準備
        $sSql  = "";

        //データ検索のSQLを作成
        $sSql .= "SELECT ";
        $sSql .= "   * ";
        $sSql .= "FROM ";
        $sSql .= "   user ";
        $sSql .= "WHERE ";
        $sSql .= "  email = :email AND ";
        $sSql .= "  password = :password ";


        //ステートメントハンドラを作成
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':email',   $sLoginId,   PDO::PARAM_STR);
        $stmh->bindValue(':password', $sLoginPass, PDO::PARAM_STR);

        //SQL文の実行
        $stmh->execute();

        //実行結果を取得
        $arrUser = $stmh->fetch(PDO::FETCH_ASSOC);

        //ログイン情報の有無を判定
        if($arrUser !== false){
            return true;
        }

    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return false;

}

/****************************************
 * ログインユーザのユーザIDを取得
 * $sLoginId　：ログインID
 * $sLoginPass：ログインパスワード
 ****************************************/
function getUserId($sLoginId = "", $sLoginPass = ""){

    //初期化
    $arrUser = array();
    $sUserId = "";

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //変数の準備
        $sSql  = "";

        //データ検索のSQLを作成
        $sSql .= "SELECT ";
        $sSql .= "   id ";
        $sSql .= "FROM ";
        $sSql .= "   user ";
        $sSql .= "WHERE ";
        $sSql .= "  email = :email AND ";
        $sSql .= "  password = :password ";


        //ステートメントハンドラを作成
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':email',   $sLoginId,   PDO::PARAM_STR);
        $stmh->bindValue(':password', $sLoginPass, PDO::PARAM_STR);

        //SQL文の実行
        $stmh->execute();

        //実行結果を取得
        $arrUser = $stmh->fetch(PDO::FETCH_ASSOC);

        //ユーザID取得
        $sUserId = $arrUser["id"];


    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $sUserId;

}

/****************************************
 * ログインユーザ名取得
 * $sLoginId　：ログインID
 * $sLoginPass：ログインパスワード
 ****************************************/
function getUserName($sLoginId = "", $sLoginPass = ""){

    //初期化
    $arrUser = array();
    $sUserName = "";

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //変数の準備
        $sSql  = "";

        //データ検索のSQLを作成
        $sSql .= "SELECT ";
        $sSql .= "   full_name ";
        $sSql .= "FROM ";
        $sSql .= "   user ";
        $sSql .= "WHERE ";
        $sSql .= "  email = :email AND ";
        $sSql .= "  password = :password ";


        //ステートメントハンドラを作成
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':email',   $sLoginId,   PDO::PARAM_STR);
        $stmh->bindValue(':password', $sLoginPass, PDO::PARAM_STR);

        //SQL文の実行
        $stmh->execute();

        //実行結果を取得
        $arrUser = $stmh->fetch(PDO::FETCH_ASSOC);

        //ユーザ名取得
        $sUserName = $arrUser["full_name"];


    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $sUserName;

}

/****************************************
 * 管理者チェック
 * $sLoginId　：ログインID
 * $sLoginPass：ログインパスワード
 ****************************************/
function isAdmin($sLoginId = "", $sLoginPass = ""){

    //初期化
    $isAdmin = false;

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //変数の準備
        $sSql  = "";

        //データ検索のSQLを作成
        $sSql .= "SELECT ";
        $sSql .= "   is_admin ";
        $sSql .= "FROM ";
        $sSql .= "   user ";
        $sSql .= "WHERE ";
        $sSql .= "  email = :email AND ";
        $sSql .= "  password = :password ";

        //ステートメントハンドラを作成
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':email',   $sLoginId,   PDO::PARAM_STR);
        $stmh->bindValue(':password', $sLoginPass, PDO::PARAM_STR);

        //SQL文の実行
        $stmh->execute();

        //実行結果を取得
        $arrUser = $stmh->fetch(PDO::FETCH_ASSOC);

        //管理者情報の有無を判定
        if($arrUser !== false && $arrUser["is_admin"] == 1){
            $isAdmin = true;
        }

    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $isAdmin;

}

####################################################################################
### 商品関連
####################################################################################
/****************************************
 * 商品一覧取得
 ****************************************/
function selectItem($keyword, $categoryId){

    //初期化
    $arrItem = array();
    $sWhere = "";

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //データ検索のSQLを作成
        $sSql  = "";
        $sSql .= "SELECT ";
        $sSql .= "   A.item_id, ";
        $sSql .= "   A.item_name, ";
        $sSql .= "   A.item_exp, ";
        $sSql .= "   A.item_price, ";
        $sSql .= "   A.item_stock, ";
        $sSql .= "   A.category_id, ";
        $sSql .= "   B.category_name ";
        $sSql .= "FROM ";
        $sSql .= "   item A ";
        $sSql .= "LEFT JOIN ";
        $sSql .= "   category B ";
        $sSql .= "ON ";
        $sSql .= "   A.category_id = B.category_id ";

        //データ検索の条件
        if($keyword != ""){
            //キーワード
            $sWhere .= ($sWhere == "") ? "WHERE " : "AND ";
            $sWhere .= "A.item_name LIKE :item_name ";
        }
        if($categoryId != ""){
            //カテゴリID
            $sWhere .= ($sWhere == "") ? "WHERE " : "AND ";
            $sWhere .= "A.category_id = :category_id ";
        }

        //ステートメントハンドラを作成
        $stmh = $pdo->prepare($sSql.$sWhere);

        //バインドの実行
        if($keyword != ""){
            //キーワード
            $stmh->bindValue(':item_name',  "%".$keyword."%", PDO::PARAM_STR);
        }
        if($categoryId != ""){
            //カテゴリID
            $stmh->bindValue(':category_id',  $categoryId, PDO::PARAM_INT);
        }

        //SQL文の実行
        $stmh->execute();

        //実行結果を取得
        $arrItem = $stmh->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $arrItem;

}

/****************************************
 * 商品一覧取得
 ****************************************/
function selectItemDetail($id){

    //初期化
    $arrItem = array();
    $sWhere = "";

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //データ検索のSQLを作成
        $sSql  = "";
        $sSql .= "SELECT ";
        $sSql .= "   A.item_id, ";
        $sSql .= "   A.item_name, ";
        $sSql .= "   A.item_exp, ";
        $sSql .= "   A.item_price, ";
        $sSql .= "   A.item_stock, ";
        $sSql .= "   A.category_id, ";
        $sSql .= "   A.stop_flg, ";
        $sSql .= "   B.category_name ";
        $sSql .= "FROM ";
        $sSql .= "   item A ";
        $sSql .= "LEFT JOIN ";
        $sSql .= "   category B ";
        $sSql .= "ON ";
        $sSql .= "   A.category_id = B.category_id ";
        $sSql .= "WHERE ";
        $sSql .= "   A.item_id = :item_id ";

        //ステートメントハンドラを作成
        $stmh = $pdo->prepare($sSql.$sWhere);

        //商品ID
        $stmh->bindValue(':item_id',  $id, PDO::PARAM_INT);

        //SQL文の実行
        $stmh->execute();

        //実行結果を取得
        $arrItem = $stmh->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $arrItem;

}

/****************************************
 * カテゴリ取得
 ****************************************/
function getAllCategories(){

    //初期化
    $arrCategory = array();

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //変数の準備
        $sSql  = "";

        //データ検索のSQLを作成
        $sSql .= "SELECT ";
        $sSql .= "   * ";
        $sSql .= "FROM ";
        $sSql .= "   category ";


        //ステートメントハンドラを作成
        $stmh = $pdo->prepare($sSql);

        //SQL文の実行
        $stmh->execute();

        //実行結果を取得
        $arrCategory = $stmh->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $arrCategory;

}

####################################################################################
### カート関連
####################################################################################
/****************************************
 * カート一覧取得
 * $nUserId：ユーザID
 ****************************************/
function selectCart($nUserId = ""){

    //ユーザID未指定の場合は×
    if($nUserId == ""){
        return false;
    }

    //初期化
    $arrCart = array();

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //データ検索のSQLを作成
        $sSql  = "";
        $sSql .= "SELECT ";
        $sSql .= "   A.item_id, ";
        $sSql .= "   A.item_num, ";
        $sSql .= "   B.item_name, ";
        $sSql .= "   B.item_exp, ";
        $sSql .= "   B.item_price, ";
        $sSql .= "   B.item_stock ";
        $sSql .= "FROM ";
        $sSql .= "   cart A ";
        $sSql .= "LEFT JOIN ";
        $sSql .= "   item B ";
        $sSql .= "ON ";
        $sSql .= "   A.item_id = B.item_id ";
        $sSql .= "WHERE ";
        $sSql .= "  A.user_id = :user_id ";
        $sSql .= "ORDER BY ";
        $sSql .= "  A.item_id ";

        //SQLを実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':user_id', $nUserId, PDO::PARAM_INT);
        $stmh->execute();
        $arrCart = $stmh->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $arrCart;

}

/****************************************
 * カート内件数を取得
 * $nUserId：ユーザID
 ****************************************/
function countCart($nUserId = ""){

    //ユーザID未指定の場合は×
    if($nUserId == ""){
        return 0;
    }

    //初期化
    $nCartCnt = 0;

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //データ検索のSQLを作成
        $sSql  = "";
        $sSql .= "SELECT ";
        $sSql .= "   COUNT(*) AS CNT ";
        $sSql .= "FROM ";
        $sSql .= "   cart ";
        $sSql .= "WHERE ";
        $sSql .= "  user_id = :user_id ";

        //SQLを実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':user_id', $nUserId, PDO::PARAM_INT);
        $stmh->execute();
        $arrCart = $stmh->fetch(PDO::FETCH_ASSOC);

        //件数を取得
        $nCartCnt = isset($arrCart['CNT']) ? $arrCart['CNT'] : 0;

    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $nCartCnt;

}

/****************************************
 * カートへ入れる
 * $nItemId ：商品ID
 * $nItemNum：商品数量
 * $nUserId ：ユーザID
 ****************************************/
function addCart($nItemId, $nItemNum, $nUserId){

    //初期化
    $result = false;

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //既にデータがあるかどうかを確認するSQL
        $sSql  = "";
        $sSql .= "SELECT ";
        $sSql .= "   * ";
        $sSql .= "FROM ";
        $sSql .= "   cart ";
        $sSql .= "WHERE ";
        $sSql .= "  item_id = :item_id AND ";
        $sSql .= "  user_id = :user_id ";

        //SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':item_id', $nItemId, PDO::PARAM_INT);
        $stmh->bindValue(':user_id', $nUserId, PDO::PARAM_INT);
        $stmh->execute();
        $arrItem = $stmh->fetch(PDO::FETCH_ASSOC);

        //登録されていない場合はINSERT
        if($arrItem === false){
            //INSERT文作成
            $sSql  = "";
            $sSql .= "INSERT INTO cart ";
            $sSql .= "  (user_id, item_id, item_num) ";
            $sSql .= "VALUES ";
            $sSql .= "  (:user_id, :item_id, :item_num)";
        }
        //登録されている場合はUPDATE
        else {
            //UPDATE文作成
            $sSql  = "";
            $sSql .= "UPDATE cart SET ";
            $sSql .= "  item_num = item_num + :item_num ";
            $sSql .= "WHERE";
            $sSql .= "  item_id = :item_id AND ";
            $sSql .= "  user_id = :user_id ";
        }

        //SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':user_id',     $nUserId,          PDO::PARAM_INT);
        $stmh->bindValue(':item_id',     $nItemId,          PDO::PARAM_INT);
        $stmh->bindValue(':item_num',   $nItemNum,         PDO::PARAM_INT);
        $result = $stmh->execute();//成功したらtrueが入る


    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }

    return $result;

}

/****************************************
 * 数量変更
 * $nItemId ：商品ID
 * $nItemNum：商品数量
 * $nUserId ：ユーザID
 ****************************************/
function changeCart($nItemId, $nItemNum, $nUserId){

    //初期化
    $result = false;

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //数量変更の場合
        if($nItemNum > 0){
            //UPDATE文作成
            $sSql  = "";
            $sSql .= "UPDATE cart SET ";
            $sSql .= "  item_num = :item_num ";
            $sSql .= "WHERE";
            $sSql .= "  item_id = :item_id AND ";
            $sSql .= "  user_id = :user_id ";

            //SQL実行～取得
            $stmh = $pdo->prepare($sSql);
            $stmh->bindValue(':user_id',  $nUserId,  PDO::PARAM_INT);
            $stmh->bindValue(':item_id',  $nItemId,  PDO::PARAM_INT);
            $stmh->bindValue(':item_num', $nItemNum, PDO::PARAM_INT);
            $result = $stmh->execute();
        }
        //数量が0の場合は削除
        else {
            //DELETE文作成
            $sSql  = "";
            $sSql .= "DELETE FROM cart ";
            $sSql .= "WHERE";
            $sSql .= "  item_id = :item_id AND ";
            $sSql .= "  user_id = :user_id ";

            //SQL実行～取得
            $stmh = $pdo->prepare($sSql);
            $stmh->bindValue(':user_id',  $nUserId,  PDO::PARAM_INT);
            $stmh->bindValue(':item_id',  $nItemId,  PDO::PARAM_INT);
            $result = $stmh->execute();
        }

    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }
    return $result;
}

/****************************************
 * カート内クリア
 * $nUserId ：ユーザID
 ****************************************/
function clearCart($nUserId){

    //初期化
    $result = false;

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        //DELETE文作成
        $sSql  = "";
        $sSql .= "DELETE FROM cart ";
        $sSql .= "WHERE";
        $sSql .= "  user_id = :user_id ";

        //SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':user_id',  $nUserId,  PDO::PARAM_INT);
        $result = $stmh->execute();

    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }
    return $result;
}

####################################################################################
### 注文関連
####################################################################################
/****************************************
 * 注文確定
 * $nUserId ：ユーザID
 ****************************************/
function compOrder($nUserId){

    //初期化
    $result = false;
    $orderDate = date("Y-m-d");

    //データベース接続関数の呼び出し
    $pdo = db_connect();

    try {

        //カート内の商品情報を取得する
        $arrCart = selectCart($nUserId);

        //注文テーブルへデータを入れるSQL
        $sSql  = "";
        $sSql .= "INSERT INTO orders ";
        $sSql .= "  (user_id, item_id, item_num, sales_price, order_date) ";
        $sSql .= "VALUES ";
        $sSql .= "  (:user_id, :item_id, :item_num, :sales_price, :order_date) ";

        //SQL実行～取得
        foreach($arrCart as $arr){
            $stmh = $pdo->prepare($sSql);
            $stmh->bindValue(':user_id',     $nUserId,           PDO::PARAM_INT);
            $stmh->bindValue(':item_id',     $arr["item_id"],    PDO::PARAM_INT);
            $stmh->bindValue(':item_num',    $arr["item_num"],   PDO::PARAM_INT);
            $stmh->bindValue(':sales_price', $arr["item_price"], PDO::PARAM_INT);
            $stmh->bindValue(':order_date',  $orderDate,         PDO::PARAM_STR);
            $stmh->execute();
        }

        //カート内クリア
        clearCart($nUserId);


    } catch (PDOException $Exception) {

        //例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");

    }
}

/****************************************
 * 会員登録
 * $fullName    ：氏名
 * $postalCode  ：郵便番号
 * $address     ：住所
 * $phoneNumber ：電話番号
 * $email       ：メールアドレス
 * $password    ：パスワード
 ****************************************/
function registerUser($fullName, $postalCode, $address, $phoneNumber, $email, $password) {
    // 初期化
    $result = false;

    // データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        // INSERT文作成
        $sSql  = "";
        $sSql .= "INSERT INTO user ";
        $sSql .= "  (full_name, postal_code, address, phone_number, email, password, is_admin) ";
        $sSql .= "VALUES ";
        $sSql .= "  (:full_name, :postal_code, :address, :phone_number, :email, :password, 0)";

        // SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':full_name', $fullName, PDO::PARAM_STR);
        $stmh->bindValue(':postal_code', $postalCode, PDO::PARAM_STR);
        $stmh->bindValue(':address', $address, PDO::PARAM_STR);
        $stmh->bindValue(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmh->bindValue(':email', $email, PDO::PARAM_STR);
        $stmh->bindValue(':password', $password, PDO::PARAM_STR);
        $result = $stmh->execute(); // 成功したらtrueが入る

    } catch (PDOException $Exception) {
        // 例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");
    }

    return $result;
}

// ...existing code...

/****************************************
 * メールアドレスの重複チェック
 * $email ：メールアドレス
 ****************************************/
function isEmailRegistered($email) {
    // 初期化
    $result = false;

    // データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        // SELECT文作成
        $sSql  = "";
        $sSql .= "SELECT ";
        $sSql .= "  COUNT(*) AS cnt ";
        $sSql .= "FROM ";
        $sSql .= "  user ";
        $sSql .= "WHERE ";
        $sSql .= "  email = :email";

        // SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':email', $email, PDO::PARAM_STR);
        $stmh->execute();
        $row = $stmh->fetch(PDO::FETCH_ASSOC);

        // 件数をチェック
        if ($row['cnt'] > 0) {
            $result = true;
        }

    } catch (PDOException $Exception) {
        // 例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");
    }

    return $result;
}

// ...existing code...

/****************************************
 * 商品の検索関数（管理者用）
 ****************************************/
function selectItemAdmin($itemName, $itemId, $saleStop) {
    $pdo = db_connect();
    $sql = "SELECT * FROM item WHERE 1=1";
    if ($itemId !== "") {
        $sql .= " AND item_id = :item_id";
    }
    if ($itemName !== "") {
        $sql .= " AND item_name LIKE :item_name";
    }
    if ($saleStop !== "") {
        $sql .= " AND stop_flg = :stop_flg";
    }
    $stmh = $pdo->prepare($sql);
    if ($itemId !== "") {
        $stmh->bindValue(':item_id', $itemId, PDO::PARAM_INT);
    }
    if ($itemName !== "") {
        $stmh->bindValue(':item_name', '%' . $itemName . '%', PDO::PARAM_STR);
    }
    if ($saleStop !== "") {
        $stmh->bindValue(':stop_flg', $saleStop, PDO::PARAM_INT);
    }
    $stmh->execute();
    return $stmh->fetchAll(PDO::FETCH_ASSOC);
}

/****************************************
 * 商品の追加関数
 ****************************************/
function addItem($itemName, $itemExp, $itemPrice, $itemStock, $categoryId, $stopFlg) {
    $pdo = db_connect();
    $sql = "INSERT INTO item (item_name, item_exp, item_price, item_stock, category_id, stop_flg) VALUES (:item_name, :item_exp, :item_price, :item_stock, :category_id, :stop_flg)";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(':item_name', $itemName, PDO::PARAM_STR);
    $stmh->bindValue(':item_exp', $itemExp, PDO::PARAM_STR);
    $stmh->bindValue(':item_price', $itemPrice, PDO::PARAM_INT);
    $stmh->bindValue(':item_stock', $itemStock, PDO::PARAM_INT);
    $stmh->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $stmh->bindValue(':stop_flg', $stopFlg, PDO::PARAM_INT);
    return $stmh->execute();
}

/****************************************
 * 商品の削除関数
 ****************************************/
function deleteItem($itemId) {
    $pdo = db_connect();
    $sql = "DELETE FROM item WHERE item_id = :item_id";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(':item_id', $itemId, PDO::PARAM_INT);
    return $stmh->execute();
}

/****************************************
 * カテゴリの取得関数
 ****************************************/
function getCategory() {
    $pdo = db_connect();
    $sql = "SELECT * FROM category";
    $stmh = $pdo->prepare($sql);
    $stmh->execute();
    return $stmh->fetchAll(PDO::FETCH_ASSOC);
}

/****************************************
 * 商品情報を編集する関数
 * $itemId     ：商品ID
 * $itemName   ：商品名
 * $itemExp    ：商品説明
 * $itemPrice  ：商品価格
 * $itemStock  ：商品在庫
 * $categoryId ：カテゴリID
 * $stopFlg    ：販売停止フラグ
 ****************************************/
function updateItem($itemId, $itemName, $itemExp, $itemPrice, $itemStock, $categoryId, $stopFlg) {
    // データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        // UPDATE文作成
        $sSql  = "";
        $sSql .= "UPDATE item SET ";
        $sSql .= "  item_name = :item_name, ";
        $sSql .= "  item_exp = :item_exp, ";
        $sSql .= "  item_price = :item_price, ";
        $sSql .= "  item_stock = :item_stock, ";
        $sSql .= "  category_id = :category_id, ";
        $sSql .= "  stop_flg = :stop_flg ";
        $sSql .= "WHERE ";
        $sSql .= "  item_id = :item_id";

        // SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':item_name', $itemName, PDO::PARAM_STR);
        $stmh->bindValue(':item_exp', $itemExp, PDO::PARAM_STR);
        $stmh->bindValue(':item_price', $itemPrice, PDO::PARAM_INT);
        $stmh->bindValue(':item_stock', $itemStock, PDO::PARAM_INT);
        $stmh->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmh->bindValue(':stop_flg', $stopFlg, PDO::PARAM_INT);
        $stmh->bindValue(':item_id', $itemId, PDO::PARAM_INT);
        return $stmh->execute(); // 成功したらtrueが入る

    } catch (PDOException $Exception) {
        // 例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");
    }
}

/****************************************
 * 会員一覧取得
 * $name    ：氏名
 * $email   ：メールアドレス
 * $address ：住所
 ****************************************/
function getAllUsers($name = "", $email = "", $address = "") {
    // 初期化
    $arrUsers = array();
    $sWhere = "";

    // データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        // SELECT文作成
        $sSql  = "";
        $sSql .= "SELECT * FROM user";

        // データ検索の条件
        if ($name != "") {
            // 氏名
            $sWhere .= ($sWhere == "") ? " WHERE " : " AND ";
            $sWhere .= "full_name LIKE :name";
        }
        if ($email != "") {
            // メールアドレス
            $sWhere .= ($sWhere == "") ? " WHERE " : " AND ";
            $sWhere .= "email LIKE :email";
        }
        if ($address != "") {
            // 住所
            $sWhere .= ($sWhere == "") ? " WHERE " : " AND ";
            $sWhere .= "address LIKE :address";
        }

        // ステートメントハンドラを作成
        $stmh = $pdo->prepare($sSql . $sWhere);

        // バインドの実行
        if ($name != "") {
            // 氏名
            $stmh->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
        }
        if ($email != "") {
            // メールアドレス
            $stmh->bindValue(':email', '%' . $email . '%', PDO::PARAM_STR);
        }
        if ($address != "") {
            // 住所
            $stmh->bindValue(':address', '%' . $address . '%', PDO::PARAM_STR);
        }

        // SQL文の実行
        $stmh->execute();

        // 実行結果を取得
        $arrUsers = $stmh->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $Exception) {
        // 例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");
    }

    return $arrUsers;
}

/****************************************
 * 新規会員登録
 * $fullName    ：氏名
 * $postalCode  ：郵便番号
 * $address     ：住所
 * $phoneNumber ：電話番号
 * $email       ：メールアドレス
 * $password    ：パスワード
 ****************************************/
function registerNewUser($fullName, $postalCode, $address, $phoneNumber, $email, $password, $isAdmin) {
    // 初期化
    $result = false;

    // データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        // メールアドレスの重複チェック
        if (isEmailRegistered($email)) {
            throw new Exception('このメールアドレスは既に登録されています。');
        }

        // INSERT文作成
        $sSql  = "";
        $sSql .= "INSERT INTO user ";
        $sSql .= "  (full_name, postal_code, address, phone_number, email, password, is_admin) ";
        $sSql .= "VALUES ";
        $sSql .= "  (:full_name, :postal_code, :address, :phone_number, :email, :password, :is_admin)";

        // SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':full_name', $fullName, PDO::PARAM_STR);
        $stmh->bindValue(':postal_code', $postalCode, PDO::PARAM_STR);
        $stmh->bindValue(':address', $address, PDO::PARAM_STR);
        $stmh->bindValue(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmh->bindValue(':email', $email, PDO::PARAM_STR);
        $stmh->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmh->bindValue(':is_admin', $isAdmin, PDO::PARAM_INT);
        $result = $stmh->execute(); // 成功したらtrueが入る

    } catch (PDOException $Exception) {
        // 例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");
    } catch (Exception $e) {
        // その他の例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$e->getMessage()."<br />");
    }

    return $result;
}
/****************************************
 * 会員検索
 * $name    ：氏名
 * $email   ：メールアドレス
 * $address ：住所
 ****************************************/
function searchUsers($name = "", $email = "", $address = "") {
    // 初期化
    $arrUsers = array();

    // データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        // SELECT文作成
        $sSql  = "";
        $sSql .= "SELECT * FROM user WHERE 1=1";

        // 条件追加
        if ($name != "") {
            $sSql .= " AND full_name LIKE :name";
        }
        if ($email != "") {
            $sSql .= " AND email LIKE :email";
        }
        if ($address != "") {
            $sSql .= " AND address LIKE :address";
        }

        // SQL実行～取得
        $stmh = $pdo->prepare($sSql);

        // バインドの実行
        if ($name != "") {
            $stmh->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
        }
        if ($email != "") {
            $stmh->bindValue(':email', '%' . $email . '%', PDO::PARAM_STR);
        }
        if ($address != "") {
            $stmh->bindValue(':address', '%' . $address . '%', PDO::PARAM_STR);
        }

        $stmh->execute();
        $arrUsers = $stmh->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $Exception) {
        // 例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");
    }

    return $arrUsers;
}

/****************************************
 * 会員情報変更
 * $userId     ：ユーザID
 * $fullName   ：氏名
 * $postalCode ：郵便番号
 * $address    ：住所
 * $phoneNumber：電話番号
 * $email      ：メールアドレス
 * $password   ：パスワード
 * $isAdmin    ：管理者権限
 ****************************************/
function updateUser($userId, $fullName, $postalCode, $address, $phoneNumber, $email, $password = null, $isAdmin = 0) {
    // データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        // UPDATE文作成
        $sSql  = "";
        $sSql .= "UPDATE user SET ";
        $sSql .= "  full_name = :full_name, ";
        $sSql .= "  postal_code = :postal_code, ";
        $sSql .= "  address = :address, ";
        $sSql .= "  phone_number = :phone_number, ";
        $sSql .= "  email = :email, ";
        if ($password !== null) {
            $sSql .= "  password = :password, ";
        }
        $sSql .= "  is_admin = :is_admin ";
        $sSql .= "WHERE ";
        $sSql .= "  id = :user_id";

        // SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':full_name', $fullName, PDO::PARAM_STR);
        $stmh->bindValue(':postal_code', $postalCode, PDO::PARAM_STR);
        $stmh->bindValue(':address', $address, PDO::PARAM_STR);
        $stmh->bindValue(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $stmh->bindValue(':email', $email, PDO::PARAM_STR);
        if ($password !== null) {
            $stmh->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        }
        $stmh->bindValue(':is_admin', $isAdmin, PDO::PARAM_INT);
        $stmh->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmh->execute(); // 成功したらtrueが入る

    } catch (PDOException $Exception) {
        // 例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");
    }
}

/****************************************
 * 会員情報削除
 * $userId ：ユーザID
 ****************************************/
function deleteUser($userId) {
    // データベース接続関数の呼び出し
    $pdo = db_connect();

    try {
        // DELETE文作成
        $sSql  = "";
        $sSql .= "DELETE FROM user ";
        $sSql .= "WHERE ";
        $sSql .= "  id = :user_id";

        // SQL実行～取得
        $stmh = $pdo->prepare($sSql);
        $stmh->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmh->execute(); // 成功したらtrueが入る

    } catch (PDOException $Exception) {
        // 例外が発生したらエラーを出力
        die('実行エラー（' . __FUNCTION__."）：".$Exception->getMessage()."<br />");
    }
}

/****************************************
 * 会員詳細取得
 * $userId ：ユーザID
 ****************************************/
function selectUserDetail($userId) {
    $pdo = db_connect();
    $sql = "SELECT 
                id, 
                full_name, 
                postal_code, 
                address, 
                phone_number, 
                email, 
                is_admin 
            FROM 
                user 
            WHERE 
                id = :user_id";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmh->execute();
    return $stmh->fetch(PDO::FETCH_ASSOC);
}


?>
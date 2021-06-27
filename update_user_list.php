<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$name = $_POST["name"];
$lid = $_POST{"lid"};
$lpw = $_POST{"lpw"};
$kanri_flg  = $_POST{"kanri_flg"};
$life_flg = $_POST{"life_flg"};
$id = $_POST["id"]; //inputタイプhiddenで送ったのもやる。

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare(
     "UPDATE gs_user_table SET name = :name, lid = :lid, lpw = :lpw, kanri_flg = :kanri_flg, life_flg = :life_flg WHERE id = :id;" 
    );
$stmt->bindValue(':name', $name, PDO::PARAM_STR);/// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':id', $id, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT

$status = $stmt->execute(); //実行


//４．データ登録処理後
if ($status == false) {

    //SQL実行時にエラーがある場合。以下関数かずみ。
    sql_error($stmt);
} else {
    //リダイレクト select.phpに。いか関数か
    redirect('user_list.php');
};

?>
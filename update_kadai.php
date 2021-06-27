<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$bookurl  = $_POST["bookurl"];
$comment = $_POST["comment"];
$id = $_POST["id"]; //inputタイプhiddenで送ったのもやる。

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare(
     "UPDATE gs_bm_table SET bookname = :bookname, bookurl = :bookurl, comment = :comment, indate = sysdate() WHERE id = :id;" 
    );
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);/// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':id', $id, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT

$status = $stmt->execute(); //実行


//４．データ登録処理後
if ($status == false) {

    //SQL実行時にエラーがある場合。以下関数かずみ。
    sql_error($stmt);
} else {
    //リダイレクト select.phpに。いか関数か
    redirect('select_kadai2.php');
};

?>
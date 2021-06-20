<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

// 文字列作成(日付)
$category = $_POST["category"];
$sender = $_POST{"sender"};
$question = $_POST{"question"};
$deadline = $_POST{"deadline"};

// 2. DB接続します tryはチャレンジする的な感じ PDOはデータベースに接続するための設定を書いてね。
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=bs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}


// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO  bs_an_table ( id, category, sender, question, deadline, indate)
  VALUES( NULL, :category, :sender, :question, :deadline, sysdate() )"
);

// 4. バインド変数を用意
$stmt->bindValue(':category', $category, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':sender', $sender, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':question', $question, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location: bs.php');
  
}
?>

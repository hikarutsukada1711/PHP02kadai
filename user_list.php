<?php
// funcs.phpを読み込む
require_once('funcs.php');

//1.  DB接続します
try {
    $db_name = "new_kadai";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = "localhost"; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//3. 実行
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        $view .= '<a href="detail_user_list.php?id='.$result["id"].'">'; //変数を代入した上でリンクを作成する書き方 result["id"]
        $view .= $result["name"] . "：" . $result["lid"];
        $view .= '</a>';
        $view .= '<a href="delete_user_list.php?id='.$result["id"].'">'; //こちらはdelete
        $view .= '  [削除]';
        $view .= '</a>';
        $view .= '</p>';
    }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index_kadai.php">データ登録</a>
      <a class="navbar-brand" href="resi_user_list.php">ユーザー登録</a>
      <a class="navbar-brand" href="update_user_list.php">ユーザーデータの更新</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
        <div class="container jumbotron">
            <a href="detail.php"></a>
            <?= $view ?>
        </div>
    </div>
<!-- Main[End] -->

</body>
</html>

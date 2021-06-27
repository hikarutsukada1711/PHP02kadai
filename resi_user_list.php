<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_kadai.php">データ一覧</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="select_kadai2.php">データ削除</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="user_list.php">ユーザーリスト</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert_user_list.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>ユーザー名：<input type="text" name="name"></label><br>
     <label>ID<input type="text" name="lid"></label><br>
     <label>PW<input type="text" name="lpw"></label><br>
     <label>管理フラグ<input type="int" name="kanri_flg"></label><br>
     <label>ライフフラグ<input type="int" name="life_flg"></label><br> 
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

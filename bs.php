<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_bs.php">データ一覧</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="ireader_bs.php">登録データの確認</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert_bs.php">
  <div class="jumbotron">
   <fieldset>
    <legend>社内ビザスク</legend> 

    <label>カテゴリを選択：</label>
     <select name="category"> 
      <option value="excel">excel</option>
      <option value="ネットワーク">ネットワーク</option>
      <option value="業界情報">業界情報</option>     
     </select>
     <br>
     <label>質問者：<input type="text" name="sender"></label><br>
     <label>緊急度：</label>
     <select name="deadline"> 
      <option value="すぐに答えて">すぐに答えて</option>
      <option value="時間がある時で。でもなるはや">時間がある時で。でもなるはや</option>
      <option value="暇な時で">暇な時で</option>     
     </select>
     <br>
     <label>質問事項を記載<textArea name="question" rows="4" cols="20"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

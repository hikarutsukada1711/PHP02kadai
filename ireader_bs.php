<?php
//funcsの関数を読み込む
require_once('funcs.php');

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=bs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM bs_an_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示「質問」取得の時点で指定するのか、表示の時点で指定するのか？
$view="";
$resultArr = [];
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<option>";
    $view .= h($result['sender']);
    $view .= "</option>";
    array_push($resultArr,$result);
  }
  $json .= json_encode($resultArr, JSON_UNESCAPED_UNICODE);

}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/sample2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">
</head>
<body>
    <!-- 入力欄 -->
    <header>
        <div>
            <p id="main_title">社内ビザスク</p>
        </div>
        <select id="sender_list">
            <?= $view ?>
        </select>
        <button id="sender_list_btn">見る </button>
    </header>
    <form method="post" action="insert_bs.php">
        <dl id="input_form">
            <fieldset>
                    <div class="input_form_each">
                        <dt class="input_form_left">
                            <p class="input_form_left_title">カテゴリ</p>
                        </dt>
                        <dd>
                        <!-- <input type="text" id="book_title" name="title"> -->
                            <select name="category" id="category"> 
                                <option value="excel">excel</option>
                                <option value="ネットワーク">ネットワーク</option>
                                <option value="業界情報">業界情報</option>     
                            </select>
                        </dd>
                        <button id="category_btn" class="input_btn">登録</button>
                    </div>

                    <div class="input_form_each">
                        <dt class="input_form_left">
                            <p class="input_form_left_title">質問者</p>
                        </dt>
                        <dd>
                            <input type="text" name="sender" id="sender">
                        </dd>
                        <button id="sender_btn" class="input_btn">登録</button>
                    </div>

                    <div class="input_form_each">
                        <dt class="input_form_left">
                            <p class="input_form_left_title">緊急度</p>
                        </dt>
                        <dd>
                            <!-- <textarea id="finding" cols="100" rows="7" name="finding"></textarea> -->
                            <select name="deadline" id="deadline"> 
                                <option value="すぐに答えて">すぐに答えて</option>
                                <option value="時間がある時で。でもなるはや">時間がある時で。でもなるはや</option>
                                <option value="暇な時で">暇な時で</option>     
                            </select>
                        </dd>
                        <button id="deadline_btn" class="input_btn">登録</button>
                    </div>

                    <div class="input_form_each">
                        <dt class="input_form_left">
                            <p class="input_form_left_title">質問事項を記載</p>
                        </dt>
                        <dd>
                            <textarea id="action" cols="100" rows="7" name="question"></textarea>
                        </dd>
                        <button id="question_btn" class="input_btn">登録</button>
                    </div>
                    
                    <input id="send_btn" type="submit" value="送信">
            </fieldset>
        </dl>
    </form> 

</body>
</html>

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- JQuery -->

<script>
var parseJson = function(jsonString) {
  var converted = convertNl(jsonString);
  return JSON.parse(converted);
};

var convertNl = function(jsonString) {
  return jsonString
    .replace(/(\r\n)/g, '\n')
    .replace(/(\r)/g,   '\n')
    .replace(/(\n)/g,  '\\n');
};

const data = parseJson('<?=$json?>');
console.log(data);

$("#sender_list_btn").on("click",function(){    
    alert("alert");
    console.log("test");
    const sender_miru = $("#sender_list").val();
    console.log(sender_miru);
    $("#sender").val(sender_miru); 
    $("#category").val("");
    $("#deadline").val("");
    $("#question").val("");
    
    var sender_Ref = data.find(element => element.sender === sender_miru);
    console.log(sender_Ref);
    let pu = sender_Ref.category;
    $("#category").val(pu);

    let fi = sender_Ref.sender;
    $("#sender").val(fi);

    let to = sender_Ref.todo;
    $("#deadline").val(to);

    let re1 = sender_Ref.question;
    $("#question").val(re1);

})

</script>

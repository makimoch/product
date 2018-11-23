<?php
include('functions.php');
//入力チェック(受信確認処理追加)
if(
  !isset($_POST['name']) || $_POST['name']==''
){
  exit('ParamError');
}

// POSTデータ取得
$name = $_POST['name'];

//データ選択SQL
$pdo = db_conn();
$sql = "SELECT * FROM restaurants WHERE name LIKE '%$name%'";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


if($status==false){
    queryError($stmt);
}else{
    $array = [$name, $tel];
    echo json_encode($array);
    // echo json_encode('kkkk');

    exit;
}
// // データ表示
// $view="";
// if($status==false) {
//   $error = $stmt->errorInfo();
//   exit("sqlError:".$error[2]);
// }else{
//   //Selectデータの数だけ自動でループ
//   while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//     //データの個数分繰り返す＝while、fetch=一行ずつ取り出す
//     $view .= "<p>".$result["tel"]."-".$result["name"]."</p>";
//   }
}
// $sql = 'INSERT INTO '. $ajax_table .'(id, name, email, detail, indate)VALUES(NULL, :a1, :a2, :a3, sysdate())';

?>


<!-- <!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>お店検索</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main"> -->
<!-- Head[Start] -->
<!-- <header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="search_top.php">データ検索</a>
      </div>
    </div>
  </nav>
</header> -->
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- <div>
    <div class="container jumbotron"><?=$view?></div>
</div> -->
<!-- Main[End] -->

<!-- </body>
</html> -->

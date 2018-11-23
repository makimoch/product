<?php

include('functions.php');
//入力チェック(受信確認処理追加)
if(
    !isset($_POST['name']) || $_POST['name']=="" ||
    !isset($_POST['other']) || $_POST['other']==""
){
    exit('ParamError');
}

//1. POSTデータ取得
$name   = $_POST['name'];
$other   = $_POST['other'];

$sql = 'INSERT INTO '.$tst_tbl .'(id, name, other, indate)VALUES(NULL, :a1, :a2, sysdate())';
//2. DB接続します(エラー処理追加)
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $other, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    queryError($stmt);
}else{
    $array = [$name, $other];
    echo json_encode($array);
    exit;
}



?>

<?php

include('functions.php');
//入力チェック(受信確認処理追加)
if(
    !isset($_POST['name']) || $_POST['name']=="" ||
    !isset($_POST['tel']) || $_POST['tel']=="" ||
    !isset($_POST['url']) || $_POST['url']==""
){
    exit('ParamError');
}

//1. POSTデータ取得
$name   = $_POST['name'];
$email   = $_POST['tel'];
$detail = $_POST['url'];

$sql = 'INSERT INTO '. $r_table .
'(id, created_at, updated_at, rest_id, name, name_kana, tel, address,
latitude, longitude, url, image_url, opentime, holiday, category_code, area_code)
VALUES (NULL, sysdate(), sysdate(), 999, :a1, test, :a2, test, 99999, 99999, :a3, NULL, NULL, NULL, NULL, NULL)';

//2. DB接続します(エラー処理追加)
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $tel, PDO::PARAM_STR);
$stmt->bindValue(':a3', $url, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    queryError($stmt);
}else{
    $array = [$name, $tel, $url];
    echo json_encode($array);
    exit;
}



?>

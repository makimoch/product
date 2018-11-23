<?php

include('functions.php');
//form入力チェック(受信確認処理追加)
if(
    !isset($_POST['name']) || $_POST['name']==""
    // !isset($_POST['other']) || $_POST['other']==""
){
    exit('ParamError');
}

//POSTデータ取得
$name   = $_POST['name'];
// $other   = $_POST['other'];
$like_name = '%'.$name.'%';

//DB接続と検索処理
$sql = 'SELECT * FROM test WHERE name LIKE (:name)';
$pdo = db_conn();
//SQL作成
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $like_name, PDO::PARAM_STR);
// $stmt->bindValue(':a2', $other, PDO::PARAM_STR);
$status = $stmt->execute();

//sql処理後
if($status==false){
    errorMsg($stmt);
    }else{
    //*memo* SELECTで指定した項目をキーとして、fetchAllで全件データを取得と同時に
    // JSONにエンコードする。header指定することでJavascript側にJSONで返す
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}



?>

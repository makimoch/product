<?php
//このファイルは表示されない。index.phpからデータを受け取って、
//データベースに送る→index.phpのページに戻る、のコード。
//見た目上は何も起こっていないように見える。基本コピペで使う！
if(
  !isset($_POST["name"]) || $_POST["name"]=="" || //issetは値が入っているかどうか調べる ||="または"条件
  !isset($_POST["email"]) || $_POST["email"]=="" //||
  //!isset($_POST["detail"]) || $_POST["detail"]==""
){
  exit('ParamError'); //入力されてなかったらエラーを返す
}

//1. POSTデータ取得
//$name = filter_input( INPUT_GET, "name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST["name"];
$email = $_POST["email"];
$detail = $_POST["detail"];

//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_f01_db32;charset=utf8;host=localhost','root','');
  //localhostの時は、ユーザー名はroot、パスワードは''=空欄になる
  //決まった書き方なので、dbname,host,username,passwordだけ変更する
} catch (PDOException $e) {
  exit('dbError:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql ="INSERT INTO gs_php02_table(id,name,email,detail,indate)
VALUES(NULL, :a1, :a2, :a3, sysdate())";
//ここで、valueの中身を$nameとかにするとセキュリティ上だめ

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $email, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $detail, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); 
//この一行で実行される。忘れたら動かない

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]); //$error[2]だけ読めるエラーメッセージなのでこれだけ呼び出す
}else{
  //５．index.phpへリダイレクト
  header("location: index.php");

}
?>

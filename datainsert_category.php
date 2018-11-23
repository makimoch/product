<?php
// APIからデータベースへのデータ取り込み用ファイル（カテゴリ）

try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbError:'.$e->getMessage());
}

// APIからデータ取得
$url= 'https://api.gnavi.co.jp/master/CategoryLargeSearchAPI/v3/?keyid=7eff162e1226c9bf957b0395a8351850&lang=ja';
$options['ssl']['verify_peer']=false;
$options['ssl']['verify_peer_name']=false;
$json_str = file_get_contents($url, false, stream_context_create($options));
$json_obj = json_decode($json_str); // オブジェクトに変換
$category_l = $json_obj->category_l;
$categories = json_decode(json_encode($category_l));

// DB登録
foreach ($categories as $category) {
  $category_code = $category->category_l_code;
  $category_name = $category->category_l_name;

  var_dump('<br>');
  var_dump($category_code);
  var_dump($category_name);

  // APIデータ登録用SQL文
  $sql = "INSERT INTO categories (id,category_name,category_code,indate) 
          VALUES(NULL, :a1, :a2, sysdate())";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':a1', $category_name, PDO::PARAM_STR);
  $stmt->bindValue(':a2', $category_code, PDO::PARAM_STR);
  $status = $stmt->execute();
}

// データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]); //$error[2]だけ読めるエラーメッセージなのでこれだけ呼び出す
}
?>

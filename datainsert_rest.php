<?php
// APIからデータベースへのデータ取り込み用ファイル（カテゴリ）
include('functions.php');
$pdo = db_conn();

for ($i = 1; $i <=10 ; $i++) {
  // APIからデータ取得
  $url = 'https://api.gnavi.co.jp/RestSearchAPI/v3/?keyid=7eff162e1226c9bf957b0395a8351850&hit_per_page=100&pref=PREF40&offset_page=';
  $url .= $i;

  $options['ssl']['verify_peer']=false;
  $options['ssl']['verify_peer_name']=false;
  $json_str = file_get_contents($url, false, stream_context_create($options));
  $json_obj = json_decode($json_str); // オブジェクトに変換
  $rest = $json_obj->rest;
  $rests = json_decode(json_encode($rest));

  // 取得データの表示
  foreach ($rests as $rest) {
    $name = $rest->name;
    $tel = $rest->tel;

    var_dump('<br>');
    var_dump($name);
    var_dump($tel);

    // APIデータ登録用SQL文
    $sql = "INSERT INTO rest_list (id,name,tel,indate)
            VALUES(NULL, :a1, :a2, sysdate())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':a1', $name, PDO::PARAM_STR);
    $stmt->bindValue(':a2', $tel, PDO::PARAM_STR);
    $status = $stmt->execute();
  }
} //for文ここまで

// データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]); //$error[2]だけ読めるエラーメッセージなのでこれだけ呼び出す
}else{
  exit;
}
?>

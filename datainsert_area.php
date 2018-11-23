<?php
// APIからデータベースへのデータ取り込み用ファイル（エリア）
//
// try {
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('dbError:'.$e->getMessage());
// }
include('functions.php');
$pdo = db_conn();


$url= 'https://api.gnavi.co.jp/master/GAreaLargeSearchAPI/v3/?keyid=7eff162e1226c9bf957b0395a8351850';
$options['ssl']['verify_peer']=false;
$options['ssl']['verify_peer_name']=false;
$json_str = file_get_contents($url, false, stream_context_create($options));
$json_obj = json_decode($json_str); // オブジェクトに変換
$area_l = $json_obj->garea_large;
$areas = json_decode(json_encode($area_l));
  // var_dump($areas);

foreach ($areas as $area) {
  $area_name = $area->areaname_l;
  $area_code = $area->areacode_l;
  // var_dump('<br>');
  // var_dump($area_name);
  // var_dump($area_code);

  $sql = "INSERT INTO areas (id,area_name,area_code,indate)
          VALUES(NULL, :a1, :a2, sysdate())";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':a1', $area_name, PDO::PARAM_STR);
  $stmt->bindValue(':a2', $area_code, PDO::PARAM_STR);
  $status = $stmt->execute();
}

// データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]); //$error[2]だけ読めるエラーメッセージなのでこれだけ呼び出す
}
?>

<!-- <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>


  <table>
  <thead>
  <tr><th>エリアL名称</th><th>エリアLコード</th></tr>
  <thead>
  <tbody>
      <tr>
          <td></td>
      </tr>
  </tbody>
  </table>
</body> -->

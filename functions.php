<?php
function db_conn(){
    $dbname='gs_db';
  try {
    $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo;
}

// テーブル名
$r_table = 'restaurants';
// $u_table = 'users';
// $a_table = 'areas';
// $c_table = 'categories';
$tst_tbl = 'test';

//SQL処理エラー
function errorMsg($stmt){
  $error = $stmt->errorInfo();
  exit('ErrorQuery:'.$error[2]);
}

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
//SESSIONチェック＆リジェネレイト
function chk_ssid(){
  if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id()){
    exit('Login エラー！');
  }else{
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
  }
}

?>

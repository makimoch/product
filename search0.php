<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous">
<title>データ検索</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="search_top.php">topに戻る</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="search_action.php" id="post_form">
  <div class="jumbotron">
   <fieldset>
    <legend>お店の名前で検索</legend>
     <label>店名：<input type="text" name="name" placeholder="お店の名称"></label><br>
      <button id ="send" type="submit" class="btn btn-default">
      <i class="glyphicon glyphicon-plus"></i> Search
    </fieldset>
  </div>
</form>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(window).on('load', function () {
            $('#send').on('click', function () {
                $('button').attr('disabled', true);
                var input_value = new FormData($('#post_form')[0]);
                $.ajax({
                    type: 'post',
                    url: 'ajax_search.php',
                    data: input_value,
                    dataType: 'json',
                    processData: false,
                    contentType: false
                }).done(function (response, textStatus, xhr) {
                    alert('done');
                    console.log(response);
                }).fail(function (response, textStatus, xhr) {
                    alert('fail');
                    return false;
                }).always(function () {
                    $('name').val('');
                    $('button').attr('disabled', false);
                });
            });
            // ajax構文
            // $.ajax({
            //     type: 'post',               //getかpostを指定．データを持ってくる場合はget
            //     url: '*************.php',   //宛先のphpファイルを指定
            //     data: {                     //オブジェクト形式で送るとphpファイルで$_data1[]でとれる
            //         data1:'hoge',
            //         data2:'fuga'
            //     },
            //     dataType: 'json',           //データの種類を指定．html,jsonなど
            //     processData: false,         //送信のときにエラーが出たらつける
            //     contentType: false          //送信のときにエラーが出たらつける
            // }).done(function (response, textStatus, xhr) {
            //     alert('done');              //成功時の処理
            //     console.log(response);
            // }).fail(function (response, textStatus, xhr) {
            //     alert('fail');              //失敗時の処理
            // }).always(function () {
            //     alert('always');            //いつでも実行する処理
            // });
        });
    </script> -->
</body>

</html>

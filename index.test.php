<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form action="" method="post" id="post_form">
    <input type="text" id="name" name="name" placeholder="name">
    <input type="text" id="tel" name="tel" placeholder="tel">
    <textarea name="url" id="url" cols="30" rows="10" placeholder="url"></textarea>
    <button id="send" type="submit">送信</button>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(window).on('load', function () {
        $('#send').on('click', function () {
            $('button').attr('disabled', true);
            var input_value = new FormData($('#post_form')[0]);
            $.ajax({
                type: 'post',
                url: 'ajax_insert.php',
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
                $('input').val('');
                $('textarea').val('');
                $('button').attr('disabled', false);
            });
        });
    });
</script>
</body>

<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>tel：<input type="text" name="tel"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

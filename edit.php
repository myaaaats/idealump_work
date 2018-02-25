<?php

session_start();

//ログイン済みかを確認
if (!isset($_SESSION['USER'])) {
    header('Location: login.php');
    exit;
}

//ログアウト機能
if(isset($_POST['logout'])){

    $_SESSION = [];
    session_destroy();

    header('Location: login.php');
    exit;
}
// localhostのとき
//$dsn = 'mysql:dbname=topicsInfo;host=localhost';
// ロリポップのとき
$dsn = 'mysql:dbname=LAA0937998-idealump;host=mysql127.phy.lolipop.lan';
// ローカルホストのとき
// $user = 'idealump';
// ロリポップのとき
$user = 'LAA0937998';
// ローカルホストのとき
// $password = 'i_want_to_join_idealump';
$password = 'idealumppass';
try{
    $dbh = new PDO($dsn, $user, $password);
    // SQL作成
    $sql = "SELECT * FROM topicsInfo WHERE id = 1;";
    echo $sql;
    // SQL実行
    $res = $dbh->query($sql);

    // 取得したデータを出力
    foreach( $res as $value ) {
    var_dump($value);
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
    <title>編集画面</title>
</head>

<body>
<h1>トップ画面</h1>
<p><?php echo $_SESSION['USER'] ?>さんでログイン中</p>
<br>
<form action="form.php" method="post" enctype="multipart/form-data">
<p>
タイトル　※入力必須：<br><input type="title" name="title" size="40" required>
</p>
<p>
表示日時　※入力必須：<br><input type="date" name="date" required>
</p>
<p>
すぐに公開しますか？　※入力必須：<br>
<input type="radio" name="show_flg" value="1" checked> はい
<input type="radio" name="show_flg" value="0" > いいえ
</p>
<p>
公開日時：<br><input type="date" name="enddate">
</p>
<p>
本文　※入力必須：<br>
<textarea name="text" rows="4" cols="40" required></textarea>
</p>
<p>
画像ファイル　※入力必須：<br><input type="file" name="img" enctype="multipart/form-data" required>
</p>
<p>
<input type="submit" value="送信"><input type="reset" value="リセット">
</p>
</form>
<form method="post" action="top.php">
    <input type="submit" name="logout" value="ログアウト">
</form>

</body>
</html>

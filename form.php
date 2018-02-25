<?php
header('Content-Type: text/html; charset=UTF-8');
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

$tempfile = $_FILES['img']['tmp_name'];
$filename = 'image/' . $_FILES['img']['name'];

if (is_uploaded_file($tempfile)) {
    if ( move_uploaded_file($tempfile , $filename )) {
        echo $filename . "をアップロードしました。";
    } else {
        echo "ファイルをアップロードできません。";
    }
} else {
    echo "ファイルが選択されていません。";
}

echo 'タイトル：';
echo '<br>';
echo $_POST["title"];
echo '<br>';
echo '表示日時：';
echo '<br>';
echo $_POST["date"];
echo '<br>';
if(is_array($_POST["enddate"])){
    echo '公開日時：';
    echo '<br>';
    echo $_POST["enddate"];
    echo '<br>';
}
echo '本文：';
echo '<br>';
echo $_POST["text"];
echo '<br>';
echo '画像：';
echo '<br>';
echo '<img src="http://idealump-work.jellybean.jp/image/'.$_FILES['img']['name'].'"/>';
echo '<br>';
echo '<br>';
try{
    $dbh = new PDO($dsn, $user, $password);
    // SQL作成
    $title = $_POST["title"];
    $date = $_POST["date"];
    $enddate = $_POST["enddate"];
    $text = $_POST["text"];
    $img = $_FILES['img']['name'];
    $show_flg = $_POST["show_flg"];
    $sql = "INSERT INTO `LAA0937998-idealump`.`topicsInfo` (`id`, `title`, `date`, `enddate`, `text`, `img`, `show_flg`) VALUES (NULL, '$title', '$date', '$enddate', '$text', '$img',  '$show_flg');";
    // SQL実行
    $res = $dbh->query($sql);
    echo 'こちらの内容で登録しました。';

}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
?>

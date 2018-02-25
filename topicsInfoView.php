<?php
header('Content-Type: text/html; charset=UTF-8');
echo '<head>';
echo '<title>ニュース一覧</title>';
echo '</head>';
echo '<h1>ニュース一覧</h1>';
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
    $sql = "SELECT * FROM topicsInfo WHERE enddate > NOW() OR enddate IS NULL ORDER BY DATE DESC LIMIT 10;";
    // SQL実行
    $res = $dbh->query($sql);

    // 取得したデータを出力
    foreach( $res as $value ) {
        if ($value['show_flg'] === '1'){
            echo 'タイトル：';
            echo '<br>';
            echo $value['title'];
            echo '<br>';
            echo '表示日時：';
            echo '<br>';
            echo $value['date'];
            echo '<br>';
            echo '本文：';
            echo '<br>';
            echo $value['text'];
            echo '<br>';
            echo '画像：';
            echo '<br>';
            echo '<img src="http://idealump-work.jellybean.jp/image/'.$value['img'].'"/>';
            echo '<br>';
            echo '<br>';
        };
    };
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

?>

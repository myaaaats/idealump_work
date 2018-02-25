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

try{
    $dbh = new PDO($dsn, $user, $password);
    // SQL作成
    $sql = "DELETE FROM  `topicsInfo` WHERE id =".$_POST["id"].";";
    // SQL実行
    $res = $dbh->query($sql);

    // 取得したデータを出力
    foreach( $res as $value ) {
        echo $value['title'];
    };
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

echo '削除しました';
echo '<form action="topicsInfoView.php">';
echo '<input type="submit" value="view画面へ">';
echo '</form>';
echo '<form action="topicsInfo.php">';
echo '<input type="submit" value="記事管理ページに戻る">';
echo '</form>';
echo '<form method="post" action="top.php">';
echo '<input type="submit" value="新規追加">';
echo '</form>';

?>

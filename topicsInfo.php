<?php
header('Content-Type: text/html; charset=UTF-8');
echo '<head>';
echo '<title>記事管理ページ</title>';
echo '</head>';
echo '<h1>記事管理ページ</h1>';
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
echo '<form action="topicsInfoView.php">';
echo '<input type="submit" value="view画面へ">';
echo '</form>';
echo '<form method="post" action="top.php">';
echo '<input type="submit" value="新規追加">';
echo '</form>';

try{
    $dbh = new PDO($dsn, $user, $password);
    // SQL作成
    $sql = "SELECT * FROM topicsInfo ORDER BY DATE DESC;";
    // SQL実行
    $res = $dbh->query($sql);

    // 取得したデータを出力
    foreach( $res as $value ) {
        echo 'タイトル：';
        echo '<br>';
        echo $value['title'];
        echo '<br>';
        echo '表示日時：';
        echo '<br>';
        echo $value['date'];
        echo '<br>';
        echo '公開日時：';
        echo '<br>';
        if($value['enddate']){
            echo $value['enddate'];
        }else{
            echo "設定なし";
        }
        echo '<br>';
        echo '本文：';
        echo '<br>';
        echo $value['text'];
        echo '<br>';
        echo '画像：';
        echo '<br>';
        echo '<img src="http://idealump-work.jellybean.jp/image/'.$value['img'].'"/>';
        echo '<br>';
        echo '公開設定：';
        echo '<br>';
        if($value['show_flg'] == 1){
            echo "公開";
        }else{
            echo "非公開";
        }
        echo '<br>';
        echo '<br>';
        $id = $value['id'];
        echo '<form method="post" action="edit.php" value="send">';
        echo '以下のidのデータを編集します';
        echo '<br>';
        echo '<input name="id" value='.$id.'>';
        echo '<input type="submit" value="編集">';
        echo '</form>';
        echo '<form method="post" action="delete.php" value="send">';
        echo '以下のidのデータを削除します';
        echo '<br>';
        echo '<input name="id" value='.$id.'>';
        echo '<input type="submit" value="削除">';
        echo '</form>';
    };
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

?>

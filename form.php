<?php
header('Content-Type: text/html; charset=UTF-8');
echo $_POST["title"];
echo $_POST["date"];
try {
$pdo = new PDO('mysql:host=localhost;dbname=topicsInfo;charset=utf8','idealump','i_want_to_join_idealump',
array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}
?>

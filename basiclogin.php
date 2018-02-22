<?php
$user = 'testuser'; //認証のユーザー設定
$pass = 'testpass'; //認証のパスワード設定

if( $_SERVER["PHP_AUTH_USER"] == $user && $_SERVER["PHP_AUTH_PW"] == $pass ){ //ベーシック認証で入力したユーザー&パスが正しければ
    header("Location: login.php"); //認証成功時の処理
} else {
    header("WWW-Authenticate: Basic realm=\"Please Enter Your Password\""); //違っている場合は認証ダイアログを出す
    header("HTTP/1.0 401 Unauthorized");

    //キャンセル時の表示
    die('このページを見るにはログインが必要です');
}
?>

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
 
?>
 
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
    <title>トップ画面</title>
</head>
 
<body>
<h1>トップ画面</h1>
<p><?php echo $_SESSION['USER'] ?>さんでログイン中</p>
<br>
<form action="form.php" method="post">
<p>
タイトル　※入力必須：<br><input type="title" name="title" size="40" required>
</p>
<p>
公開日　※入力必須：<br><input type="date" name="date" required>
</p>
<p>
公開期限：<br><input type="date" name="enddate">
</p>
<p>
本文　※入力必須：<br>
<textarea name="text" rows="4" cols="40" required></textarea>
</p>
<p>
画像ファイル　※入力必須：<br><input type="file" name="img" required>
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

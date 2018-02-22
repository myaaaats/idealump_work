<?php
 
    session_start();
 
    //ログイン済みかを確認
    if (isset($_SESSION['USER'])) {
        header('Location: top.php');
        exit;
    }
 
    //ログイン機能
    $message = '';
    if(isset($_POST['login'])){
        if ($_POST['email'] == 'test@test.jp' && $_POST['password'] == 'idealump'){ // ③
 
            $_SESSION["USER"] = 'idealump';
            header("Location: top.php");
            exit;
        }
        else{
 
            $message = 'メールアドレスかパスワードが間違っています。';
        }
    }
 
?>
 
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
    <title>ログイン機能</title>
</head>
 
<body>
<h1>ログイン機能</h1>
<p style="color: red"><?php echo $message ?></p>
<form method="post" action="login.php">
    <label for="email">メールアドレス</label>
    <input id="email" type="email" name="email">
    <br>
    <label for="password">パスワード</label>
    <input id="password" type="password" name="password">
    <br>
    <input type="submit" name="login" value="ログイン">
</form>
 
</body>
</html>

<?php
    session_start();
    
    header('X-Frame-Options: SAMEORIGIN');

    if(!isset($_SESSION['user'])){
        $_SESSION['message'] = "ログインしなおしてください";
        header('Location: ./login.php');
        die();
    }

        
    if(isset($_SESSION['auth'])){
        $_SESSION['message'] = "Admin account";
        header('Location: ./login.php');
        die();
    }

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メニュー画面</title>
</head>
<body>
    <h2>メニュー画面</h2>
    <p><?php echo htmlspecialchars($_SESSION['user']."さん" ,ENT_QUOTES,'UTF-8'); ?></p>
    <p><?php echo htmlspecialchars($_SESSION['message'] ?? '' ,ENT_QUOTES,'UTF-8'); unset($_SESSION['message']);?></p>
    <a href="logout.php">ログアウト</a><br>
    <a href="check_password.php">パスワードを変更</a><br>
    <a href="check_delete.php">アカウントを削除</a>
</body>
</html>
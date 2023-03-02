<?php
require('db/users.php');

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

if(empty($_SESSION['token'])){
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION['token'] = $token;
}else{
    $token = $_SESSION['token'];
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウントの削除</title>
</head>
<body>

<p>本当にアカウントを削除しますか？</p>



<form action="delete.php" method="POST">

        <input type="hidden" name="token" value=<?php echo htmlspecialchars($token,ENT_COMPAT,'UTF-8'); ?>><br>
        <button type="submit" name="delete_submit">はい</button>

</form>

<form action="menu.php" method="POST">

        <button type="submit" name="no">いいえ</button>

</form>
    

</body>
</html>

<?php
session_start();

header('X-Frame-Options: SAMEORIGIN');

if(@$_SESSION['user'] && $_SESSION['auth']){
    header('Location: ./admin_menu.php');
    die();
}

if(@$_SESSION['user']){
    header('Location: ./menu.php');
    die();
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>


<h2>ログイン</h2>
<?php
    if(isset($_SESSION['message'])){
        echo htmlspecialchars($_SESSION['message'] ,ENT_QUOTES,'UTF-8');
        unset($_SESSION['message']);
    } 
?>


<form action="checkuser.php" method="POST">
    <p>mail:</p>
    <input type="mail" name="mail" id="mail" required>
    <p>password</p>
    <input type="password"  name="password"id="password">
    <br>
    <button type="submit">送信</button>
</form>

<br><a href="sign_up.php">アカウント登録</a>

        
</body>
</html>
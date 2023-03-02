<?php
session_start();

header('X-Frame-Options: SAMEORIGIN');

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録</title>
</head>
<body>

<h2>登録</h2>

<?php  
if(isset($_SESSION['error'])){
    echo '<p style="color: red">'.htmlspecialchars($_SESSION['error'],ENT_QUOTES,'UTF-8').'</p>';
    unset($_SESSION['error']);
}
?>

<form action="register.php" method="POST">
    <p>mail:</p>
    <input type="text" name="mail" id="mail">
    <?php  
    if(isset($_SESSION['mail_error'])){
        echo '<p style="color: red">'.htmlspecialchars($_SESSION['mail_error'],ENT_QUOTES,'UTF-8')."</p>";
        unset($_SESSION['mail_error']);
    }
    ?>
    <p>password</p>
    <input type="password" name="password" id="password">
    <?php  
    if(isset($_SESSION['password_error'])){
        echo '<p style="color: red">'.htmlspecialchars($_SESSION['password_error'],ENT_QUOTES,'UTF-8').'</p>';
        unset($_SESSION['password_error']);
    }
    ?>
    <br>
    <button type="submit">送信</button>

</form>


</body>
</html>
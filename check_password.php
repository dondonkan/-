<?php

session_start();

header('X-Frame-Options: SAMEORIGIN');

if(empty($_SESSION['token'])){
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION['token'] = $token;
}else{
    $token = $_SESSION['token'];
}

if(!isset($_SESSION['user'])){
    $_SESSION['message'] = "ログインしていません";
    header('Location: login.php');
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
    <title>パスワードを変更</title>
</head>
<body>
    <h2>パスワードを変更</h2>
    
    <form action="update_password.php" method="POST">
        <p>現在のパスワード:</p>
        <input type="text" name="previous_password" id="previous_password">
        <?php  
        if(isset($_SESSION['previous_password_error'])){
            echo '<p style="color: red">'.htmlspecialchars($_SESSION['previous_password_error'],ENT_QUOTES,'UTF-8').'</p>';
            unset($_SESSION['previous_password_error']);
        }
        ?>
        <p>新しいパスワード：</p>
        <input type="password" name="new_password" id="new_password">
        <?php  
        if(isset($_SESSION['new_password_error'])){
            echo '<p style="color: red">'.htmlspecialchars($_SESSION['new_password_error'],ENT_QUOTES,'UTF-8').'</p>';
            unset($_SESSION['new_password_error']);
        }
        ?>
        <p>もういちど新しいパスワードを入力してください：</p>
        <input type="password" name="check_new_password" id="check_new_password">
        <?php  
        if(isset($_SESSION['check_new_password_error'])){
            echo '<p style="color: red">'.htmlspecialchars($_SESSION['check_new_password_error'],ENT_QUOTES,'UTF-8').'</p>';
            unset($_SESSION['check_new_password_error']);
        }
        ?>
        <br>
        <input type="hidden" name="token" value=<?php echo htmlspecialchars($token,ENT_COMPAT,'UTF-8'); ?>><br>
        <button type="submit">送信</button>

    </form>
    
</body>
</html>
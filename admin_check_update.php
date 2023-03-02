<?php

require('db/admin.php');
session_start();

header('X-Frame-Options: SAMEORIGIN');

if(!isset($_SESSION['user'])){
    $_SESSION['message'] = "ログインしなおしてください";
    header('Location: ./login.php');
    die();
}

if(!isset($_SESSION['auth'])){
    $_SESSION['message'] = "User account";
    header('Location: ./login.php');
    die();
}

if(empty($_SESSION['token'])){
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION['token'] = $token;
}else{
    $token = $_SESSION['token'];
}

$update_id = filter_input(INPUT_POST,'id_to_update');

$adminobj = new admin();
$adminobj->setId($update_id);
$rows = $adminobj->getUserById();

var_dump($rows);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザアカウントの編集</title>
</head>
<body>
<a href="./user_edit.php">戻る</a>
<form action="admin_update.php" method="POST" onsubmit="return check()">
        <p>mail:</p>
        <input type="text" name="mail" id="mail" value=<?php echo htmlspecialchars($rows['mail'] ,ENT_QUOTES,'UTF-8') ;?> required>
        <?php  
        if(isset($_SESSION['mail_error'])){
            echo htmlspecialchars($_SESSION['mail_error'],ENT_QUOTES,'UTF-8');
            unset($_SESSION['mail_error']);
        }
        ?>
        <p>パスワード：</p>
        <input type="text" name="password" id="password" value=<?php echo htmlspecialchars($rows['password'],ENT_QUOTES,'UTF-8');?> required>
        <?php  
        if(isset($_SESSION['password_error'])){
            echo htmlspecialchars($_SESSION['password_error'],ENT_QUOTES,'UTF-8');
            unset($_SESSION['password_error']);
        }
        ?>

        <input type="hidden" name="id_to_update" value=<?php echo htmlspecialchars($_POST['id_to_update'],ENT_QUOTES,'UTF-8'); ?>><br>
        <input type="hidden" name="token" value=<?php echo htmlspecialchars($token,ENT_COMPAT,'UTF-8'); ?>><br>
        <button type="submit" name="update_submit">送信</button>

    </form>
    
    <script>
        var pre_mail=""
        var pre_password="";

        window.onload = function (){
            mail = document.getElementById('mail');
            pre_mail = mail.getAttribute('value');
            console.log(pre_mail);
            password = document.getElementById('password');
            pre_password = password.getAttribute('value');
            console.log(pre_password);
        }


        function check(){
            var update_mail = document.getElementById('mail').value;
            var update_password = document.getElementById('password').value;


            var message = '次のように変更しますか？\n\n' + 'mail:\n' +pre_mail+ ' >>> ' + update_mail + '\n\n' +'password:\n' + pre_password + ' >>> ' + update_password;

            clear = confirm(message);
            // アラートで「OK」を選んだ時
            if (clear == true){
                
            }else{
                return false;
            }
        }



    </script>
</body>
</html>
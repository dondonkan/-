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

if(empty(@$_SESSION['token'])){
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION['token'] = $token;
}else{
    $token = $_SESSION['token'];
}


$delete_id = filter_input(INPUT_POST,'id_to_delete');

$adminobj = new admin();
$adminobj->setId($delete_id);
$rows = $adminobj->getUserById();




?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザアカウントの削除</title>
</head>
<body>

<p>本当に次のユーザーを削除しますか？</p>

<p><?php echo htmlspecialchars("mail: ".$rows['mail'] , ENT_QUOTES,'UTF-8');?></p>
<p><?php echo htmlspecialchars("password: ".$rows['password'],ENT_QUOTES,'UTF-8');?></p>

<form action="admin_delete.php" method="POST">

        <input type="hidden" name="id_to_delete" value=<?php echo htmlspecialchars($_POST['id_to_delete'],ENT_QUOTES,'UTF-8'); ?>><br>
        <input type="hidden" name="token" value=<?php echo htmlspecialchars($token,ENT_COMPAT,'UTF-8'); ?>><br>
        <button type="submit" name="delete_submit">はい</button>

</form>

<form action="user_edit.php" method="POST">

        <button type="submit" name="no">いいえ</button>

</form>
    

</body>
</html>
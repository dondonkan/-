<?php


require('db/admin.php');
session_start();

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

$token = filter_input(INPUT_POST,'token');

if(empty($_SESSION['token']) || !hash_equals(@$_SESSION['token'] ,$token)){

    die();
}


$mail = filter_input(INPUT_POST,'mail');
$password = filter_input(INPUT_POST,'password');
$update_id = filter_input(INPUT_POST, 'id_to_update'); 

if(empty($mail)){
    $_SESSION['mail_error'] = "メールアドレスを入力してください";
}

if(empty($password)){
    $_SESSION['password_error'] = "パスワードを入力してください";
}

if(empty($mail) || empty($password)){
    header('Location: admin_check_update.php');
    die();
}

$update_pass = password_hash($password,PASSWORD_DEFAULT);

$adminobj = new admin();
$adminobj->setMail($mail);
$adminobj->setPassword($update_pass);
$adminobj->setId($update_id);
$adminobj->update();


$_SESSION['message'] = "ユーザーの編集に成功しました";
header('Location: user_edit.php');
die();



?>

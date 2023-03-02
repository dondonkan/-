<?php

require('db/db_access.php');
require('db/users.php');
require('validate.php');

session_start();


$create_user =  trim(filter_input(INPUT_POST,'mail'));
$create_pass = trim(filter_input(INPUT_POST,'password'));

if(empty($create_user)){
    $_SESSION['mail_error'] = "メールアドレスを入力してください";
}

if(!filter_var($create_user, FILTER_VALIDATE_EMAIL)){
    $_SESSION['mail_error'] = "メールアドレスを入力してください no";   
}

if(empty($create_pass)){
    $_SESSION['password_error'] = "パスワードを入力してください";
}

if(!preg_match('/^[a-zA-Z0-9]{8,}$/',$create_pass)){
     $_SESSION['password_error'] = '8文字以上のパスワードを登録してください';
}

if($create_user === $create_pass){
    $_SESSION['error'] = "メールアドレスとパスワードを同じにしないでください";
}

if(empty($create_user) || empty($create_pass) ||
   isset($_SESSION['mail_error']) || isset($_SESSION['password_error'])||
   isset($_SESSION['error'])){
    header('Location: sign_up.php');
    die();
}





$userobj = new users();
$userobj->setMail($create_user);
$userData = $userobj->getUserByMail();

if($userData['mail'] === $create_user){
    $_SESSION['error'] = "同一のユーザーが存在します";
    header('Location: ./sign_up.php');
    die();
}

if(isset($create_user) && isset($create_pass)){

    //データベースアクセス　insert
    $userobj->setMail($create_user);
    $userobj->setPassword($create_pass);

    $userobj->create_user();

    $_SESSION['message']='ユーザーの作成に成功しました';

    if($_SESSION['auth']){
        header('Location: ./user_edit.php');
        die();
    }

    header('Location: ./login.php');
}




?>

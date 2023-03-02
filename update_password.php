<?php

require('db/users.php');
session_start();

$check_password = trim(filter_input(INPUT_POST,'previous_password'));
$new_password = trim(filter_input(INPUT_POST,'new_password'));
$check_new_password = trim(filter_input(INPUT_POST,'check_new_password'));


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


$token = filter_input(INPUT_POST,'token');

if(empty($_SESSION['token']) || !hash_equals(@$_SESSION['token'] ,$token)){
    header('Location: ./login.php');
    die();
}

if(empty($check_password)){
    $_SESSION['previous_password_error'] = "パスワードを入力してください";
}

if(empty($new_password)){
    $_SESSION['new_password_error'] = "パスワードを入力してください";
}

if(empty($check_new_password)){
    $_SESSION['check_new_password_error'] = "パスワードを入力してください";
}


if(isset($_SESSION['previous_password_error']) || isset($_SESSION['new_password_error']) || isset($_SESSION['check_new_password_error'])){
    header('Location: check_password.php');
    die();
}

$userobj = new users();
$userobj->setMail($_SESSION['user']);
$userData = $userobj->getUserByMail();

//現在のパスワードの確認

if(isset($check_password)){
    if(!password_verify($check_password, $userData['password'])){
        $_SESSION['previous_password_error'] = "現在のパスワードが違います";
        header('Location: ./check_password.php');
        die();
    }
}

if(isset($new_password) && isset($check_new_password)){
    if($new_password !== $check_new_password){        

            $_SESSION['check_new_password_error'] = "パスワードが間違っています";
            header('Location: check_password.php');
            die();

    }

}

//新しく登録するパスワードのバリデーション

if(!preg_match('/^[a-zA-Z0-9]{8,}$/',$new_password)){
    $_SESSION['new_password_error'] = '8文字以上のパスワードを登録してください';
    header('Location: check_password.php');
    die();
}

if($_SESSION['user'] === $check_new_password){
    $_SESSION['new_password_error'] = "メールアドレスとパスワードを同じにしないでください";
    header('Location: check_password.php');
    die();
}


//新しいパスワードに変更

$userobj->setPassword($check_new_password);
$userobj->update_password();

$_SESSION['message']='パスワードの変更に成功しました';

if($_SESSION['auth']){
    header('Location: ./admin_menu.php');
    die();
}else{
    header('Location: ./menu.php');
    die();
}


?>

<?php


require('db/users.php');

session_start();

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
    die();
}


$userobj = new users();
$userobj->setMail($_SESSION['user']);
$userData = $userobj->getUserByMail();


$delete_user =  htmlspecialchars($_SESSION['user'] ,ENT_QUOTES,'UTF-8');


if($userData['mail'] === $_SESSION['user']){

    //データベースアクセス check
    if($userobj->delete_user()){
        $_SESSION['message'] = "アカウントの削除に失敗しました";
        header('Location: ./menu.php');
        die();
    }

    $_SESSION = array();
    session_destroy();

    header('Location: ./login.php');
    die();
}

?>
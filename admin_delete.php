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


$delete_id = filter_input(INPUT_POST, 'id_to_delete'); 

if(empty($delete_id)){
    header('Location: admin_check_delete.php');
    die();
}

$adminobj = new admin();
$adminobj->setId($delete_id);
$adminobj->delete();


$_SESSION['message'] = "ユーザーの削除に成功しました";
header('Location: user_edit.php');
die();
?>

<?php 

session_start();

header('X-Frame-Options: SAMEORIGIN');

if(!isset($_SESSION['user'])){
    $_SESSION['message'] = "ログインしていません";
    header('Location: ./login.php');
    die();
}


$_SESSION = array();

session_destroy();

session_regenerate_id(TRUE);

header('Location: ./login.php');
exit();

?>
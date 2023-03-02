<?php 
require('db/users.php');

session_start();

date_default_timezone_set('Asia/Tokyo');

const FAIL_LOCK_COUNT = 3;
const UNLOCK_LOGIN_TIME = 30;

$login_user =  trim(filter_input(INPUT_POST,'mail'));
$login_pass = trim(filter_input(INPUT_POST,'password'));


if(empty($login_user) || empty($login_pass)){
    header('Location: login.php');
    die();
}

$userobj = new users();

$userobj->setMail($login_user);
$userobj->setPassword($login_pass);
$userData = $userobj->getUserByMail();

if(is_array($userData) && count($userData) > 0){

    //ログイン試行回数が3回以上でアカウントロック
    if($userData['fail_count'] >= FAIL_LOCK_COUNT){

        //time
        $now_time = date("Y-m-d H:i:s");

        $fail_time = $userData['fail_time'];

        $d1 = strtotime($now_time);
        $d2 = strtotime($fail_time);

        $difsecond = $d1 - $d2;

        $difminiute =  ($difsecond - ($difsecond % 60)) / 60;

        //アカウントロックされてから設定した時間を経過していなかったらログイン画面に戻す
        if($difminiute < UNLOCK_LOGIN_TIME){

            $_SESSION['message'] = "LOCK 30min";
            header('Location: login.php');
            die();
        
        }

    }

    // passwordはあってないけどmailはあってる　
    if($userData['mail'] === $login_user &&
        !password_verify($login_pass,$userData['password'])){

        $failcount = $userData['fail_count'] + 1;
        $id = $userData['id'];
        $time = date('Y-m-d H:i:s');

        $userobj->setFail_count($failcount);
        $userobj->setId($id);
        $userobj->setFail_time($time);

        $userobj->countUp_fail();


        $_SESSION['message'] = "ログインに失敗しました";
        header('Location: ./login.php');
        die();
    }

    //ログイン処理

    if($userData['mail'] === $login_user &&
        password_verify($login_pass , $userData['password']) && 
        $userData['auth_type'] === 1){

        $failcount = 0;
        $time = NULL;
        $id = $userData['id'];

        $userobj->setFail_count($failcount);
        $userobj->setId($id);
        $userobj->setFail_time($time);

        $userobj->update_time();

        $_SESSION['message'] = "ログインに成功しました！";
        $_SESSION['user'] = $userData['mail'];
        $_SESSION['auth'] = true;

        session_regenerate_id(TRUE);

        header('Location: ./admin_menu.php');
        die();

    }

    if($userData['mail'] === $login_user &&
        password_verify($login_pass , $userData['password']) &&
        $userData['auth_type'] !== 1){


        $failcount = 0;
        $time = NULL;
        $id = $userData['id'];

        $userobj->setFail_count($failcount);
        $userobj->setId($id);
        $userobj->setFail_time($time);

        $userobj->update_time();


        $_SESSION['message'] = "ログインに成功しました！";
        $_SESSION['user'] = $userData['mail'];

        session_regenerate_id(TRUE);

        header('Location: ./menu.php');
        die();

    }else{

        $_SESSION['message'] = "ログインに失敗しました";
        header('Location: ./login.php');
        die();
    }

}else{
    $_SESSION['message'] = "ログインに失敗しました";
    header('Location: ./login.php');
    die();
}

?>

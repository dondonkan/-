<?php 


require('db/admin.php');

session_start();

if(!isset($_SESSION['user'])){
    $_SESSION['message'] = "ログインしなおしてください";
    header('Location: ./login.php');
    die();
}


if(!isset($_SESSION['auth'])){
    $_SESSION['message'] = "Admin account";
    header('Location: ./login.php');
    die();
}

$adminobj = new admin();
$rows = $adminobj->show_table();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザーアカウントの編集</title>

    <style>
    table,td {
        border: 1px solid #333;
    }

    thead,tfoot {
        background-color: #333;
        color: #fff;
    }

    </style>

</head>
<body>
    
    <h2>ユーザーアカウントの編集</h2>
    <?php 
    if(isset($_SESSION['message'])){echo htmlspecialchars($_SESSION['message'],ENT_QUOTES,'UTF-8').'<br>';} 
    unset($_SESSION['message']); 
    ?>
    <a href="./admin_menu.php">メニューへ戻る</a>
    <a href="./sign_up.php">ユーザーの作成</a>


<table class="table">
    <thead>
      <tr>
        <th colspan="1">no</th>
        <th colspan="1">メール</th>
        <th colspan="1">パスワード</th>
        <th colspan="1">Operation</th>
      </tr>
    </thead>
<?php 

$number = 1;

foreach($rows as $row){

    // if($row['auth_type'] == 1){
    //     continue;
    // }

    $id= htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8');
    $mail= htmlspecialchars($row['mail'],ENT_QUOTES,'UTF-8');
    $password= htmlspecialchars($row['password'],ENT_QUOTES,'UTF-8');

    echo'<tr>
        <td>'.$number.'</td>
        <td>'.$mail.'</td> 
        <td>'.$password.'</td> 
        <td>
        <form action="admin_check_update.php" method="POST">
            <input type="hidden" name="id_to_update" value='.$id.'>
            <button type="submit" name="Update" value="Update">Updete</button>
        </form>
        <form action="admin_check_delete.php" method="POST">
            <input type="hidden" name="id_to_delete" value='.$id.'>
            <button type="submit" name="Delete" value="Delete">Delete</button>
        </form>
        </td>
        </tr>';
    $number++;
}
?>


</table>


</body>
</html>
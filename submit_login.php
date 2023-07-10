<?php
require('./connection.inc.php');
require('./functions.inc.php');

$showroom_code=get_safe_value($con, $_POST['showroom_code']);
$password=get_safe_value($con, $_POST['password']);

$res = mysqli_query($con, "SELECT * from users where showroom_code='$showroom_code'");
// $_SESSION['user_login']=true;


$check_user = mysqli_num_rows($res);
if($check_user > 0){
    $row = mysqli_fetch_assoc($res);
    $verify=password_verify($password, $row['password']);
    if($verify==1){
        $_SESSION['user_login']=true;
        $_SESSION['showroom_code']=$row['showroom_code'];
        $_SESSION['party_code']=$row['party_code'];
        $_SESSION['user_name']=$row['user_name'];
        echo "valid";
    }else{
        echo "wrong";
    }
    
}else{
    echo "wrong";
}

?>
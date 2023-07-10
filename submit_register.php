<?php
require('connection.inc.php');
require('functions.inc.php');

$user_name=get_safe_value($con, $_POST['user_name']);
$email=get_safe_value($con, $_POST['email']);
$mobile=get_safe_value($con, $_POST['mobile']);
$showroom_code=get_safe_value($con, $_POST['showroom_code']);
$party_code=get_safe_value($con, $_POST['party_code']);
$password=get_safe_value($con, $_POST['password']);

$check_user = mysqli_num_rows(mysqli_query($con, "SELECT * from users where email='$email'"));
if($check_user > 0){
    echo "email_present";
}else{
    $password = password_hash($password, PASSWORD_DEFAULT);
    $update_at= date('d-m-y');
    mysqli_query($con, "insert into users (user_name, email, mobile,showroom_code,party_code, password, update_at) values('$user_name', '$email', '$mobile', '$showroom_code', '$party_code', '$password', '$update_at')");
    echo "insert";
}

?>
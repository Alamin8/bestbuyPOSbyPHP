<?php
require('connection.inc.php');
require('functions.inc.php');
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

$request = $_SERVER['REQUEST_URI'];
$router = str_replace('/web', '', $request);

if (false !== strpos($url, '.php')) {
    require('./declined.php');
    die();
} else {
    if (empty($_SESSION['user_login']) || $_SESSION['user_login'] == '') {
        if ($router == '/' || $router == '/login') {
            include('user_login.php');
        }elseif ($router == '/forgotten_password') {
            include('user_forgot_password.php');
        } elseif ($router == '/register') {
            include('register.php');
        } else {
            include('404.php');
        }
    } else if (isset($_SESSION['user_login']) || $_SESSION['user_login'] != '') {
        if ($router == '/' || $router == '/dashboard') {
            include('dashboard.php');
        } elseif ($router == '/invoice') {
            include('invoice.php'); 
        }elseif ($router == '/session_destry') {
            include('session_destry.php'); 
        }elseif ($router == '/account') {
            include('account.php');
        }elseif ($router == '/change-password') {
            include('change-password.php');
        }elseif ($router == '/update-user') {
            include('update-user.php');
        }elseif ($router == '/account-status') {
            include('account-status.php');
        }elseif ($router == '/action') {
            include('action.php');
        } elseif ($router == '/logout') {
            include('.logout.php');
        }elseif ($router == '/TI') {
            include('./TI.php');
        } else {
            include('404.php');
        }
    } else {
        include('404.php');
    }
}




























// if(isset($_SESSION['user_login']) || $_SESSION['user_login'] !=''){
//     if($router=='/' || $router=='/dashboard'){
//         include('dashboard.php');
//     }elseif($router=='/invoice'){
//         include('invoice.php');
//     }elseif($router=='/logout'){
//         include('.logout.php');
//     }else{
//         include('404.php');
//     }
// }else{
//     if($router=='/' || $router=='/login'){
//         include('user_login.php');
//     }elseif($router == '/register'){
//         include('user_register.php');
//     }elseif($router == '/forgotten_password'){
//         include('user_forgot_password.php');
//     }else{
//         include('404.php');
//     }
// }

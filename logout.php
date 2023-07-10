<?php
require('connection.inc.php');
require('functions.inc.php');
unset($_SESSION['user_login']);
unset($_SESSION['showroom_code']);
unset($_SESSION['party_code']);
unset($_SESSION['user_name']);
header('location: https://bbsapp.000webhostapp.com/web/login');
die();

?>
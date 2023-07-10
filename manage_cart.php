<?php
require('./connection.inc.php');
require('./functions.inc.php');
require('../Alamin/add_to_cart.inc.php');

$pid = get_safe_value($con, $_POST['pid']);
// $qty = get_safe_value($con, $_POST['qty']);
// $type = get_safe_value($con, $_POST['type']);


$obj = new add_to_cart();

if($pid !=""){
    $obj->addProduct($pid, 1);
    echo "done";
}else{
    echo "";
}


?>
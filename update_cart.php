<?php
require('./connection.inc.php');
require('./functions.inc.php');
require('../Alamin/add_to_cart.inc.php');

$pid = get_safe_value($con, $_POST['pid']);
$qty = get_safe_value($con, $_POST['qty']);


$obj = new add_to_cart();

if($pid !=""){
    $obj->updateProduct($pid, $qty);
    echo "Updated";
}else{
    echo "";
}

?>
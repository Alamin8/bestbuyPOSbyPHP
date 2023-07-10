<?php
require('./connection.inc.php');
require('./functions.inc.php');
require('../Alamin/add_to_cart.inc.php');

$pid = get_safe_value($con, $_POST['pid']);

$obj = new add_to_cart();

if($pid !=""){
    $obj->removeProduct($pid);
    echo "Deleted";
}else{
    echo "";
}

?>
<?php
require('connection.inc.php');
require('functions.inc.php');

$order_id=get_safe_value($con, $_POST['order_id']);
$oc_date=get_safe_value($con, $_POST['oc_date']);
$deport=get_safe_value($con, $_POST['deport']);
$showroom_code=get_safe_value($con, $_POST['showroom_code']);
$party_code=get_safe_value($con, $_POST['party_code']);
$outlet_mobile=get_safe_value($con, $_POST['outlet_mobile']);
$note=get_safe_value($con, $_POST['note']);
$customer_mobile=get_safe_value($con, $_POST['customer_mobile']);
$total_payment=get_safe_value($con, $_POST['total_payment']);
$discountTK=get_safe_value($con, $_POST['discountTK']);
$loyality_member_name=get_safe_value($con, $_POST['loyality_member_name']);
$loyality_point=get_safe_value($con, $_POST['loyalityPointNow']);

if($showroom_code){
    mysqli_query($con, "insert into `order_invoice` (order_id, oc_date, deport, showroom_code, party_code, outlet_mobile, note , customer_mobile, total_payment, discount , loyality_member_name, loyality_point) values('$order_id', '$oc_date', '$deport', '$showroom_code', '$party_code', '$outlet_mobile', '$note', '$customer_mobile', '$total_payment', '$discountTK', '$loyality_member_name', '$loyality_point')");
    echo "insert";
}

?>

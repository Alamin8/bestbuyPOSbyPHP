<?php
require('./connection.inc.php');
require('./functions.inc.php');

$search_code= (isset($_POST['itemcode']) ? $_POST['itemcode'] : '');
$search_term= (isset($_POST['product']) ? $_POST['product'] : '');

// $search_code = $_POST['itemcode'];
// $search_term = $_POST['product'];

if($search_code !=''){
    $sql = "SELECT * FROM products WHERE item_code LIKE '%{$search_code}%'";
    $result = mysqli_query($con, $sql) or die("SQL Query Failed");
}

if($search_term !=''){
    $sql = "SELECT * FROM products WHERE product_name LIKE '%{$search_term}%'";
    $result = mysqli_query($con, $sql) or die("SQL Query Failed");
}






$output = "<ul>";

    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $rowId = $row['id'];
            $output .= "<li onclick=manage_cart($rowId)><span>{$row['product_name']}</span><span class='item_code_sb'>{$row['item_code']}</span><span class='mrp_sb'>{$row['mrp']} TK</span> </li>";
        }
    }else{
        $output .= "<li>Not Found</li>";
    }
    $output .= "</ul>";
echo $output;
?>
<!-- distinct(product_name) -->
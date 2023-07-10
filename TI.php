<?php

if (isset($_POST['TIsubmit'])) {
        $files = $_FILES['doc']['tmp_name'];
        $ext = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);

        
        if ($ext == 'xlsx' || $ext == 'xls') {
    
            require('./assests/phplibrary/PHPExcel.php');
            require('./assests/phplibrary/PHPExcel/IOFactory.php');
    
            $obj = PHPExcel_IOFactory::load($files);
            foreach ($obj->getWorksheetIterator() as $sheet) {
                $getHighestRow = $sheet->getHighestRow();
                for ($i = 0; $i < $getHighestRow; $i++) {
                    $product_group = $sheet->getCellByColumnAndRow(0, $i)->getValue();
                    $product_class = $sheet->getCellByColumnAndRow(1, $i)->getValue();
                    $item_code = $sheet->getCellByColumnAndRow(2, $i)->getValue();
                    $product_name = $sheet->getCellByColumnAndRow(3, $i)->getValue();
                    $vendor_name = $sheet->getCellByColumnAndRow(4, $i)->getValue();
                    $mrp = $sheet->getCellByColumnAndRow(5, $i)->getValue();
                    $barcode = $sheet->getCellByColumnAndRow(6, $i)->getValue();
                    $stoc = $sheet->getCellByColumnAndRow(7, $i)->getValue();
                    
                    if($item_code != ''){
                        $res = mysqli_query($con, "SELECT * from products where item_code='$item_code'");
                        $have_any_same_product = mysqli_num_rows($res);
                        if($have_any_same_product > 0){
                            $row = mysqli_fetch_assoc($res);
                            $new_mrp= $row['mrp'];
                            $new_stoc = $row['stoc'] +$stoc;

                            // echo "<pre>";
                            // echo $new_stoc;
                            if(mysqli_query($con, "UPDATE products SET product_group='$product_group', product_class='$product_class', product_name='$product_name', vendor_name='$vendor_name', stoc='$new_stoc', mrp='$new_mrp', barcode='$barcode' WHERE item_code='$item_code'")){
                                echo "Updated successfull";
                            }else{
                                echo "Updated Problem";
                            }
                        }else{
                            if(mysqli_query($con, "insert into products (item_code, product_group, product_class , barcode , product_name , vendor_name ,stoc, mrp) values ('$item_code', '$product_group', '$product_class', '$barcode', '$product_name' , '$vendor_name', '$stoc', '$mrp')")){
                                echo "upload successfull";
                            }else{
                                echo "upload Problem";
                            }
                            
                        }
                    }else{
                        echo "not find item code";
                    }

                }
            }
            
        }else{
            echo "Unsupported Formet";
          
        }
        header("Location: https://bbsapp.000webhostapp.com/web/dashboard");
}
    

?>
<!DOCTYPE html>
<html lang="en">
<?php require('./partials/header.php'); ?>

<body>
    <?php require('./partials/navbar.php'); ?>


    <form  class="transfer_in" method="POST" enctype="multipart/form-data">
        <div class="ti_top">
            <div class="ti_top_left">
                <div class="ti_top_con">
                    <div class="ti_comon">
                        <p>Company Name:</p>
                        <select>
                            <option value="" selected>DLCL</option>
                        </select>
                    </div>
                    <div class="ti_comon">
                        <p>Deport:</p>
                        <select>
                            <option value="" selected>BBUY JAMGORA ASHULIA</option>
                        </select>
                    </div>
                    <div class="ti_comon">
                        <p>Type:</p>
                        <select>
                            <option value="" selected>Post Delevery</option>
                            <option value="">Cash On Delevery</option>
                        </select>
                    </div>
                    <div class="ti_comon">
                        <p>OC Number:</p>
                        <input type="file" name="doc" id="uploadTIFile">
                    </div>
                </div>
                <div class="ti_top_btn">
                    <textarea name="" id=""> item_code, product_name, product_group, stoc, mrp </textarea>
                    <button class="add_entries" >Add All Entries</button>
                </div>
            </div>
            <div class="ti_top_right">
                <p>Transfer In (TI)</p>
            </div>
        </div>
        <div class="ti_middle">
        <table class="invoiceTable">
                        <tr class="tableHead">
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>Qnty</th>
                            <th>Rate</th>
                            <th>Total</th>
                            <th>D%</th>
                            <th>DTK</th>
                            <th>SD</th>
                            <th>STOC</th>
                            <th>S</th>
                            <th>IMEI NO</th>
                        </tr>
                        
                    </table>
        </div>
        <div class="ti_bottom">
            <button class="entry_btn add_entries" type="button">Add New</button>
            <button class="entry_btn add_entries" type="submit"  name="TIsubmit">Save</button>
        </div>
    </form>

    <?php require('./partials/footer.php'); ?>
    <script src="./main.js"></script>
</body>

</html>
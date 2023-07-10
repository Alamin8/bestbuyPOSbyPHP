<?php
require('./restrict.php');
// echo '<pre>';
// print_r($_SESSION);
$cart_total_price = 0;
$total_qty = 0;
if(isset($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $key => $val) {
        $sql = "SELECT * FROM products WHERE id=$key";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);
    
        $PID = $row['id'];
        $PQTY = $_SESSION['cart'][$PID]['qty'];
        $PPRICE = $row['mrp'];
        $PTOTAL = $PQTY * $PPRICE;
        $cart_total_price = $cart_total_price + $PTOTAL;
        $total_qty = $total_qty + $PQTY;
    }
}

?>

<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Buy POS - Invoice</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../Alamin/js/jquary.js" ></script>
</head>

<body onload="initClock()">
    <section class="dashboard" id="invoice">
        
        <div class="dash_head invoice_head">
            <p><img src="./assests/images/invoice.png"> <span> Direct Sales</span></p>
        </div>
        <div class="someMargin"></div>
        <div class="dash_body" id="invoice_body">
            <div class="invoice_body_lt">
                <div class="invoice_panel">
                    <div class="invoice_panel_row">
                        <label for="" class="panel_row_label">Company</label>
                        <div class="panel_row_mix">
                            <select class="companyName selectTag">
                                <option selected>DLCL</option>
                            </select>
                            <label class="labelTag">OC Date</label>
                            <p class="selectTag ocdate" id="oc_date"><span id="curr_date">00/00/0000</span><span id="curr_time">00:00 AM</span></p>
                            <select class="computerN selectTag">
                                <option selected>COM5</option>
                            </select>
                            <label class="labelTag sexecutive">S. Executive</label>
                            <select class="sexecutiveId selectTag">
                                <option selected></option>
                            </select>
                        </div>
                    </div>
                    <div class="invoice_panel_row">
                        <label for="" class="panel_row_label">Depot</label>
                        <div class="panel_row_mix">
                            <select class="depotName selectTag" id="deport">
                                <option selected value="<?php echo (isset($_SESSION) ? $_SESSION['user_name']: '') ?>"><?php echo (isset($_SESSION) ? $_SESSION['user_name']: '') ?></option>
                            </select>
                            <label class="labelTag salesIdName">Sales Id</label>
                            <select class="salesId selectTag" id="showroom_code_sb">
                                <option selected value="<?php echo (isset($_SESSION) ? $_SESSION['showroom_code']: '') ?>"><?php echo (isset($_SESSION) ? $_SESSION['showroom_code']: '') ?></option>
                            </select>
                            <label class="labelTag ">Fiter Man</label>
                            <select class="fiterMan selectTag">
                                <option selected></option>
                            </select>
                        </div>
                    </div>
                    <div class="invoice_panel_row">
                        <label for="" class="panel_row_label">Distributer</label>
                        <div class="panel_row_mix">
                            <select class="distributeCode selectTag" id="party_code_sub">
                                <option selected value="<?php echo (isset($_SESSION) ? $_SESSION['party_code']: '') ?>"><?php echo (isset($_SESSION) ? $_SESSION['party_code']: '') ?></option>
                            </select>
                            <select class="distributerName selectTag">
                                <option selected value="<?php echo (isset($_SESSION) ? $_SESSION['user_name']: '') ?>"><?php echo (isset($_SESSION) ? $_SESSION['user_name']: '') ?></option>
                            </select>
                            <input type="checkbox" class="dcheck">
                            <label class="labelTag ">D Date</label>
                            <select class="dDate selectTag">
                                <option selected ></option>
                            </select>
                        </div>
                    </div>
                    <div class="invoice_panel_row">
                        <label for="" class="panel_row_label">Note</label>
                        <div class="panel_row_mix">
                            <input type="text" class="note selectTag focusInputfields" id="invoiceNote">
                            <label class="labelTag ">Customer</label>
                            <select class="customer selectTag">
                                <option selected>None</option>
                            </select>
                        </div>
                    </div>
                    <div class="invoice_panel_row">
                        <label for="" class="panel_row_label">Pay type</label>
                        <div class="panel_row_mix">
                            <select class="paytype selectTag">
                                <option selected></option>
                            </select>
                            <label class="labelTag ">Customer No</label>
                            <select class="customerN selectTag">
                                <option selected></option>
                            </select>
                            <input type="text" class="customerB selectTag">
                        </div>
                    </div>
                    <div class="invoice_panel_row">
                        <label for="" class="panel_row_label">Customer Id</label>
                        <div class="panel_row_mix">
                            <select class="customerid selectTag">
                                <option selected></option>
                            </select>
                            <p class="CI ocdate">CI</p>
                            <label for="" class="panel_row_label mobileNL">Mobile No</label>
                            <input type="text" class="mobileN selectTag focusInputfields" id="customerMobile">
                            <label for="" class="panel_row_label mobileNL">CN / Email</label>
                            <input type="text" class="email selectTag">
                        </div>
                    </div>
                    <div class="invoice_panel_row">
                        <label for="" class="panel_row_label"></label>
                        <div class="panel_row_mix">
                            <label class="labelTag currentMath ">Current Math</label>
                            <p class="CurrentMathV ocdate">0</p>
                            <label class="labelTag emei">IMEI Help</label>
                            <input type="checkbox" class="dcheck">
                            <label class="labelTag"> D (%)</label>
                            <label class="labelTag Ucode"> U code</label>
                            <p class="CIA ocdate"></p>
                            <p class="CIB ocdate">0</p>
                        </div>
                    </div>
                </div>
                <div class="search_panel" id="autoComplete">
                    <input type="text" class="search_item_code" id="itemCodeOrbarcodeSB" autocomplete="off">
                    <select class="downarrow">
                        <option value=""></option>
                    </select>
                    <input type="text" class="search_item_code search_in_lt" id="itemCodeOrbarcodeorTextSB" autocomplete="off">
                    <select class="downarrowItemValue">
                        <option value=""></option>
                    </select>
                    <button class="addItemBtn">+</button>
                    <button class="addItemBtn addItemBtnR">Refresh</button>
                    <div class="smallaction">
                        <span>SMS</span>
                        <input type="checkbox" class="actionS">
                        <span>V</span>
                        <input type="checkbox" class="actionS">
                        <span>F</span>
                        <input type="checkbox" class="actionS">
                        <span>R & F</span>
                        <input type="checkbox" class="actionS">
                        <span>F</span>
                    </div>
                    <div class="" id="productList"></div>
                </div>
                <div class="invoice_item">
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
                        <tbody class="tbal" id="tbal">
                            <?php

                            if(isset($_SESSION['cart'])){
                                foreach ($_SESSION['cart'] as $key => $val) {
                                    $sql = "SELECT * FROM products WHERE id=$key";
                                    $res = mysqli_query($con, $sql);
                                    $row = mysqli_fetch_assoc($res);
    
                                    $PID = $row['id'];
                                    $PNAME = $row['product_name'];
                                    $PQTY = $_SESSION['cart'][$PID]['qty'];
                                    $PPRICE = $row['mrp'];
                                    $PTOTAL = $PQTY * $PPRICE;
                                    $PSTOC = $row['stoc'];
                                    // echo "<pre>";
                                    // print_r($row)
    
                            ?>
                                <tr class="tableItemList" id="">
                                    <td>
                                        <!-- <p class="selectWholerow"><input type="checkbox" class="itemSelectCheck"></p> -->
                                        <button onclick="OnConfirm('<?php echo $PID; ?>')" class="delBtn">Del</button>
                                        <span> <?php echo "$PID" ?> </span>
                                    </td>
                                    <td><?php echo "$PNAME" ?></td>
                                    <td><input onchange="update_cart('<?php echo $PID; ?>', '<?php echo $PSTOC; ?>',  this.value)" type="number" class="qtyInput" value="<?php echo $PQTY; ?>"></td>
                                    <td><?php echo "$PPRICE" ?></td>
                                    <td><?php echo "$PTOTAL" ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo "$PSTOC" ?></td>
                                    <td></td>
                                    <td>IMEI NO</td>
                                </tr>
                            
                            <?php } } ?>
                            <div id="confirm">
                                <img class="deleteImg" src="./assests/images/delete.png" alt="">
                                <div class="message">Do you want to delete?</div>
                                <br />
                                <div class="btndiv">
                                    <button id="yesBtn">Yes</button>
                                    <button id="noBtn">No</button>
                                </div>
                            </div>
                        </tbody>
                    </table>
                    <div class="grandTotal">
                        <p>Grand Summaries</p>
                        <div class="grandD">
                            <span class="grandQty"><?php if ($total_qty > 0) {
                                                        echo $total_qty;
                                                    } else {
                                                        echo 0;
                                                    } ?></span>
                            <span class="granTotal" ><?php if ($cart_total_price > 0) {
                                                        echo $cart_total_price;
                                                    } else {
                                                        echo 0;
                                                    } ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="invoice_body_rt">
                <div class="freeItem">
                    <table class="freeItemTable">
                        <tr class="freeitemHead">
                            <th>*</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Sel</th>
                        </tr>
                        <tbody class="tbodySr">
                            <tr class="freeitemlist">
                                <td>*</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="checkbox" class="freeselect"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="billing">
                    <div class="row1">
                        <span class="search_code">Search code</span>
                        <span class="Bcount">Count: 0</span>
                        <span class="invoiceNo">Inv No.</span>
                        <select class="inv">
                            <option value="" selected>OC12729-01-2208001293</option>
                            <option value="">OC12729-01-2208001293</option>
                            <option value="">OC12729-01-2208001293</option>
                            <option value="">OC12729-01-2208001293</option>
                            <option value="">OC12729-01-2208001293</option>
                            <option value="">OC12729-01-2208001293</option>
                            <option value="">OC12729-01-2208001293</option>
                        </select>
                    </div>
                    <div class="row2">
                        <p class="bdate">24/07/2022 06.15 PM</p>
                        <button class="sameBillbtn f9BTN">Print (F9)</button>
                        <button class="sameBillbtn F3BTN">Search (F3)</button>
                        <button class="sameBillbtn">New Invoice (F7)</button>
                    </div>
                    <div class="row3">
                        <button class="sameBillbtn">Loyality</button>
                        <button class="sameBillbtn">Warranty</button>
                        <button class="sameBillbtn">Gift Transfer</button>
                        <button class="sameBillbtn">Cancel</button>
                        <button class="sameBillbtn">Calculate (F8)</button>
                    </div>
                    <div class="row4">
                        <p class="posI"><input type="checkbox" checked> <span>POS</span></p>
                        <p class="cardName" id="loyality_member_name"></p>
                    </div>
                    <div class="row5">
                        <label for="" class="pointsnow">Points Now</label>
                        <textarea class="pointsvalue1" id="loyalityPointNow" disabled><?php if ($cart_total_price > 0) {echo $cart_total_price/100;} else {echo 0;} ?></textarea>
                        <label for="" class="loyalityNo">Loyality No.</label>
                        <input type="text" class="loyalitymobile focusInputfields">
                    </div>
                    <div class="row6">
                        <label for="" class="recevamt">Recevied Amount</label>
                        <input type="number" name="" id="customerReceivedAmount" class="recvamtVal focusInputfields">
                    </div>
                    <div class="row7">
                        <label for="" class="cashopt"> Cash</label>
                        <select class="selectCashop">
                            <option value="" selected>Cash</option>
                        </select>
                        <span class="acceptAmnt" id="cashAmountTK">0</span>
                    </div>
                    <div class="row8">
                        <p class="allhpcard"><input type="checkbox" class="Hpcheck"><span class="hplab">HP</span></p>
                        <label for="" class="hpcard">HP/Card</label>
                        <select class="hpcardselect">
                            <option value="" selected>Card</option>
                        </select>
                        <label type="number" class="hpcardVal focusInputfields" id="cardsale"></label>
                    </div>
                    <div class="row9">
                        <label for="" class="corporate">Corporate</label>
                        <select name="" class="corporateS" id="">
                            <option value=""></option>
                        </select>
                        <label for="" class="cardNo">Card No</label>
                        <input type="number" class="cardNoVal focusInputfields">
                    </div>
                    <div class="row10">
                        <label for="" class="billreturn">Return</label>
                        <select name="" class="returnSel" id="">
                            <option value=""></option>
                        </select>
                        <input type="number" class="returnbilVal focusInputfields">
                    </div>
                    <div class="row11">
                        <label for="" class="Lpoint">L point</label>
                        <span class="pointsvalue3">0</span>
                        <label for="" class="amnt">Amnt</label>
                        <span class="amntval">0</span>
                        <input type="number" class="amntamnutvalue focusInputfields">
                    </div>
                    <div class="row12">
                        <span class="blankDiv"></span>
                        <span class="Vauchlabel">Vaucher</span>
                        <input type="number" class="vaucherAmntVal focusInputfields">
                    </div>
                    <div class="row13">
                        <label for="" class="Lpoint">G point</label>
                        <span class="pointsvalue2">0</span>
                        <label for="" class="amnt">Amnt</label>
                        <span class="amntval">0</span>
                        <input type="number" class="amntamnutvalue focusInputfields">
                    </div>
                    <div class="row14">
                        <label for="" class="netrecivivalAmnt">Net Receivable Amount</label>
                        <span class="netReceivedAmntval" id="netreceviveamounttkt"></span>
                    </div>
                    <div class="row15">
                        <button class="savef10btn" onclick="order_invoice_submit()">Save (F10)</button>
                        <label for="" class="returnableAmt">Return Amount</label>
                        <span class="ReturnamntValf" id="returnAmountTKB"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="invoice_footer">
            <div class="grandFooter">
                <span class="footerLabel">Line</span>
                <span class="footerbox footerline"><?php echo (isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 )  ?></span>
                <span class="footerLabel">Qnty</span>
                <span class="footerbox footerQnty"><?php if ($total_qty > 0) {
                                                        echo $total_qty;
                                                    } else {
                                                        echo 0;
                                                    } ?></span>
                <span class="footerLabel">Discount</span>
                <input type="number" class="footerbox footerdiscount" placeholder="0" id="discountTK">
                <span class="footerLabel">Net Amount</span>
                <span class="footerbox footerdiscount"><?php if ($cart_total_price > 0) {
                                                            echo $cart_total_price;
                                                        } else {
                                                            echo 0;
                                                        } ?> Tk</span>
                <span class="notef">Note: (1) F3 for barcode field (2) F5 for gried qnty field</span>
                <span class="footerSmB">14/05/2019</span>
                <span class="footerSmB">500</span>
                <span class="footerSmB footerSmBS">E</span>
            </div>
                <textarea id="totalpayment" style="visibility:hidden;"><?php if ($cart_total_price > 0) {echo $cart_total_price;} else { echo 0;} ?></textarea>
        </div>
        
    </section>
    <script src="./main.js"></script>
</body>

</html>
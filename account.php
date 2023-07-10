<!DOCTYPE html>
<html lang="en">
<?php
require("./restrict.php");
require('./partials/header.php');
?>

<body onload="initClock()">
    <section class="dashboard">
        <div class="dash_head">
            <p><span class="head_t">Best Buy POS ->> User Site:-</span><span class="head_n"> <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}else{echo "";} ?></span> <span class="head_status"> [Site Id : <?php if(isset($_SESSION['showroom_code'])){echo $_SESSION['showroom_code'];}else{echo "";} ?>] Status:200</span></p>
        </div>
        <?php
        require('./partials/navbar.php');
        ?>
        <div class="dash_body" id="account">
            <div class="acc_left">
                <ul>
                    <li><a href="https://bbsapp.000webhostapp.com/web/account">User info</a></li>
                    <li><a href="https://bbsapp.000webhostapp.com/web/change-password">Change password</a></li>
                    <li><a href="https://bbsapp.000webhostapp.com/web/update-user">Update user</a></li>
                    <li><a href="https://bbsapp.000webhostapp.com/web/account-status">Account Status</a></li>
                    <li><a href="https://bbsapp.000webhostapp.com/web/action">Action</a></li>
                </ul>
            </div>
            <div class="acc_right">
                <?php 
                    if(isset($_SESSION['showroom_code'])){
                        $swcode=$_SESSION['showroom_code'];
                        $sql = "SELECT * FROM users WHERE showroom_code=$swcode";
                        $res = mysqli_query($con, $sql);
                        $row = mysqli_fetch_assoc($res);

                        $showroom_name = $row['showroom_name'];
                        $showroom_code = $row['showroom_code'];
                        $party_code = $row['party_code'];
                        $user_name = $row['user_name'];
                        $mobile = $row['mobile'];
                        $email = $row['email'];
                        $id = $row['id'];
                        $address = $row['address'];
                        $status = $row['status'];
                        $update_at = $row['update_at'];
                    }
                ?>
                <div class="info_con">
                    <h3 class="user_info_h3">User Information</h3>
                    <div class="info_div">
                        <img title="300x300px resulation" src="./assests/images/user .jpg" alt="">
                        <p class="user_P">User Profile</p>
                    </div>
                    <div class="info_div">
                        <div class="info_cont">
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>User ID:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$id"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>User name:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$user_name"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>Showroom name:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$showroom_name"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>Showroom code:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$showroom_code"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>Party code:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$party_code"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>Mobile:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$mobile"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>Email:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$email"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>Address:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$address"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>Last Activity:</p></div>
                                <div class="showroom_lavel_hv"><p><?php echo"$update_at"; ?></p></div>
                            </div>
                            <div class="info_lavel">
                                <div class="info_lavel_h"><p>Account Status:</p></div>
                                <div class="showroom_lavel_hv activeSt"><p><?php echo"$status"; ?></p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require('./partials/footer.php');
        ?>
    </section>
        
    <script src="./main.js"></script>
</body>

</html>
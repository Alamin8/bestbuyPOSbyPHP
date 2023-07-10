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
        <div class="dash_body">
        </div>
        <?php
        require('./partials/footer.php');
        ?>
    </section>
        
    <script src="./main.js"></script>
</body>

</html>
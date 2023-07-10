<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Buy POS - Login</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body onload="initClock()">
    <section class="dashboard">
        <div class="dash_head">
        <p><span class="head_t">Best Buy POS ->> User Site:-</span><span class="head_n"> <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}else{echo "";} ?></span> <span class="head_status"> [Site Id : <?php if(isset($_SESSION['showroom_code'])){echo $_SESSION['showroom_code'];}else{echo "";} ?>] Status:200</span></p>
        </div>
        <div class="login_body">
            <div class="login_panel">
                <div class="log_left">
                    <div class="login_title">
                        <p> <img src="./assests/images/icons8-lock.gif" alt=""> User Login Panel</p>
                    </div>
                    <div class="alart" id="loginAlart">
                        This is Error Alert
                    </div>
                    <div class="login_form">
                        <form id="login_form" method="POST">
                            <div class="log_form_lt">
                                <label for="login_party_code">Party Code:</label>
                                <input type="text" name="login_party_code" id="login_party_code" required>
                            </div>
                            <div class="log_form_rt">
                                <label for="login_password">Password:</label>
                                <input type="password" name="login_password" id="login_password" required>
                            </div>
                            <div class="helper">
                                <a href="javascript:void(0)">Forgotten Password?</a>
                                <a href="https://bbsapp.000webhostapp.com/web/sregister" >Register</a>
                            </div>
                            <input type="button" name="loginSubmit" onclick="userlogin()" value="Login">
                        </form>
                    </div>
                </div>
                <div class="log_right">

                </div>
            </div>
        </div>
        <?php require('./partials/footer.php')?>
    </section>
    <script src="./main.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body onload="initClock()">
    <section class="dashboard">
        <div class="dash_head">
            <p><span class="head_t">Best Buy POS ->> User Site:-</span><span class="head_n"> Bbuy Jamgora Ashlia</span> <span class="head_status"> [Site Id : 12729] Status:153</span></p>
        </div>
        <div class="login_body">
            <div class="forgot_popup" id="register_popup">
                <div class="forgot_container">
                    <p class="forgot_title">User Registration</p>
                    <div class="alart" id="register_error">
                        <p id="register_error_msg">This is Error Alert</p>
                    </div>
                    <form id="register_form" method="POST">
                        <div class="log_form_lt">
                            <label for="registerUserName">User Name:</label>
                            <input type="text" name="registerUserName" id="registerUserName" required>
                        </div>
                        <div class="log_form_lt">
                            <label for="registerEmail">Email:</label>
                            <input type="email" name="registerEmail" id="registerEmail" required>
                        </div>
                        <div class="log_form_lt">
                            <label for="registerPhone">Phone:</label>
                            <input type="number" name="registerPhone" id="registerPhone" required>
                        </div>
                        <div class="log_form_rt">
                            <label for="registerShowroomCode">Showroom Code:</label>
                            <input type="number" name="registerShowroomCode" id="registerShowroomCode" required>
                        </div>
                        <div class="log_form_rt">
                            <label for="registerPartyCode">Party Code:</label>
                            <input type="number" name="registerPartyCode" id="registerPartyCode" required>
                        </div>
                        <div class="log_form_rt">
                            <label for="registerPassword">Password:</label>
                            <input type="text" name="registerPassword" id="registerPassword" required>
                        </div>
                        <span class="fotgot_note"> Note: After successfully submitting, Wait for Authorization. <a href="https://bbsapp.000webhostapp.com/web/">Back to Home</a></span>
                        <input type="submit" name="registerSubmit" value="Submit" onclick="userRegister()">
                    </form>
                </div>
            </div>
        </div>
        <?php require('./partials/footer.php') ?>
    </section>
    <script src="./main.js"></script>
</body>

</html>
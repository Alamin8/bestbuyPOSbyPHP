
<div class="dash_footer">
    <p> <span class="connec_status" id="onlineS"> <img src="./assests/images/151.gif" alt=""> <span>OnlineB</span> </span>
        <span class="connec_status" id="offlineS"> Offline</span>
        <span class="version" id="">Current Ver: 1.1.1.1756</span>
        <span class="curr_date" id="curr_date" title="DD-MM-YYYY">24/07/2022</span>
        <span class="curr_time" id="curr_time"> 06:28 PM</span>
        <span class="dash_refresh"><Button onclick="location.reload()" id="defaultOpen">Refresh</Button></span>
        <span class="dash_user">User: <?php if(isset($_SESSION['showroom_code'])){echo $_SESSION['showroom_code'];}else{echo "";} ?></span>
    </p>
</div>

<script >
    window.addEventListener("online", function(){
        document.getElementById("onlineS").style.display= "flex";
        document.getElementById("onlineS").style.alignItems= "center";
        document.getElementById("offlineS").style.display= "none";
    })
    window.addEventListener("offline", function(){
        document.getElementById("onlineS").style.display= "none";
        document.getElementById("offlineS").style.display= "block";
    })
</script>
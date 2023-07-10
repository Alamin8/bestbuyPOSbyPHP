// clock
function updateClock() {
  var now = new Date();
  var day = now.getDate(),
    month = now.getMonth() + 1,
    year = now.getFullYear(),
    hour = now.getHours(),
    minutes = now.getMinutes(),
    pe = "AM";

  if (hour == 0) {
    houe = 12;
  }
  if (hour > 12) {
    hour = hour - 12;
    pe = "PM";
  }
  Number.prototype.pad = function (digits) {
    for (var n = this.toString(); n.length < digits; n = 0 + n);
    return n;
  };
  document.getElementById("curr_date").innerHTML = `${day.pad(2)}/${month.pad(
    2
  )}/${year.pad(4)}`;


  document.getElementById("curr_time").innerHTML = `${hour.pad(
    2
  )}:${minutes.pad(2)} ${pe}`;

  
  // var todayDate = `${day.pad(2)}/${month.pad(2)}/${year.pad(4)}`,
  //   todayTime = `${hour.pad(2)}:${minutes.pad(2)} ${pe}`;
   
    
    // return (todayDate, todayTime);
}
function initClock() {
  updateClock();
  window.setInterval("updateClock()", 1);
}

//  Handle Registration
function userRegister() {
  var user_name = jQuery("#registerUserName").val();
  var email = jQuery("#registerEmail").val();
  var mobile = jQuery("#registerPhone").val();
  var showroom_code = jQuery("#registerShowroomCode").val();
  var party_code = jQuery("#registerPartyCode").val();
  var password = jQuery("#registerPassword").val();

  if (user_name == "") {
    alert("Please enter your user name");
    jQuery("#registerUserName").css("border", "1px solid red");
  } else if (email == "") {
    alert("Please enter your email");
    jQuery("#registerEmail").css("border", "1px solid red");
  } else if (mobile == "") {
    alert("Please enter your mobile");
    jQuery("#registerPhone").css("border", "1px solid red");
  } else if (showroom_code == "") {
    alert("Please enter your showroom code");
    jQuery("#registerShowroomCode").css("border", "1px solid red");
  } else if (party_code == "") {
    alert("Please enter your party code");
    jQuery("#registerPartyCode").css("border", "1px solid red");
  } else if (password == "") {
    alert("Please enter your password");
    jQuery("#registerPassword").css("border", "1px solid red");
  } else {
    jQuery.ajax({
      url: "submit_register.php",
      type: "post",
      data:
        "user_name=" +
        user_name +
        "&email=" +
        email +
        "&mobile=" +
        mobile +
        "&showroom_code=" +
        showroom_code +
        "&party_code=" +
        party_code +
        "&password=" +
        password,
      success: function (result) {
        if (result == "email_present") {
          alert("Email Already exists, Try again with another email");
        }
        if (result == "insert") {
          alert("Thanks for your registration");
          window.location.href = "https://bbsapp.000webhostapp.com/web/login";
        }
      },
    });
  }
}

//  Handle login
function userlogin() {
  var showroom_code = jQuery("#login_party_code").val();
  var password = jQuery("#login_password").val();
  if (showroom_code == "") {
    alert("Please enter your showroom code");
    jQuery("#registerShowroomCode").css("border", "2px solid tomato");
  } else if (password == "") {
    alert("Please enter your password");
    jQuery("#registerPassword").css("border", "2px solid tomato");
  } else {
    jQuery.ajax({
      url: "./submit_login.php",
      type: "post",
      data: "showroom_code=" + showroom_code + "&password=" + password,
      success: function (result) {
        console.log(result);
        if (result == "wrong") {
          jQuery("#loginAlart")
            .show()
            .css("background", "tomato")
            .html("Invalid Party code or password ");
        } else if (result == "valid") {
          window.location.href = "https://bbsapp.000webhostapp.com/web/dashboard";
        } else {
          window.location.href = "https://bbsapp.000webhostapp.com/web/";
        }
      },
    });
  }
}
$(document).ready(function () {
  $("#itemCodeOrbarcodeSB").keyup(function () {
    var itemcode = $(this).val();
    if (itemcode != "") {
      $.ajax({
        url: "../Alamin/load_product.php",
        method: "POST",
        data: { itemcode: itemcode },
        success: function (data) {
          console.log(data);
          $("#productList").fadeIn("fast").html(data);
        },
      });
    } else {
      $("#productList").fadeOut();
    }
  });
});

$(document).ready(function () {
  $("#itemCodeOrbarcodeorTextSB").keyup(function () {
    var product = $(this).val();
    if (product != "") {
      $.ajax({
        url: "../Alamin/load_product.php",
        method: "POST",
        data: { product: product },
        success: function (data) {
          console.log(data);
          $("#productList").fadeIn("fast").html(data);
        },
      });
    } else {
      $("#productList").fadeOut();
    }
  });
});

function manage_cart(pid) {
  console.log(pid);
  jQuery.ajax({
    url: "../Alamin/manage_cart.php",
    type: "POST",
    data: "pid=" + pid,
    success: function (result) {
      if (result) {
        window.location.href = "https://bbsapp.000webhostapp.com/web/invoice";
      } else {
        console.log("Error");
      }
    },
  });
}

function update_cart(pid, stoc, Uqty) {
  var newUPdateQty;
  if (Number( Uqty) > stoc) {
    console.log( stoc, Uqty);
    alert("update qty exsits stock qty");
    newUPdateQty = stoc;
  } if(Number( Uqty) <= stoc) {
    newUPdateQty = Number( Uqty);
  }
  jQuery.ajax({
    url: "../Alamin/update_cart.php",
    type: "POST",
    data: "pid=" + pid + "&qty=" + newUPdateQty,
    success: function (result) {
      console.log(result);
      if (result) {
        window.location.href = "https://bbsapp.000webhostapp.com/web/invoice";
      } else {
        console.log("Can't Update Qty");
      }
    },
  });
}

function OnConfirm(pid) {
  var confirmBox = $("#confirm");
  confirmBox.show();
  var yesBtn = $("#yesBtn");
  var noBtn = $("#noBtn");

  yesBtn.click(function () {
    jQuery.ajax({
      url: "../Alamin/delete_cart.php",
      type: "POST",
      data: "pid=" + pid,
      success: function (result) {
        console.log(result);
        if (result) {
          confirmBox.hide();
          window.location.href = "https://bbsapp.000webhostapp.com/web/invoice";
        } else {
          console.log("Can't delete product");
        }
      },
    });
  });
  noBtn.click(function () {
    window.location.href = "https://bbsapp.000webhostapp.com/web/invoice";
  });
}

// -------------- Submit Oder------------------//
$(document).ready(function () {
  $("#customerReceivedAmount").keyup(function () {
    var customerReceivedAmount = $(this).val(); 
    document.getElementById("cashAmountTK").innerHTML = customerReceivedAmount;
    document.getElementById("cardsale").innerHTML = "0";
    var total_payment = jQuery("#totalpayment").val();
    var discountTK = jQuery("#discountTK").val();
    document.getElementById("netreceviveamounttkt").innerHTML = total_payment - discountTK;
    document.getElementById("returnAmountTKB").innerHTML = customerReceivedAmount - (total_payment - discountTK);
  
  })
});

function order_invoice_submit() {
  var now = new Date();
  var day = now.getDate(),
    month = now.getMonth() + 1,
    year = now.getFullYear(),
    hour = now.getHours(),
    minutes = now.getMinutes(),
    pe = "AM";

  if (hour == 0) {
    houe = 12;
  }
  if (hour > 12) {
    hour = hour - 12;
    pe = "PM";
  }
  Number.prototype.pad = function (digits) {
    for (var n = this.toString(); n.length < digits; n = 0 + n);
    return n;
  };
  document.getElementById("curr_date").innerHTML = `${day.pad(2)}/${month.pad(
    2
  )}/${year.pad(4)}`;


  document.getElementById("curr_time").innerHTML = `${hour.pad(
    2
  )}:${minutes.pad(2)} ${pe}`;

  
  var todayDate = `${day.pad(2)}/${month.pad(2)}/${year.pad(4)}`,
    todayTime = `${hour.pad(2)}:${minutes.pad(2)} ${pe}`;
  var oc_date = todayDate+" "+ todayTime;
  

  var deport = jQuery("#deport").val();
  var showroom_code = jQuery("#showroom_code_sb").val();
  var party_code = jQuery("#party_code_sub").val();
  var note = jQuery("#invoiceNote").val();
  var customer_mobile = jQuery("#customerMobile").val();
  var total_payment = jQuery("#totalpayment").val();
  var discountTK = jQuery("#discountTK").val();
  var outlet_mobile = "01642038266"; 
  var loyality_member_name = jQuery("#loyality_member_name").val(); 
  var loyalityPointNow = jQuery("#loyalityPointNow").val(); 
  var customerReceivedAmount = jQuery("#customerReceivedAmount").val(); 
  var order_id = Math.random() * 8;
  var postableAmount;
  if(discountTK !=""){
    postableAmount = total_payment - discountTK;
  }else{
    postableAmount =total_payment; 
  }

  if(deport && showroom_code && party_code && total_payment>0){
    if(customer_mobile ==""){
      alert("Please enter the customer phone number");
    }else{
      jQuery.ajax({
        url: "process_order.php",
        type: "post",
        data:
          "order_id=" +
          order_id +
          "&oc_date=" +
          oc_date +
          "&deport=" +
          deport +
          "&showroom_code=" +
          showroom_code +
          "&party_code=" +
          party_code +
          "&outlet_mobile=" +
          outlet_mobile +
          "&note=" +
          note +
          "&customer_mobile=" +
          customer_mobile +
          "&total_payment=" +
          postableAmount +
          "&discountTK=" +
          discountTK +
          "&loyality_member_name=" +
          loyality_member_name +
          "&loyalityPointNow=" +
          loyalityPointNow,
        success: function (result) {
          if (result) {
            alert("Order Place Successfull");
            window.location.href = "https://bbsapp.000webhostapp.com/web/session_destry";
          }
        },
      });
    }
  }else{
    alert("No Product added for bill");
  }
  
}

function OnConfirmExit() {
  var confirmBox = $("#confirmE");
  confirmBox.show();
  var yesBtn = $("#yesBtnE");
  var noBtn = $("#noBtnE");

  yesBtn.click(function () {
    window.location.href="https://bbsapp.000webhostapp.com/web/logout.php";
  });
  noBtn.click(function () {
    window.location.reload();
  });
}


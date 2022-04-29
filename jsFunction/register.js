//
//
//
//
//
//
//
//
//
//
//
//
//
// REGISTER

$(document).ready(function() {
    $('#register').on('click', function() {
        var email = document.getElementById("email").value;
        var pass = document.getElementById("pwd").value;
        var passC = document.getElementById("pwdC").value;
        $.ajax({
            url: "ajax_register.php",
            type: "GET",
            data: { register: email },
            success: function(res) {
                if (email == "") {
                    document.getElementById("email_status").style.color = "red";
                    document.getElementById("email_status").hidden = false;
                    document.getElementById("email").style.borderColor = "red";
                    document.getElementById("email_status").innerHTML = "Required";
                } else if (res == 0) {
                    document.getElementById("email_status").hidden = false;
                    document.getElementById("email_status").style.color = "red";
                    document.getElementById("email").style.borderColor = "red";
                    document.getElementById("email_status").innerHTML = "Email Existed";
                } else if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                    document.getElementById("email_status").hidden = false;
                    document.getElementById("email_status").style.color = "red";
                    document.getElementById("email").style.borderColor = "red";
                    document.getElementById("email_status").innerHTML = "Invalid Email";
                } else if (pass == "") {
                    document.getElementById("pwd_status").style.color = "red";
                    document.getElementById("pwd_status").hidden = false;
                    document.getElementById("pwd").style.borderColor = "red";
                    document.getElementById("pwd_status").innerHTML = "Required";
                } else if (pass.length < 8) {
                    document.getElementById("pwd_status").style.color = "red";
                    document.getElementById("pwd_status").hidden = false;
                    document.getElementById("pwd").style.borderColor = "red";
                    document.getElementById("pwd_status").innerHTML = "Password Must Contain 8 Letters Or More";
                } else if (passC == "") {
                    document.getElementById("pwdC_status").style.color = "red";
                    document.getElementById("pwdC_status").hidden = false;
                    document.getElementById("pwdC").style.borderColor = "red";
                    document.getElementById("pwdC_status").innerHTML = "Required";
                } else if (passC != pass) {
                    document.getElementById("pwdC_status").style.color = "red";
                    document.getElementById("pwdC_status").hidden = false;
                    document.getElementById("pwdC").style.borderColor = "red";
                    document.getElementById("pwdC_status").innerHTML = "Wrong Confirm Password";
                } else {
                    $('#otpModal').modal('show');
                    $.ajax({
                        url: "otp_mailer.php",
                        type: "GET",
                        data: { mailer: email },
                        success: function(res) {
                            res = JSON.parse(res);
                            document.getElementById("otpCheck").value = res;
                        }
                    });
                }
            }
        });



    });
});

function email2(val) {
    $.ajax({
        url: "ajax_register.php",
        type: "GET",
        data: { register: val },
        success: function(res) {
            if (val == "") {
                document.getElementById("email_status").hidden = false;
                document.getElementById("email_status").style.color = "red";
                document.getElementById("email").style.borderColor = "red";
                document.getElementById("email_status").innerHTML = "Required";
            } else if (res == 0) {
                document.getElementById("email_status").hidden = false;
                document.getElementById("email_status").style.color = "red";
                document.getElementById("email").style.borderColor = "red";
                document.getElementById("email_status").innerHTML = "Email Existed";
            } else if (!val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                document.getElementById("email_status").hidden = false;
                document.getElementById("email_status").style.color = "red";
                document.getElementById("email").style.borderColor = "red";
                document.getElementById("email_status").innerHTML = "Invalid Email";
            } else {
                document.getElementById("email_status").style.color = "green";
                document.getElementById("email").style.borderColor = "";
                document.getElementById("email_status").innerHTML = "Valid";
            }
        }
    });
}

function pass2(val) {
    if (val == "") {
        document.getElementById("pwd_status").hidden = false;
        document.getElementById("pwd_status").style.color = "red";
        document.getElementById("pwd").style.borderColor = "red";
        document.getElementById("pwd_status").innerHTML = "Required";
    } else if (val.length < 8) {
        document.getElementById("pwd_status").style.color = "red";
        document.getElementById("pwd_status").hidden = false;
        document.getElementById("pwd").style.borderColor = "red";
        document.getElementById("pwd_status").innerHTML = "Password Must Contain 8 Letters Or More";
    } else {
        document.getElementById("pwd_status").style.color = "green";
        document.getElementById("pwd").style.borderColor = "";
        document.getElementById("pwd_status").innerHTML = "Valid";
    }
}

function passC2(val) {
    var pass = document.getElementById("pwd").value;
    if (val != pass) {
        document.getElementById("pwdC_status").hidden = false;
        document.getElementById("pwdC_status").style.color = "red";
        document.getElementById("pwdC").style.borderColor = "red";
        document.getElementById("pwdC_status").innerHTML = "Wrong Confirm Password";
    } else {
        document.getElementById("pwdC_status").style.color = "green";
        document.getElementById("pwdC").style.borderColor = "";
        document.getElementById("pwdC_status").innerHTML = "Valid";
    }
}

// REGISTER

// FORGOT PASS

$(document).ready(function() {
    $('#confirmEmail').on('click', function() {
        var email = document.getElementById("email").value;
        // var pass = document.getElementById("pwd").value;
        // var passC = document.getElementById("pwdC").value;
        // alert(email);
        $.ajax({
            url: "ajax_register.php",
            type: "GET",
            data: { register: email },
            success: function(res) {
                if (res == 0) {
                    $('#otpModal').modal('show');
                    $.ajax({
                        url: "otp_mailer.php",
                        type: "GET",
                        data: { recover: email },
                        success: function(res) {
                            res = JSON.parse(res);
                            document.getElementById("otpCheck").value = res;


                        }
                    });
                } else {
                    document.getElementById("errBoxF").hidden = false;
                    document.getElementById("errMessF").innerHTML = "<span class='closeBtn' onclick='errMess()'>&times;</span><b>Error! </b>Email is not registered";
                }
            }
        });
    });
    $('#otpSubmit').on('click', function() {
        var otp = document.getElementById("otp").value;
        var otpCheck = document.getElementById("otpCheck").value;
        if (otp != "") {
            if (otp == otpCheck) {
                $('#otpModal').modal('hide');
                document.getElementById("title").innerHTML = "Reset your password";
                document.getElementById("email").hidden = true;
                document.getElementById("confirmEmailButton").hidden = true;
                document.getElementById("passForm").hidden = false;
                document.getElementById("changePassButton").hidden = false;
            } else {
                $('#otpModal').modal('hide');
                document.getElementById("errBoxF").hidden = false;
                document.getElementById("errMessF").innerHTML = "<span class='closeBtn' onclick='errMess()'>&times;</span><b>Error! </b>Incorrect OTP, Try Again";
            }
        } else {
            $('#otpModal').modal('hide');
            document.getElementById("errBoxF").hidden = false;
            document.getElementById("errMessF").innerHTML = "<span class='closeBtn' onclick='errMess()'>&times;</span><b>Error! </b>Incorrect OTP, Try Again";
        }


    });
});



// FORGOT PASS
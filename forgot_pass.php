<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logocube.png" rel="icon">
  <title>VNS</title>
  <link href="jsBootstrap/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="jsBootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.css" rel="stylesheet">
</head>
<script>
  function errMess(){
      document.getElementById("errBoxF").hidden = true;
    }
</script>
<?php
include_once("connection.php");
if(isset($_POST['changePass']))
{
  $email = $_POST['email'];
  $pass = md5($_POST['newPass']);
  mysqli_query($conn, "UPDATE account SET password = '$pass' WHERE email = '$email' ");
  echo '<meta http-equiv="refresh" content="0;URL = login.php"';
  
}
?>

<body class="bg-gradient-login" style="background: linear-gradient(to bottom, #0066ff 0%, #9999ff 80%);">
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-6">
        <div class="card shadow-sm my-5">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <form action="" method="post" role="form" onsubmit="return window.addEventListener('DOMContentLoaded', function() {registerF()});">
                  <div class="text-center">
                    <h1 id="title" class="h4 text-gray-900 mb-4">Enter your email to get OTP code</h1>
                  </div>

                  <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="">
                    <p style="font-size: 12px; position: absolute; color: red;top: 142px;left: 65px" id="email_status"></p>
                  </div>

                  <div id="passForm" hidden>
                    <div class="form-group">
                      <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Password" value="" onchange="pass2(this.value)">
                      <p style="font-size: 12px; position: absolute; color: red;top: 202px;left: 65px" id="pwd_status"></p>
                      <span>
                        <i class="fa fa-eye hidepass" style="" aria-hidden="true" type="button" id="eye"></i>
                      </span>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control" id="newPassC" name="newPassC" placeholder="Confirm Password" value="" onchange="passC2(this.value)">
                      <p style="font-size: 12px; position: absolute; color: red;top: 260px;left: 65px" id="pwdC_status"></p>
                      <span>
                        <i class="fa fa-eye hidepass" style="" aria-hidden="true" type="button" id="eyeC"></i>
                      </span>
                    </div>
                  </div>
                  
                  <br>
                  <div class="form-group" style="margin-bottom: 10px" id="confirmEmailButton">
                    <input type="button" class="btn btn-primary btn-block" name="confirmEmail" value="Confirm" id="confirmEmail">
                  </div>
                  <div class="form-group" style="margin-bottom: 10px" id="changePassButton" hidden>
                    <input type="submit" class="btn btn-primary btn-block" name="changePass" value="Change Password" id="changePass">
                  </div>
                  <div class="form-group" style="border: 2px; border-style: solid; border-radius: 5px; border-color: #6777EF; margin-bottom: -10px">
                    <a href="login.php" class="btn btn-block" style="color:  #6777EF">Back</a>
                  </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- OTP modal -->
  <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div style="max-width: 25%"  class="modal-dialog " role="document">
      <div style="width:100" class="modal-content">
        <div class="modal-body">
          
            <div class="form-group" id="otp_form">
              <input id="otpCheck" name="otpCheck" hidden>
              <div class="col-md-12" style="padding-left: 0">Enter OTP code received from your Email</div>
              <input type="text" required minLength="6" maxLength="6" class="form-control" id="otp" name="otp" placeholder="OTP" value="">
              <p style="font-size: 12px; position: absolute; color: red;top: 81px;left: 17px" id="opt_status"></p>
            </div>
          
            <div class="form-group">
              <input type="button" class="btn btn-primary btn-block" value="Submit" id="otpSubmit" name="otpSubmit">
            </div>
            </form>
        </div>
        </div>

      </div>
    </div>
  </div>
  <!-- OTP modal -->

  <div class="errBoxF" id="errBoxF" hidden>
    <p class="errMessF" id="errMessF"></p>
  </div>

  <!-- Hide/Unhide Password -->
  <script language="javascript">
    function show() {
      var p = document.getElementById('newPass');
      p.setAttribute('type', 'text');
      }
    function hide() {
        var p = document.getElementById('newPass');
        p.setAttribute('type', 'password');
      }
    var pwShown = 0;
    document.getElementById("eye").addEventListener("click", function () {
        if (pwShown == 0) {
            pwShown = 1;
            show();
        } else {
            pwShown = 0;
            hide();
        }
    }, false);

    function showC() {
      var p = document.getElementById('newPassC');
      p.setAttribute('type', 'text');
      }
    function hideC() {
        var p = document.getElementById('newPassC');
        p.setAttribute('type', 'password');
      }
    var pwShown = 0;
    document.getElementById("eyeC").addEventListener("click", function () {
        if (pwShown == 0) {
            pwShown = 1;
            showC();
        } else {
            pwShown = 0;
            hideC();
        }
    }, false);
    
  </script>
  <!-- Hide/Unhide Password -->

  <script src="jsBootstrap/jquery/jquery.min.js"></script>
  <script src="jsBootstrap/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="jsBootstrap/jquery-easing/jquery.easing.min.js"></script>
  <script src="jsFunction/register.js"></script>

  <script>
    var err = '<?= $err ?>';
    var tagS = "<span class='closeBtn' onclick='errMess()'>&times;</span><b>";

    if(err == "wrongOTP"){
      document.getElementById("errBoxF").hidden = false;
      document.getElementById("errMessF").innerHTML = tagS + "Error! </b>Incorrect OTP, Try Again";
    }

    function errMess(){
      document.getElementById("errBoxF").hidden = true;
    }
  </script>
  
</body>
<div style="width:100%;height:100%;position: relative">
  <a href="intro.php"><img class="rounded" style="width:50px; position: fixed; bottom: 10px; right: 10px; float: right" src="img/logo/logobluecubebig.png"></a>
</div>

</html>
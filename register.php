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

<?php 
session_start();
include_once("connection.php");
$err;
if(isset($_POST['register']))
{
  $email = $_POST['email'];
  $pass = md5($_POST['pass']);
  if($_POST['otp'] != ""){
    if($_POST['otp'] == $_POST['otpCheck']){
      $result = mysqli_query($conn, "select * from account where email ='$email'");
      if (mysqli_num_rows($result)==0)
      {
        mysqli_query($conn, "insert into account(email, password, duration, state) values('$email', '$pass', 1, 2)");
        echo '<meta http-equiv="refresh" content="0;URL = login.php"';
      }
      else
      {
        $err = 'emailExisted';
      }
    } else{
      $err = 'wrongOTP';
    }
  } else {
    $err = 'wrongOTP';
  }
  
  
}
?>

<body class="bg-gradient-login" style="background: linear-gradient(to bottom, #0066ff 0%, #9999ff  80%);">
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-6">
        <div class="card shadow-sm my-5">
          <div class="row">
            <div class="col-lg-12">
              <div class="login-form">
                <form action="" method="post" role="form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Registration</h1>
                  </div>

                  <div class="form-group">
                    <input type="" class="form-control" id="email" name="email" placeholder="Email" value="" onchange="email2(this.value)">
                    <p style="font-size: 12px; position: absolute; color: red;top: 142px;left: 65px" id="email_status"></p>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" id="pwd" name="pass" placeholder="Password" value="" onchange="pass2(this.value)">
                    <p style="font-size: 12px; position: absolute; color: red;top: 202px;left: 65px" id="pwd_status"></p>
                    <span>
                      <i class="fa fa-eye hidepass" style="" aria-hidden="true" type="button" id="eye"></i>
                    </span>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" id="pwdC" name="pass" placeholder="Confirm Password" value="" onchange="passC2(this.value)">
                    <p style="font-size: 12px; position: absolute; color: red;top: 260px;left: 65px" id="pwdC_status"></p>
                    <span>
                      <i class="fa fa-eye hidepass" style="" aria-hidden="true" type="button" id="eyeC"></i>
                    </span>
                  </div>
                  <br>
                  <div class="form-group">
                    <input type="button" class="btn btn-primary btn-block" name="register" value="Register" id="register">
                  </div>
                  <u style="font-size: 14px; border: 1px; border-style: italic">You have 1 day trial when you sign up for a new account</u>

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

        <!-- <div class="modal-header">
          <h5 class="modal-title">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->

        <div class="modal-body">
          
            <div class="form-group" id="otp_form">
              <input id="otpCheck" name="otpCheck" hidden>
              <div class="col-md-12" style="padding-left: 0">Enter OTP code received from your Email</div>
              <input type="text" required minLength="6" maxLength="6" class="form-control" id="otp" name="otp" placeholder="OTP" value="">
              <p style="font-size: 12px; position: absolute; color: red;top: 81px;left: 17px" id="opt_status"></p>
            </div>
          
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-block" value="Submit" name="register">
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
      var p = document.getElementById('pwd');
      p.setAttribute('type', 'text');
      }
    function hide() {
        var p = document.getElementById('pwd');
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
      var p = document.getElementById('pwdC');
      p.setAttribute('type', 'text');
      }
    function hideC() {
        var p = document.getElementById('pwdC');
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
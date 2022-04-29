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
$err = "";
if(isset($_POST['btnLogin']))
{
  $email = $_POST['email'];
  $passO = $_POST['pass'];
  $pass = md5($passO);
  $result = mysqli_query($conn, "select * from account where email ='$email' and password ='$pass'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if (mysqli_num_rows($result)==1)
  {
    $_SESSION['account_id']=$row['account_id'];
    $_SESSION['role']=$row['state'];
    $_SESSION['email']=$email;
    if($row['state'] == 1){
      echo '<meta http-equiv="refresh" content="0;URL = index.php"';
    } else {
      $result = mysqli_query($conn, "select customer_name from customer where account_id ='".$_SESSION['account_id']."' and customer_name ='Passerby'");
      if(mysqli_num_rows($result)==0){
        mysqli_query($conn, "INSERT INTO `customer` (`customer_name`, `addr`, `phone`, `email`, `purchased`, `debt`, `membership`, `describe`, `account_id`) 
        VALUES ('Passerby', 'Empty', '0', 'Empty', '0', '0', '0', 'Empty', '".$_SESSION['account_id']."')");
      }

      $openDay = $row['open_day'];
      $duration = $row['duration'];
      $today = date("m/d/Y");
      $expireDate = date('m/d/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'));
      if((strtotime(date('m/d/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'))) - strtotime($today)) <= 0 ){
        echo '<meta http-equiv="refresh" content="0;URL = expired.php?email='.$email.'"';
      } else { 
        echo '<meta http-equiv="refresh" content="0;URL = index.php"';
      }
    }
  }
  else
  {
    $err = 'wrongUP';
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
                <form action="" method="post" onsubmit="return validateLogin();">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Sign In</h1>
                  </div>

                  <div class="form-group">
                    <input type="email" required class="form-control" id="email" name="email" placeholder="Email" value="">
                    <p style="font-size: 12px; position: absolute; color: red;top: 142px;left: 65px" id="email_status"></p>
                  </div>

                  <div class="form-group">
                    <input type="password" required class="form-control" id="pwd" name="pass" placeholder="Password" value="">
                    <p style="font-size: 12px; position: absolute; color: red;top: 202px;left: 65px" id="pwd_status"></p>
                    <span>
                      <i class="fa fa-eye hidepass" style="" aria-hidden="true" type="button" id="eye"></i>
                    </span>
                  </div>

                  <div class="form-group">
                    <div class="small" style="line-height: 1.5rem;">
                      <a href="forgot_pass.php" class="" for="customCheck">Forgot Password ?</a>
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Login" name="btnLogin">
                  </div>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="register.php">Sign Up</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
  </script>
  <!-- Hide/Unhide Password -->

  <script src="~/jsBootstrap/jquery/jquery.min.js"></script>
  <script src="~/jsBootstrap/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="~/jsBootstrap/jquery-easing/jquery.easing.min.js"></script>
  <script src="~/js/ruang-admin.min.js"></script>

  <script src="jsBootstrap/jquery/jquery.min.js"></script>
  <script src="jsBootstrap/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="jsBootstrap/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>

  <script>
    var err = '<?= $err ?>';
    var tagS = "<span class='closeBtn' onclick='errMess()'>&times;</span><b>";

    if(err == "wrongUP"){
      document.getElementById("errBoxF").hidden = false;
      document.getElementById("errMessF").innerHTML = tagS + "Error! </b>Incorrect Username or Password";
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
<?php //} ?>
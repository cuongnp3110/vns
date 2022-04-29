<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logocube.png" rel="icon">
  <title>VNS - Extent</title>
  <link href="jsBootstrap/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="jsBootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <script src="jsFunction/register.js"></script>
</head>

<?php
include_once("connection.php");
if(isset($_POST['extent'])){
  $email = $_POST['email'];
  $visa = $_POST['visa'];
  $cvv = $_POST['cvv'];
  $duration = $_POST['duration'];
  $patternVisa = "/^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/";
  $patternCVV = "/^[0-9]{3}$/";
  if(preg_match($patternVisa, $visa) == 1){
    if(preg_match($patternCVV, $cvv) == 1){
      $date = date("Y-m-d");
      $result = mysqli_query($conn,"SELECT open_day, duration FROM account WHERE email = '$email'");
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if((strtotime(date('m/d/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'))) - strtotime(date("m/d/Y"))) < 0 ){
          mysqli_query($conn,"UPDATE account SET duration = duration + '$duration', open_day = '$date' WHERE email = '$email'");
          echo '<meta http-equiv="refresh" content="0;URL = index.php"';
      } else { 
          mysqli_query($conn,"UPDATE account SET duration = duration + '$duration' WHERE email = '$email'");
          echo '<meta http-equiv="refresh" content="0;URL = index.php"';
      }
    }else{
      echo "<script>alert('Invalid CVV')</script>";
    }
  }else{
    echo "<script>alert('Invalid CVV')</script>";
  }
  //https://gist.github.com/subodhghulaxe/baa55027eee799b6118b
}
?>

<body id="page-top" style="height: 100%">
  <div id="wrapper" style="height: 100%">
    <div id="content-wrapper" class="d-flex flex-column"  style="display: flex; justify-content: center; ">
          <div class="text-center" style="margin-top: 300px">
            <img src="img//logo/logobluecubebig.png" style="height: 20%" class="mb-3">
            
            <h3 class="text-gray-800 font-weight-bold">Oopss!</h3>
            <p class="lead text-gray-800 mx-auto">Your Account Is Required To Extent</p>

            <form method="post" onsubmit="return extent()">
              <div class="form-group row" style="padding: 0 38%">

                <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
                <div class="col-md-8"  >
                  <input type="text" readonly class="form-control" id="email" name="email" value="<?php echo $_GET['email'] ?>">
                </div>
                <br><br>
                <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">VISA card:</b></div>
                <div class="col-md-8"  >
                  <input type="text" required minLength="16" maxLength="16" class="form-control" id="visa" name="visa" placeholder="(xxxx-xxxx-xxxx-xxxx)" value="3528503483993101">
                </div>
                <br><br>
                <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">CVV:</b></div>
                <div class="col-md-8"  >
                  <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                   required minLength="3" maxLength="3" class="cvv form-control" id="cvv" name="cvv" placeholder="CVV number" value="">
                </div>
                <br><br>
                <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Duration:</b></div>
                <div class="col-md-8"  >
                  <select class="select2-single form-control" name="duration" id="duration">
                    <option value="10">10 days</option>
                    <option value="30">1 month (30 days)</option>
                    <option value="180">6 month (180 days)</option>
                    <option value="365">1 year (365 days)</option>
                  </select>
                </div>
                <br><br><br>
                <input type="submit" class="btn btn-primary btn-block" value="Extent" name="extent">
              </div>
            </form>
            

            <a href="login.php">&larr; Or back to Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html> 
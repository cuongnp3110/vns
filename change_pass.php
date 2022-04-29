<?php
if(isset($_POST['btnChangePass'])){
    $pass = $_POST['pass'];
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    $result = mysqli_query($conn, "select password from account where password='".md5($pass)."' and account_id = '".$_SESSION['account_id']."'");
    if(mysqli_num_rows($result)!=0)
    {
      if($npass == $cpass){
        mysqli_query($conn,"UPDATE account SET password = '".md5($npass)."' WHERE account_id = '".$_SESSION['account_id']."'");
        mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Change Password','".$_SESSION['account_id']."')");
        echo '<meta http-equiv="refresh" content="0; URL=?page=profile"';
      } else {
          $err = "wrongPassConfirmF";
      }
    } else {
      $err = "wrongPassF";
    }
}
?>

<div class="container-fluid" id="container-wrapper" style="display: flex; justify-content: center;">
    <div class="col-lg-4">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
            </div>
            <div class="card-body" style="padding-top: 0">
                <form method="post">
                    <div class="row">
                            <div class="col-md-12" style="padding-bottom: 15px">
                                <input type="password" maxlength="40" class="form-control" id="pass" name="pass" placeholder="Old Pasword" >
                                <p style="font-size: 12px; position: absolute; color: red;bottom: -17px; left: 15px; left: 15px" id="pass_status"></p>
                            </div>
                            <div class="col-md-12" style="padding-bottom: 15px">
                                <input type="password" minlength="8" maxlength="40" class="form-control" id="npass" name="npass"  placeholder="New Pasword">
                                <p style="font-size: 12px; position: absolute; color: red;bottom: -17px; left: 15px; left: 15px" id="npass_status"></p>
                            </div>
                            <div class="col-md-12" style="padding-bottom: 15px">
                                <input type="password" minlength="8" maxlength="40" class="form-control" id="cpass" name="cpass"  placeholder="Confirm Pasword">
                                <p style="font-size: 12px; position: absolute; color: red;bottom: -17px; left: 15px; left: 15px" id="cpass_status"></p>
                            </div>
                    </div>
                    <a href="?page=profile" class="btn">Back</a> <button type="submit" name="btnChangePass" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
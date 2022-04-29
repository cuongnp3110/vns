<div class="container-fluid" id="container-wrapper">
<?php 

// INSERT
if(isset($_POST['addAccount']))
{
  $accName = trim($_POST['acc_name']);
  $accEmail = trim($_POST['acc_email']);
  $accDuration = $_POST['duration'];
  $pass = 1;
  $result = mysqli_query($conn, "select * from account where email = '$accEmail'");
  if(mysqli_num_rows($result)==0){
    // $userName = strstr($accEmail, '@', true);
    $passMd5 = md5($pass);
    mysqli_query($conn, "INSERT INTO `account` (`password`, `fname`, `email`, `duration`, `state`) VALUES ('$passMd5', '$accName', '$accEmail', '$accDuration', '2')");
    $err = "successAddAcc";
    unset($accName);
    unset($accEmail);
    unset($accDuration);
  } else {
    $err = "duplicatedAcc";
  }
}

// EXTENT TIME
if(isset($_POST['extentTime']))
{
  $userId = $_POST['acc_id'];
  $accDuration = $_POST['duration'];
  $date = date("Y-m-d");
  $result = mysqli_query($conn,"SELECT open_day, duration FROM account WHERE account_id = '$userId'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if((strtotime(date('m/d/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'))) - strtotime(date("m/d/Y"))) < 0 ){
      mysqli_query($conn,"UPDATE account SET duration = duration + '$accDuration', open_day = '$date' WHERE account_id = '$userId'");
  } else { 
      mysqli_query($conn,"UPDATE account SET duration = duration + '$accDuration' WHERE account_id = '$userId'");
  }
  // mysqli_query($conn,"UPDATE account SET duration = duration + '$accDuration', open_day = '$date' WHERE account_id = '$userId'");
}

// EDIT PASSWORD
if(isset($_POST['editAccountPass']))
{
  $adPass = $_POST['ad_pass'];
  $userId = $_POST['acc_id_ad'];
  $userPass = trim($_POST['user_pass']);
  $userPassC = trim($_POST['user_pass_confirm']);
  $result = mysqli_query($conn,"SELECT * FROM account WHERE account_id = '".$_SESSION['account_id']."' and password = '".md5($adPass)."'");
  if(mysqli_num_rows($result)!=0){
    echo $adPass;
    if($userPass == $userPassC){
        mysqli_query($conn, "UPDATE account SET password = '".md5($userPass)."' where account_id='$userId'");
        $err = "successChangePass";
    } else {
        $err = "wrongPassConfirm";
    }
  } else {
    $err = "wrongAdminPass";
  }
}

// DELETE
if(isset($_POST['deleteAcc']))
{
  $accId = $_POST['delete_id_acc'];
  mysqli_query($conn, "delete from account where account_id = '$accId'");
  $err = "successDelAcc";
}
?>


<?php
  if($_SESSION['role'] == 1){
?>
  <!-- Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between" style="padding-bottom: 0">
          <h6 class="m-0 font-weight-bold text-primary">Accounts</h6>
          <!-- <a style="font-size: 30px" href="javascript:void(0);" data-toggle="modal" data-target="#addAccount" onclick="errMess()">
              <i class="fas fa-plus-square"></i>
          </a> -->
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" style="table-layout: fixed ;" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th hidden>ID</th>

                <th style="padding-left: 10px">Email</th>
                <th style="width: 80px;padding-left: 10px">Phone</th>
                <th style="width: 80px;padding-left: 10px">Open Day</th>
                <th style="width: 70px;padding-left: 10px">Duration</th>
                <th style="width: 80px;padding-left: 10px">Remaining</th>
                <th style="width: 80px;padding-left: 10px">Expire Day</th>
                <th style="width: 40px;padding-left: 10px">Role</th>
                <th style="width: 70px;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($conn, "SELECT * FROM account WHERE account_id <> '".$_SESSION['account_id']."' ORDER BY open_day ASC");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <tr>
                <td hidden><?php echo $row['account_id'] ?></td>
                <?php 
                    $today = date("m/d/Y");
                    $expireDate = date('d/m/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'));
                    $color;$role;
                    if((strtotime(date('m/d/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'))) - strtotime($today)) < 0 ){
                        $remain = "Expired";
                    } else { 
                        $remain = round(abs(strtotime(date('m/d/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'))) - strtotime($today)) / (60*60*24),0); 
                    }
                    if($remain === "Expired"){
                        $color = "red";
                    } else if (intval($remain) < 3){
                        $color = "orange"; //yellow
                    } else {
                        $color = "#13bf00"; //green
                    }
                    if($row['state'] == 1){
                        $role = "Admin";
                    } else if($row['state'] == 2){
                        $role = "User";
                    } else if($row['state'] == 3){
                        $role = "Employee";
                    } else {
                        $role = "";
                    }
                ?>
                <td style="padding: 10px 10px"><a href=""><?php echo $row['email']?></a></td>
                <td style="padding: 10px 10px"><?php echo $row['phone']?></td>
                <td style="padding: 10px 10px"><?php echo date('d/m/Y', strtotime($row['open_day'])) ?></td>
                <td style="padding: 10px 10px;"><?php echo $row['duration']?> days</td>
                <td style="padding: 10px 10px; color: <?php echo $color ?>"><?php echo $remain?> <?php if($remain!=="Expired") echo " days left" ?></td>
                <td style="padding: 10px 10px; color: <?php echo $color ?>"><?php echo $expireDate?></td>
                <td style="padding: 10px 10px;"><?php echo $role?></td>
                <td style="padding: 10px; float: center; text-align: center">
                  <a href="" class="extentTime" data-toggle="modal" data-target="#UserExtentTime">
                    <i class="fas fa-calendar-plus"></i>
                  <!-- </a> &nbsp; | &nbsp;
                  <a href="" class="editAccountPass" data-toggle="modal" data-target="#editAccountPass">
                    <i class="fas fa-key"></i>
                  </a> &nbsp; | &nbsp;
                  <a href="" class="deleteConfirmAcc" data-toggle="modal" data-target="#deleteConfirmAcc">
                    <i class="fas fa-trash"></i>
                  </a> -->
                </td>
              </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--Row-->
  
  <!-- Add account screen -->
  <div class="modal fade" id="addAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div style="max-width: 500px"  class="modal-dialog " role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Create Account</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formAddAccount" onsubmit="return validateAccAdd();">

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Name:</b></div>
              <div class="col-md-10"  >
                <input type="text" minlength="8" maxlength="50" class="form-control" id="acc_name" name="acc_name" value="<?php if(isset($accName)) echo $accName?>" onchange="validateAccName(this.value)" placeholder="Enter name (John, D.P Cooper, ...)">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="acc_name_status"></p>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
              <div class="col-md-10"  >
                <input type="text" maxlength="40" class="form-control" id="acc_email" name="acc_email" value="<?php if(isset($accEmail)) echo $accEmail?>" onchange="validateAccEmail(this.value)" placeholder="Enter email ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="acc_email_status"></p>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Duration:</b></div>
              <div class="col-md-10"  >
                    <select class="select2-single form-control" name="duration" id="duration">
                      <option value="10">10 days</option>
                      <option value="30">1 month (30 days)</option>
                      <option value="180">6 month (180 days)</option>
                      <option value="365">1 year (365 days)</option>
                    </select>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="addAccount">Create</button>
            </div>
          </form>
        </div>

        <div class="errBox" id="errBox" hidden>
          <p class="errMess" id="errMess"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Add account screen -->

  <!-- Extent time screen -->
  <div class="modal fade" id="UserExtentTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div style="max-width: 300px"  class="modal-dialog " role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Extent Time</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formAddAccount">
          <input id="acc_id" name="acc_id" hidden>
            <div class="form-group row">
              <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Duration:</b></div>
              <div class="col-md-8">
                    <select class="select2-single form-control" name="duration" id="duration">
                      <option value="10">10 days</option>
                      <option value="30">1 month (30 days)</option>
                      <option value="180">6 month (180 days)</option>
                      <option value="365">1 year (365 days)</option>
                    </select>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="extentTime">Extent</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Extent time screen -->

  <!-- Edit account screen -->
  <div class="modal fade" id="editAccountPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div style="max-width: 400px"  class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Change Password</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formAddProduct" onsubmit="return validateAccEditPass();">
            <input id="acc_id_ad" name="acc_id_ad" hidden>
            <div class="form-group row">
              <div class="col-md-12" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Admin Password:</b></div>
              <div class="col-md-12"  >
                <input type="password" maxlength="50" class="form-control" id="ad_pass" name="ad_pass">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="pro_name_status"></p>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Username Password:</b></div>
              <div class="col-md-12"  >
                <input type="password" maxlength="40" class="form-control" id="user_pass" name="user_pass">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="pro_name_status"></p>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Username Password Confirm:</b></div>
              <div class="col-md-12"  >
              <input type="password" maxlength="40" class="form-control" id="user_pass_confirm" name="user_pass_confirm">
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="editAccountPass">Confirm</button>
            </div>
          </form>
        </div>

        <div class="errBox" id="errBoxEdit" hidden>
          <p class="errMess" id="errMessEdit"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Edit account screen -->
  
  <!-- Delete Confirm -->
  <div class="modal fade" id="deleteConfirmAcc" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding-top: 25px">
          <h4> Are you sure to delete account <b id="deleteMessAcc" ></b></h4>
        </div>
        <div class="modal-footer">
        <form method="post">
          <input name="delete_id_acc" class="delete_id_acc" id="delete_id_acc" hidden>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="deleteAcc">Confirm</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Confirm -->

</div>

<?php
  } else {
    echo '<meta http-equiv="refresh" content="0;URL = index.php"';
  }
?>

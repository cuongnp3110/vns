<?php
if(isset($_POST['btnEdit'])){
    $avt = $_FILES['avtInput'];
    $result = mysqli_query($conn, "select img from product where img='".$avt['name']."'");
    if(mysqli_num_rows($result)==0){
      if($avt['type']=="image/jpg" || $avt['type']=="image/jpeg"|| $avt['type']=="image/png" || $avt['type']=="image/bmp")
      { 
        list($width, $height, $type, $attr) = getimagesize($avt['tmp_name']);
        $insert;
        $maxwidth = 512; //maximum width of allowed image dimension in pixels
        if($width / $height > 2  || $height / $width > 2.5 ){
          $err = "avtOversize";
        } else {
          if($avt['size'] >= 524288){
            compressimage($avt['tmp_name'], "data/user_avt/".$avt['name'], $maxwidth);
            $insert = 1;
          } else {
            if($width > $maxwidth){
              compressimage($avt['tmp_name'], "data/user_avt/".$avt['name'], $maxwidth);
              $insert = 1;
            } else {
              $result = move_uploaded_file($avt['tmp_name'],  "data/user_avt/".$avt['name']);
              $insert = 1;
            }
          }
          if($insert==1){
            mysqli_query($conn,"UPDATE account SET avt='".$avt['name']."' WHERE account_id = '".$_SESSION['account_id']."' ");
            $err = "successEditAvt";
            unset($avt);
          }
        }
      } else {
      $err = "avtFormat";
      }

    } else {
      if($avt['type']=="image/jpg" || $avt['type']=="image/jpeg"|| $avt['type']=="image/png" || $avt['type']=="image/bmp")
      { 
        list($width, $height, $type, $attr) = getimagesize($avt['tmp_name']);
        $insert;
        $file = time().$avt['name'];
        $maxwidth = 512; //maximum width of allowed image dimension in pixels
        if($width / $height > 2  || $height / $width > 2.5 ){
          $err = "avtOversize";
        } else {
          
          if($avt['size'] >= 524288){
            compressimage($avt['tmp_name'], "data/user_avt/".$file, $maxwidth);
            $insert = 1;
          } else {
            if($width > $maxwidth){
              compressimage($avt['tmp_name'], "data/user_avt/".$file, $maxwidth);
              $insert = 1;
            } else {
              $result = move_uploaded_file($avt['tmp_name'],  "data/user_avt/".$file);
              $insert = 1;
            }
          }
          if($insert==1){
            mysqli_query($conn,"UPDATE account SET avt='".$avt['name']."' WHERE account_id = '".$_SESSION['account_id']."' ");
            $err = "successEditAvt";
            unset($avt);
          }
        }
      } else {
      $err = "avtFormat";
      }
    }

    $name = $_POST['account_name'];
    $email = $_POST['account_email'];
    $phone = $_POST['account_phone'];
    $addr = $_POST['account_addr'];
    if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
        $result = mysqli_query($conn, "select * from account where email='$email' and account_id <> '".$_SESSION['account_id']."'");
        if(mysqli_num_rows($result)==0)
        {
            mysqli_query($conn,"UPDATE account SET fname = '".trim(ucwords($name))."',
            email = '".trim($email)."',
            phone = '$phone',
            addr = '".trim($addr)."'
            WHERE account_id = '".$_SESSION['account_id']."'");
            mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Edit Profile','".$_SESSION['account_id']."')");
            unset($name);
            unset($email);
            unset($phone);
            unset($addr);
            $err = "successEditAcc";
            echo '<meta http-equiv="refresh" content="0; URL=?page=profile"';
        } else {
            $err = "duplicatedEmail";
        }
    } else {
        $err = "invalidEmail";
    }
    
}
?>

<div class="container-fluid" id="container-wrapper" style="display: flex; justify-content: center;">
    <div class="col-lg-7">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
            </div>
            <div class="card-body" style="padding-top: 0">
                <form action="" method="post" enctype="multipart/form-data" role="form" onsubmit="return validateAccountEdit();">
                    <?php
                        $result= mysqli_query($conn, "select * from account where account_id =".$_SESSION['account_id']."");
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    ?>
                    <div class="row">
                        <div class="col-md-5" style="padding: 0 0 0 20px">
                            <div style="padding: 0 0 0 10%; "  class="fluid">
                                <img src="<?php echo $row['avt'] != "" ? "data/user_avt/".$row['avt'] : "img/boy.png" ?>" alt="Avatar" id="avt" style=" border-radius: 50%; border: 2px; border-style: solid; object-fit: cover; width: 210px; height: 210px" class="fluid"></img>
                                <input style="position:absolute; left: 0; top: 0; width:100%; height:100%; opacity:0; cursor:pointer;" type='file' onchange="readURLeditProfile(this);" id="avtInput" name="avtInput" accept="image/*" />
                            </div> 
                        </div>
                        <div class="row col-md-7" style="padding-right: 0">
                            <div class="col-md-3" style="padding: 10px 5px 20px 20px"><b style="color: #383838;font-size: 18px;">Name:</b></div>
                            <div class="col-md-9" style="padding-right: 0">
                                <input type="text" minlength="8" maxlength="50" class="form-control" id="account_name" name="account_name" value="<?php echo $row['fname']?>" onchange="validateAccountName(this.value)"  placeholder="Enter name (John, D.P Cooper, ... )">
                                <p style="font-size: 12px; position: absolute; color: red;bottom: -17px; left: 15px; left: 15px" id="account_name_status"></p>
                            </div>
                            <div class="col-md-3" style="padding: 10px 5px 20px 20px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
                            <div class="col-md-9" style="padding-right: 0" >
                                <input type="text" readonly maxlength="40" class="form-control" id="account_email" name="account_email" value="<?php echo $row['email']?>" onchange="validateAccountEmail(this.value)" placeholder="Enter email...">
                                <p style="font-size: 12px; position: absolute; color: red;bottom: -17px; left: 15px; left: 15px" id="account_email_status"></p>
                            </div>
                            <div class="col-md-3" style="padding: 10px 5px 20px 20px"><b style="color: #383838;font-size: 18px;">Phone:</b></div>
                            <div class="col-md-9" style="padding-right: 0" >
                                <input type="text" maxlength="10" class="form-control" id="account_phone" name="account_phone" value="<?php echo $row['phone']?>" onchange="validateAccountPhone(this.value)" placeholder="Enter phone number (10 digits)">
                                <p style="font-size: 12px; position: absolute; color: red;bottom: -17px; left: 15px; left: 15px" id="account_email_status"></p>
                            </div>
                            <div class="col-md-3" style="padding: 10px 5px 20px 20px"><b style="color: #383838;font-size: 18px;">Address:</b></div>
                            <div class="col-md-9" style="padding-right: 0" >
                                <input type="text" maxlength="150" class="form-control" id="account_addr" name="account_addr" value="<?php echo $row['addr']?>" onchange="validateAccountAddr(this.value)" placeholder="Enter address (Montana.st Canada, ... )">
                                <p style="font-size: 12px; position: absolute; color: red;bottom: -17px; left: 15px; left: 15px" id="account_email_status"></p>
                            </div>
                        </div>
                    </div>
                    <div style="padding-top: 15px">
                      <a href="?page=profile" class="btn">Back</a> <button type="submit" name="btnEdit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
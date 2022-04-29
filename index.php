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
  <link href="jsBootstrap/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php
  session_start();
  include_once("connection.php");
  include_once("compressimg.php");
  $price;
  $err = "";
  if(empty($_SESSION['email'])){
    header("Location: login.php"); 
    exit();
  }
  function toMoney($val,$symbol='$',$r=2){$n = $val;   $sign = ($n < 0) ? '-' : '';   $i = number_format(abs($n),$r);   return $symbol.$sign.$i;}


  // EXTENT TIME
  if(isset($_POST['extent'])){
    $email = $_POST['email'];
    $visa = $_POST['visa'];
    $cvv = $_POST['cvv'];
    $duration = $_POST['duration'];
    $patternVisa = "/^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/";
    $patternCVV = "/^[0-9]{3}$/";
    if(preg_match($patternVisa, $visa) == 1){
      if(preg_match($patternCVV, $cvv) == 1){
        mysqli_query($conn,"UPDATE account SET duration = duration + '$duration' WHERE email = '$email'");
        header("Refresh:0");
      }else{
        echo "<script>alert('Invalid CVV')</script>";
      }
    }else{
      echo "<script>alert('Invalid VISA')</script>";
    }
    //https://gist.github.com/subodhghulaxe/baa55027eee799b6118b
  }
  error_reporting(E_ALL);
?>
<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logobluecubebig.png" width="100%" height="100px">
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size: ">VNS</div>
      </a>
      <hr class="sidebar-divider my-0">
      <?php if($_SESSION['role'] != 1) { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?page=statistic">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Statistic</span></a>
      </li>
      <?php }?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>
      

      <?php if($_SESSION['role'] == 1) { ?>
        <li class="nav-item active">
          <a class="nav-link" href="?page=users">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Users</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="?page=bot">
            <i class="fas fa-fw fa-robot"></i>
            <span>Chatbot Unsolved Data</span>
          </a>
        </li>
      <?php }?>
      <?php if($_SESSION['role'] != 1) { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?page=product">
          <i class="fas fa-fw fa-archive"></i>
          <span>Product</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
          aria-controls="collapseForm">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Invoice</span>
        </a>
        <div id="collapseForm" class="collapse" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?page=invoice_im">Import</a>
            <a class="collapse-item" href="?page=invoice_ex">Export</a>
          </div>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=cat_brand">
          <i class="fas fa-fw fa-table"></i>
          <span>Category | Brand</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=customer">
          <i class="fas fa-fw fa-user"></i>
          <span>Customer</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=supplier">
          <i class="fas fa-fw fa-user-tag"></i>
          <span>Supplier</span>
        </a>
      </li>
      <?php }?>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
      
    </ul>
    

    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">

          <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="?page=create_invoice_ex">
                <b  style="font-size: 15px">Create Invoice&nbsp;&nbsp;</b><i class="fas fa-plus-square" style="font-size: 25px"> </i> 
              </a>
            </li>
            <?php
              if($_SESSION['role'] != 1){
            ?>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="?page=create_invoice_ex" data-toggle="modal" data-target="#extentTime">
                <b  style="font-size: 15px">Extent Account&nbsp;&nbsp;</b><i class="fas fa-calendar-plus" style="font-size: 25px"> </i> 
              </a>
            </li>
            <?php } ?>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?php 
                $result = mysqli_query($conn,"select avt from account where account_id = '".$_SESSION['account_id']."'");
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                 ?>
                <img class="img-profile rounded-circle" src="<?php echo $row['avt'] == ""? "img/boy2.png" : "data/user_avt/".$row['avt']?>" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small"><b><?php echo $_SESSION['email']?></b></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" >
                <a class="dropdown-item" href="?page=profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a> -->
                <a class="dropdown-item" href="?page=log">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Modal Logout -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to logout?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                <a href="?page=logout" class="btn btn-primary">Logout</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Logout -->
        
        <?php if($_SESSION['role'] != 1) { ?>
        <!-- Extent time screen -->
        <div class="modal fade" id="extentTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
          <div style="max-width: 400px"  class="modal-dialog " role="document">
            <div class="modal-content">
              
              <div class="modal-header">
                <b class="modal-title" style="color: #383838;font-size: 24px; ">Extent Time</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
              <form method="post" onsubmit="return extent()">
              <div class="form-group row">
              <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
                <div class="col-md-8"  >
                  <input type="text" readonly class="form-control" id="email" name="email" value="<?php echo $_SESSION['email'] ?>">
                </div>
              </div>
              <div class="form-group row">
              <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">VISA card:</b></div>
                <div class="col-md-8"  >
                  <input type="text" required minLength="16" maxLength="16" class="form-control" id="visa" name="visa" placeholder="(xxxx-xxxx-xxxx-xxxx)" value="3528503483993101">
                </div>
              </div>
              <div class="form-group row">
              <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">CVV:</b></div>
                <div class="col-md-8"  >
                  <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                   required minLength="3" maxLength="3" class="cvv form-control" id="cvv" name="cvv" placeholder="CVV number" value="">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Duration:</b></div>
                <div class="col-md-8"  >
                  <select class="select2-single form-control" name="duration" id="duration">
                    <option value="10">10 days</option>
                    <option value="30">1 month (30 days)</option>
                    <option value="180">6 month (180 days)</option>
                    <option value="365">1 year (365 days)</option>
                  </select>
                </div>
              </div>
                <input type="submit" class="btn btn-primary btn-block" value="Extent" name="extent">
            </form>
              </div>

            </div>
          </div>
        </div>
        <!-- Extent time screen -->
        <?php }?>

        <!-- Container Fluid-->
        <?php
        if(isset($_GET['page']))
        {
          $page = $_GET['page'];
          if($page=="cat_brand")
          { include_once("cat_brand.php");
          } 
          elseif ($page=="customer")
          { include_once("customer.php");
          } 
          elseif ($page=="product")
          { include_once("product.php");
          } 
          elseif ($page=="invoice_im")
          { include_once("invoice_im.php");
          }
          elseif ($page=="invoice_ex")
          { include_once("invoice_ex.php");
          }
          elseif ($page=="supplier")
          { include_once("supplier.php");
          }
          elseif ($page=="statistic")
          { include_once("statistic.php");
          }
          elseif ($page=="logout")
          { include_once("logout.php");
          }
          elseif ($page=="profile")
          { include_once("profile.php");
          }
          elseif ($page=="users")
          { include_once("users.php");
          }
          elseif ($page=="change_pass")
          { include_once("change_pass.php");
          }
          elseif ($page=="edit_profile")
          { include_once("edit_profile.php");
          }
          elseif ($page=="create_invoice_im")
          { include_once("create_invoice_im.php");
          }
          elseif ($page=="create_invoice_ex")
          { include_once("create_invoice_ex.php");
          }
          elseif ($page=="edit_invoice_im")
          { include_once("edit_invoice_im.php");
          }
          elseif ($page=="edit_invoice_ex")
          { include_once("edit_invoice_ex.php");
          }
          elseif ($page=="log")
          { include_once("log.php");
          }
          elseif ($page=="pdf_invoice_ex")
          { include_once("pdf_invoice_ex.php");
          }
          elseif ($page=="pdf_invoice_im")
          { include_once("pdf_invoice_im.php");
          }
          elseif ($page=="bot")
          { include_once("bot.php");
          }
          elseif ($page=="about")
          { include_once("about.php");
          }
          else{
            if($_SESSION['role'] == 1){
              include_once("users.php"); 
              
            } else {
              include_once("statistic.php"); 
            }
           
          }
        } 
        else{
          if($_SESSION['role'] == 1){
            include_once("users.php"); 
            
          } else {
            include_once("statistic.php"); 
          }
        }
         ?>
        <!---Container Fluid-->

      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><b><a href="https://github.com/indrijunanda/RuangAdmin" target="blank">Copyright &copy;</a></b> <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="https://www.facebook.com/pcuong3110" target="blank">Nguyễn Phú Cường</a></b>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
              <b><a href="?page=about" target="blank">About and Contact</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <div class="successBox" id="successBox" hidden >
    <p class="successMess" id="successMess"></p>
  </div>
  <div class="errBoxF" id="errBoxF" hidden>
    <p class="errMessF" id="errMessF"></p>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="jsBootstrap/jquery/jquery.min.js"></script>
  <script src="jsBootstrap/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <!-- Datatable -->
  <script src="jsBootstrap/datatables/jquery.dataTables.min.js"></script>
  <script src="jsBootstrap/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Charts plugins -->
  <script src="jsBootstrap/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/demo/chart-bar-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="jsFunction/validate.js"></script>
  <script src="jsFunction/invoice.js"></script>
  <script src="jsFunction/register.js"></script>
  
  
  <script>
    var err = '<?= $err ?>';
    var tagS = "<span class='closeBtn' onclick='errMess()'>&times;</span><b>";

    // ERROR ADD PRODUCT
    if(err == "duplicated"){
      document.getElementById("errBox").hidden = false;
      document.getElementById("errMess").innerHTML = tagS + "Error! </b>Product Already Exist";
      $('#addProduct').modal('show');
    }
    if(err == "oversize"){
      document.getElementById("errBox").hidden = false;
      document.getElementById("errMess").innerHTML = tagS + "Error! </b>Image Aspect Ratio Is Inappropriate"
      $('#addProduct').modal('show');
    }
    if(err == "format"){
      document.getElementById("errBox").hidden = false;
      document.getElementById("errMess").innerHTML = tagS + "Error! </b>Image Inappropriate"
      $('#addProduct').modal('show');
    }
    // ERROR EDIT PRODUCT
    if(err == "duplicatedEdit"){
      document.getElementById("errBoxEdit").hidden = false;
      document.getElementById("errMessEdit").innerHTML = tagS + "Error! </b>Product Already Exist"
      $('#editProduct').modal('show');
    }
    if(err == "oversizeEdit"){
      document.getElementById("errBoxEdit").hidden = false;
      document.getElementById("errMessEdit").innerHTML = tagS + "Error! </b>Image Aspect Ratio Is Inappropriate"
      $('#editProduct').modal('show');
    }
    if(err == "formatEdit"){
      document.getElementById("errBoxEdit").hidden = false;
      document.getElementById("errMessEdit").innerHTML = tagS + "Error! </b>Image Inappropriate"
      $('#editProduct').modal('show');
    }



    // ERROR ADD CAT
    if(err == "duplicatedCat"){
      document.getElementById("errBox").hidden = false;
      document.getElementById("errMess").innerHTML = tagS + "Error! </b>Category Already Exist"
      $('#addCat').modal('show');
    }
    // ERROR EDIT CAT
    if(err == "duplicatedCatEdit"){
      document.getElementById("errBoxEdit").hidden = false;
      document.getElementById("errMessEdit").innerHTML = tagS + "Error! </b>Product Already Exist"
      $('#addCat').modal('show');
    }



    // ERROR ADD BRAND
    if(err == "duplicatedBrand"){
      document.getElementById("errBoxB").hidden = false;
      document.getElementById("errMessB").innerHTML = "<span class='closeBtn' onclick='errMessB()'>&times;</span><b>Error! </b>Brand Already Exist"
      $('#addBrand').modal('show');
    }
    // ERROR EDIT BRAND
    if(err == "duplicatedBrandEdit"){
      document.getElementById("errBoxEditB").hidden = false;
      document.getElementById("errMessEditB").innerHTML = "<span class='closeBtn' onclick='errMessB()'>&times;</span><b>Error! </b>Brand Already Exist"
      $('#editBrand').modal('show');
    }



    // ERROR ADD CUSTOMER 
    if(err == "duplicatedCus"){
      document.getElementById("errBox").hidden = false;
      document.getElementById("errMess").innerHTML = tagS + "Error! </b>Customer Already Exist"
      $('#addCustomer').modal('show');
    }
    // ERROR EDIT CUSTOMER
    if(err == "duplicatedCusEdit"){
      document.getElementById("errBoxEdit").hidden = false;
      document.getElementById("errMessEdit").innerHTML = tagS + "Error! </b>Customer Already Exist"
      $('#editCustomer').modal('show');
    }

    // ERROR ADD SUPPLIER 
    if(err == "duplicatedSup"){
      document.getElementById("errBox").hidden = false;
      document.getElementById("errMess").innerHTML = tagS + "Error! </b>Supplier Already Exist"
      $('#addSupplier').modal('show');
    }
    // ERROR EDIT SUPPLIER
    if(err == "duplicatedSupEdit"){
      document.getElementById("errBoxEdit").hidden = false;
      document.getElementById("errMessEdit").innerHTML = tagS + "Error! </b>Supplier Already Exist"
      $('#addSupplier').modal('show');
    }

    // ERROR ADD ACCOUNT 
    if(err == "duplicatedAcc"){
      document.getElementById("errBox").hidden = false;
      document.getElementById("errMess").innerHTML = tagS + "Error! </b>Email Already Exist"
      $('#addAccount').modal('show');
    }
    // ERROR EDIT PASS ACCOUNT
    if(err == "wrongPassConfirm"){
      document.getElementById("errBoxEdit").hidden = false;
      document.getElementById("errMessEdit").innerHTML = tagS + "Error! </b>Wrong Password Confirm"
      $('#editAccountPass').modal('show');
    }
    if(err == "wrongPassConfirmF"){
      document.getElementById("npass_status").style.color = "red";
      document.getElementById("npass").style.borderColor = "red";
      document.getElementById("npass_status").innerHTML = "Unmatch Password Confirm";
      document.getElementById("cpass_status").style.color = "red";
      document.getElementById("cpass").style.borderColor = "red";
      document.getElementById("cpass_status").innerHTML = "Unmatch Password Confirm";
    }
    if(err == "wrongAdminPass"){
      document.getElementById("errBoxEdit").hidden = false;
      document.getElementById("errMessEdit").innerHTML = tagS +"Error! </b>Wrong Password Confirm"
      $('#editAccountPass').modal('show');
    }
    if(err == "wrongPassF"){
      document.getElementById("pass_status").style.color = "red";
      document.getElementById("pass").style.borderColor = "red";
      document.getElementById("pass_status").innerHTML = "Wrong Password";
    }
    if(err == "duplicatedEmail"){
      document.getElementById("account_email_status").style.color = "red";
      document.getElementById("account_email").style.borderColor = "red";
      document.getElementById("account_email_status").innerHTML = "Email Duplicated";
    }
    if(err == "invalidEmail"){
      document.getElementById("account_email_status").style.color = "red";
      document.getElementById("account_email").style.borderColor = "red";
      document.getElementById("account_email_status").innerHTML = "Invalid Email";
    }
    // ERROR EMPTY INVOICE 
    if(err == "invoiceEmpty"){
      document.getElementById("errBoxF").hidden = false;
      document.getElementById("errMessF").innerHTML = "<span class='closeBtn' onclick='errMessF()'>&times;</span><b>Error! </b>Invalid Input Value";
    }


    // SUCCESS PRODUCT
    if (err == "successAddProduct") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Product Added Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successEditProduct") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Product Edited Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successDelProduct") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Product Deleted Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }


    // SUCCESS CAT
    if (err == "successAddCat") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Category Added Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successEditCat") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Category Edited Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successDelCat") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Category Deleted Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }


    // SUCCESS BRAND
    if (err == "successAddBrand") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Brand Added Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successEditBrand") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Brand Edited Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successDelBrand") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Brand Deleted Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }


    // SUCCESS CUSTOMER
    if (err == "successAddCus") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Customer Added Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successEditCus") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Customer Edited Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successDelCus") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Customer Deleted Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }


    // SUCCESS SUPPLIER
    if (err == "successAddSup") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Supplier Added Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successEditSup") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Supplier Edited Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successDelSup") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Supplier Deleted Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }

    // SUCCESS ACCOUNT
    if (err == "successAddAcc") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Account Added Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successEditAcc") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Account Edited Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
    if (err == "successDelAcc") {
      document.getElementById("successBox").hidden = false;
      document.getElementById("successMess").innerHTML = tagS + "Success! </b>Account Deleted Successfully "
      setTimeout(function() { document.getElementById("successBox").hidden = true; }, 2000);
    }
  </script>
</body>
<div style="width:100%;height:100%;position: relative">
  <a class="question" style="" href="javascript:void(0);" onclick="openChat()">
<img width="174" height="174" src="data:image/png;base64,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AgQIECBAIN2L+/yiomcleWJVzfLuIECAAAECBAgQILCTAp2L+3wO+iOr6n07ORk3RYAAAQIECBAgQOBqAh2L+5uTPKiq5pcYOQgQIECAAAECBAjshUCn4n55kkdU1XzEo4MAAQIECBAgQIDAXgl0KO4fTvL4JM+uqi/s1XTcLAECBAgQIECAAIGVQIfifqOq+qSJESBAgAABAgQIENhngcUX930ejnsnQIAAAQIECBAg8CUBxd0uECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAjKp+9YAAAbRUlEQVQQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIKC4NxiSiAQIECBAgAABAgQUdztAgAABAgQIECBAoIGA4t5gSCISIECAAAECBAgQUNztAAECBAgQIECAAIEGAop7gyGJSIAAAQIECBAgQEBxtwMECBAgQIAAAQIEGggo7g2GJCIBAgQIECBAgAABxd0OECBAgAABAgQIEGggoLg3GJKIBAgQIECAAAECBBR3O0CAAAECBAgQIECggYDi3mBIIhIgQIAAAQIECBBQ3O0AAQIECBAgQIAAgQYCinuDIYlIgAABAgQIECBAQHG3AwQIECBAgAABAgQaCCjuDYYkIgECBAgQIECAAAHF3Q4QIECAAAECBAgQaCCguDcYkogECBAgQIAAAQIEFHc7QIAAAQIECBAgQKCBgOLeYEgiEiBAgAABAgQIEFDc7QABAgQIECBAgACBBgKKe4MhiUiAAAECBAgQIEBAcbcDBAgQIECAAAECBBoIKO4NhiQiAQIECBAgQIAAAcXdDhAgQIAAAQIECBBoIPD/APax9RzbD3TEAAAAAElFTkSuQmCC"/>  
</a>
<div style="width:100%; height:100%; position:relative">
  <div class="chatBox" id="chatBox">
  <div class="chatHeader">
    
  <!-- <div class="loader" id="loader"></div> -->
    <div class="activeBot"></div>
    <b class="chatHeaderText">Chatbot&nbsp;</b>
    
      
    <b class="chatHeaderClose" onclick="closeChat()">&nbsp;&nbsp;x&nbsp;&nbsp;&nbsp;</b>
    
  </div>
  
    <div class="chatArea" id="chatArea">
      <div class="textBoxBot" id="text">Hello there, my name is Thien Nam, you can ask me anything about VNS's operation, function, error and organization :)</div>
      <div class="textBoxBot" id="text">Furthur more, you can write down the error you got while using VNS and i will give you more detail about that</div>
      <div class="tidotF" id="tidot" hidden>
        <div class="tidot t1" id="t1" ></div>
        <div class="tidot t2" id="t2" ></div>
        <div class="tidot t3" id="t3" ></div>
      </div>
    </div>
    
    <form id="formChat">
      <div class="row" style="padding: 8px 8px 8px 21px; top:0; right: 0">
      <input id="userText" type="text" class="form-control" style="height: 30px; width:240px; padding: 10px 5px">
        <div style="padding: 0 0 0 10px;" href="javascript:void(0);">
          <input type="submit" class="btn btn-primary btn-block" style="padding: 1px 5px" id="send" value="Send" name="send" onclick="load()">
        </div>
      </div>
    </form>
    
  </div>
</div>
  <script src="jsFunction/bot-data.js"></script>
  <script src="jsFunction/chatbot.js"></script>
</html>

<?php 

// INSERT
if(isset($_POST['addProduct']))
{
  $proName = $_POST['product_name'];
  $proCode = $_POST['product_code'];
  $proNPrice = $_POST['product_nprice'];
  $proDPrice = $_POST['product_dprice'];
  $proAmount = $_POST['amount'];
  $proColor = $_POST['color'];
  $proBrand = $_POST['product_brand'];
  if($_FILES['product_img2']['name']==""){
    $proImg = $_FILES['product_img'];
  } else {
    $proImg = $_FILES['product_img2'];
  }
  $proCat = $_POST['product_cat'];
  $proDes = $_POST['des'];
  $result = mysqli_query($conn, "select product_code from product where 
  account_id='".$_SESSION['account_id']."' 
  and product_code = '".trim(ucwords($proCode))."' 
  and product_name = '".trim(ucwords($proName))."'");
  if(mysqli_num_rows($result)==0){
    $result = mysqli_query($conn, "select img from product where img='".$proImg['name']."'");
    if(mysqli_num_rows($result)==0){
      if($proImg['type']=="image/jpg" || $proImg['type']=="image/jpeg"|| $proImg['type']=="image/png" || $proImg['type']=="image/bmp")
      { 
        list($width, $height, $type, $attr) = getimagesize($proImg['tmp_name']);
        $insert;
        $maxwidth = 512; //maximum width of allowed image dimension in pixels
        if($width / $height > 2  || $height / $width > 2.5 ){
          $err = "oversize";
        } else {
          if($proImg['size'] >= 524288){
            compressimage($proImg['tmp_name'], "data/pro_img/".$proImg['name'], $maxwidth);
            $insert = 1;
          } else {
            if($width > $maxwidth){
              compressimage($proImg['tmp_name'], "data/pro_img/".$proImg['name'], $maxwidth);
              $insert = 1;
            } else {
              $result = move_uploaded_file($proImg['tmp_name'],  "data/pro_img/".$proImg['name']);
              $insert = 1;
            }
          }
          if($insert==1){
            mysqli_query($conn,"INSERT INTO product (`product_code`, `product_name`, `category_id`, `brand_id`, `img`, `color`, `amount`, `normal_price`, `discount_price`, `describe`, `account_id`) 
            values('".trim(strtoupper($proCode))."', '".trim(ucwords($proName))."',  '".trim(ucwords($proCat))."',  '".trim(ucwords($proBrand))."', '".$proImg['name']."', '$proColor', '$proAmount', '$proNPrice', '$proDPrice', 
            '".trim($proDes)."', '".$_SESSION['account_id']."')");
            mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Product Add: ".trim(ucwords($proName))."','".$_SESSION['account_id']."')");
            $err = "successAddProduct";
            unset($proName);
            unset($proCode);
            unset($proNPrice);
            unset($proDPrice);
            unset($proAmount);
            unset($proColor);
            unset($proImg);
            unset($proDes);
          }
        }
      } else {
      $err = "format";
      }

    } else {
      if($proImg['type']=="image/jpg" || $proImg['type']=="image/jpeg"|| $proImg['type']=="image/png" || $proImg['type']=="image/bmp")
      { 
        list($width, $height, $type, $attr) = getimagesize($proImg['tmp_name']);
        $insert;
        $file = time().$proImg['name'];
        $maxwidth = 512; //maximum width of allowed image dimension in pixels
        if($width / $height > 2  || $height / $width > 2.5 ){
          $err = "oversize";
        } else {
          
          if($proImg['size'] >= 524288){
            compressimage($proImg['tmp_name'], "data/pro_img/".$file, $maxwidth);
            $insert = 1;
          } else {
            if($width > $maxwidth){
              compressimage($proImg['tmp_name'], "data/pro_img/".$file, $maxwidth);
              $insert = 1;
            } else {
              $result = move_uploaded_file($proImg['tmp_name'],  "data/pro_img/".$file);
              $insert = 1;
            }
          }
          if($insert==1){
            mysqli_query($conn,"INSERT INTO product (`product_code`, `product_name`, `category_id`, `brand_id`, `img`, `color`, `amount`, `normal_price`, `discount_price`, `describe`, `account_id`) 
            values('".trim(strtoupper($proCode))."', '".trim(ucwords($proName))."',  '".trim(ucwords($proCat))."',  '".trim(ucwords($proBrand))."', '$file', '$proColor', '$proAmount', '$proNPrice', '$proDPrice', 
            '".trim($proDes)."', '".$_SESSION['account_id']."')");
            mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Product Add: ".trim(ucwords($proName))."','".$_SESSION['account_id']."')");

            $err = "successAddProduct";
            unset($proName);
            unset($proCode);
            unset($proNPrice);
            unset($proDPrice);
            unset($proAmount);
            unset($proColor);
            unset($proImg);
            unset($proDes);
          }
        }
      } else {
      $err = "format";
      }
    }
    
  } else {
    $err = "duplicated";
  }

  $result = mysqli_query($conn, "select category_name from category where 
  account_id='".$_SESSION['account_id']."' 
  and category_name = '".trim(ucwords($proCat))."' ");
  if(mysqli_num_rows($result)==0){
    mysqli_query($conn,"INSERT INTO category (`category_name`, `account_id`) 
    values('".trim(ucwords($proCat))."', '".$_SESSION['account_id']."')");
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Category Add: ".trim(ucwords($proCat))."','".$_SESSION['account_id']."')");

    unset($proCat);
  }
  $result = mysqli_query($conn, "select brand_name from brand where 
  account_id='".$_SESSION['account_id']."' 
  and brand_name = '".trim(ucwords($proBrand))."' ");
  if(mysqli_num_rows($result)==0){
    mysqli_query($conn,"INSERT INTO brand (`brand_name`, `account_id`) 
    values('".trim(ucwords($proBrand))."', '".$_SESSION['account_id']."')");
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Brand Add: ".trim(ucwords($proBrand))."','".$_SESSION['account_id']."')");

    unset($proBrand);
  }
}

// EDIT
if(isset($_POST['editProduct']))
{
  $proIdEdit = $_POST['product_id_edit'];
  $proNameEdit = $_POST['product_name_edit'];
  $proCodeEdit = $_POST['product_code_edit'];
  $proNPriceEdit = $_POST['product_nprice_edit'];
  $proDPriceEdit = $_POST['product_dprice_edit'];
  $proAmountEdit = $_POST['product_amount_edit'];
  $proColorEdit = $_POST['product_color_edit'];
  $proBrandEdit = $_POST['product_brand_edit'];
  $proImgEdit = $_FILES['product_img_edit'];
  $proCatEdit = $_POST['product_cat_edit'];
  $proDesEdit = $_POST['product_des_edit'];
 
  
  $result = mysqli_query($conn, "select product_code from product where 
  account_id='".$_SESSION['account_id']."' 
  and product_code = '".trim(ucwords($proCodeEdit))."' 
  and product_name = '".trim(ucwords($proNameEdit))."'
  and product_id <> '$proIdEdit' ");
  if(mysqli_num_rows($result)==0){
    if($proImgEdit['name'] == "")
    {
      mysqli_query($conn,"UPDATE `product` SET 
      `product_code` = '".trim(strtoupper($proCodeEdit))."', 
      `product_name` = '".trim(ucwords($proNameEdit))."',
      `category_id` = '$proCatEdit',
      `brand_id` = '$proBrandEdit',
      `color` = '$proColorEdit',
      `amount` = '$proAmountEdit',
      `normal_price` = '$proNPriceEdit',
      `discount_price` = '$proDPriceEdit',
      `describe` = '".trim($proDesEdit)."',
      `account_id` = '".$_SESSION['account_id']."'
      WHERE `product_id` = '$proIdEdit'");
      mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Product Edit: ".trim(ucwords($proNameEdit))."','".$_SESSION['account_id']."')");

      $err = "successEditProduct";
      unset($proIdEdit);
      unset($proNameEdit);
      unset($proCodeEdit);
      unset($proNPriceEdit);
      unset($proDPriceEdit);
      unset($proAmountEdit);
      unset($proColorEdit);
      unset($proBrandEdit);
      unset($proCatEdit); 
      unset($proDesEdit);
    } else {
      $result = mysqli_query($conn, "select img from product where product_id='$proIdEdit'");
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      unlink("data/pro_img/".$row['img']);
      if(mysqli_num_rows($result)==0){
        if($proImgEdit['type']=="image/jpg" || $proImgEdit['type']=="image/jpeg"|| $proImgEdit['type']=="image/png" || $proImgEdit['type']=="image/bmp")
        { 
          list($width, $height, $type, $attr) = getimagesize($proImgEdit['tmp_name']);
          $insert;
          $maxwidth = 512;
          if($width / $height > 2  || $height / $width > 1.6 ){
            $err = "oversizeEdit";
          } else {
            if($proImgEdit['size'] >= 524288){
              compressimage($proImgEdit['tmp_name'], "data/pro_img/".$proImgEdit['name'], $maxwidth);
              $insert = 1;
            } else {
              if($width > $maxwidth){
                compressimage($proImgEdit['tmp_name'], "data/pro_img/".$proImgEdit['name'], $maxwidth);
                $insert = 1;
              } else {
                $result = move_uploaded_file($proImgEdit['tmp_name'],  "data/pro_img/".$proImgEdit['name']);
                $insert = 1;
              }
            }
            if($insert==1){
              mysqli_query($conn,"UPDATE `product` SET 
              `product_code` = '".trim(strtoupper($proCodeEdit))."', 
              `product_name` = '".trim(ucwords($proNameEdit))."',
              `category_id` = '".trim(ucwords($proCatEdit))."',
              `brand_id` = '".trim(ucwords($proBrandEdit))."',
              `color` = '$proColorEdit',
              `amount` = '$proAmountEdit',
              `normal_price` = '$proNPriceEdit',
              `discount_price` = '$proDPriceEdit',
              `img` = '".$proImgEdit['name']."',
              `describe` = '".trim($proDesEdit)."',
              `account_id` = '".$_SESSION['account_id']."'
              WHERE `product_id` = '$proIdEdit'");
              mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Product Edit: ".trim(ucwords($proNameEdit))."','".$_SESSION['account_id']."')");

              $err = "successEditProduct";
              unset($proIdEdit);
              unset($proNameEdit);
              unset($proCodeEdit);
              unset($proNPriceEdit);
              unset($proDPriceEdit);
              unset($proAmountEdit);
              unset($proColorEdit);
              unset($proImgEdit);
              unset($proDesEdit);
            }
          }
        } else {
        $err = "formatEdit";
        }
      } else {
        if($proImgEdit['type']=="image/jpg" || $proImgEdit['type']=="image/jpeg"|| $proImgEdit['type']=="image/png" || $proImgEdit['type']=="image/bmp")
        { 
          list($width, $height, $type, $attr) = getimagesize($proImgEdit['tmp_name']);
          $insert;
          $file = time().$proImgEdit['name'];
          $maxwidth = 512;
          if($width / $height > 2  || $height / $width > 1.6 ){
            $err = "oversizeEdit";
          } else {
            if($proImgEdit['size'] >= 524288){
              compressimage($proImgEdit['tmp_name'], "data/pro_img/".$file, $maxwidth);
              $insert = 1;
            } else {
              if($width > $maxwidth){
                compressimage($proImgEdit['tmp_name'], "data/pro_img/".$file, $maxwidth);
                $insert = 1;
              } else {
                $result = move_uploaded_file($proImgEdit['tmp_name'],  "data/pro_img/".$file);
                $insert = 1;
              }
            }
            if($insert==1){
              mysqli_query($conn,"UPDATE `product` SET 
              `product_code` = '".trim(strtoupper($proCodeEdit))."', 
              `product_name` = '".trim(ucwords($proNameEdit))."',
              `category_id` = '$proCatEdit',
              `brand_id` = '$proBrandEdit',
              `color` = '$proColorEdit',
              `amount` = '$proAmountEdit',
              `normal_price` = '$proNPriceEdit',
              `discount_price` = '$proDPriceEdit',
              `img` = '$file',
              `describe` = '".trim($proDesEdit)."',
              `account_id` = '".$_SESSION['account_id']."'
              WHERE `product_id` = '$proIdEdit'");
              mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Product Edit: ".trim(ucwords($proNameEdit))."','".$_SESSION['account_id']."')");

              $err = "success";
              unset($proIdEdit);
              unset($proNameEdit);
              unset($proCodeEdit);
              unset($proNPriceEdit);
              unset($proDPriceEdit);
              unset($proAmountEdit);
              unset($proColorEdit);
              unset($proImgEdit);
              unset($proDesEdit);
            }
          }
        } else {
        $err = "formatEdit";
        }
      }
      
    }
  } else {
    $err = "duplicatedEdit";
  }
  $result = mysqli_query($conn, "select category_name from category where 
  account_id='".$_SESSION['account_id']."' 
  and category_name = '".trim(ucwords($_POST['product_cat_edit']))."' ");
  if(mysqli_num_rows($result)==0){
    mysqli_query($conn,"INSERT INTO category (`category_name`, `account_id`) 
    values('".trim(ucwords($_POST['product_cat_edit']))."', '".$_SESSION['account_id']."')");
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Category Add: ".trim(ucwords($proCatEdit))."','".$_SESSION['account_id']."')");

    unset($proCatEdit);
  }
  $result = mysqli_query($conn, "select brand_name from brand where 
  account_id='".$_SESSION['account_id']."' 
  and brand_name = '".trim(ucwords($_POST['product_brand_edit']))."' ");
  if(mysqli_num_rows($result)==0){
    mysqli_query($conn,"INSERT INTO brand (`brand_name`, `account_id`) 
    values('".trim(ucwords($_POST['product_brand_edit']))."', '".$_SESSION['account_id']."')");
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Brand Add: ".trim(ucwords($proBrandEdit))."','".$_SESSION['account_id']."')");

    unset($proBrandEdit);
  }
}

// DELETE
if(isset($_POST['delete']))
{
  $proId = $_POST['delete_id'];

  $result = mysqli_query($conn, "select product_name from product where product_id = '$proId'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Product Delete: ".$row['product_name']."','".$_SESSION['account_id']."')");

  $result = mysqli_query($conn,"select img from product where product_id = '$proId' and account_id = '".$_SESSION['account_id']."'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  unlink("data/pro_img/".$row['img']);
  mysqli_query($conn, "delete from product where product_id = '$proId' and account_id='".$_SESSION['account_id']."'");
  $err = "successDelProduct";
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<div class="container-fluid" id="container-wrapper">
  <!-- Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between" style="padding-bottom: 0">
          <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
          <a style="font-size: 30px" href="javascript:void(0);" data-toggle="modal" data-target="#addProduct" onclick="errMess()">
              <i class="fas fa-plus-square"></i>
          </a>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" style="table-layout: fixed ;" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th style="width: 150px; padding-left: 10px">Image</th>
                <th style="width: 180px; padding-left: 10px">Name</th>
                <th style="width: 70px; padding-left: 10px">Brand</th>
                <th style="width: 60px; padding-left: 10px">Color</th>
                <th style="width: 70px; padding-left: 10px">Category</th>
                <th style="width: 70px; padding-left: 10px">Quantity</th>
                <th style="width: 150px; padding-left: 10px">Price / Unit</th>
                <th style="width: 30px;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($conn, "SELECT *
                FROM product
                WHERE account_id = '".$_SESSION['account_id']."'");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <tr>
                <td hidden><?php echo $row['product_id'] ?></td>
                <td hidden><?php echo $row['product_code'] ?></td>
                <td hidden><?php echo $row['product_name'] ?></td>
                <td hidden><?php echo $row['discount_price'] ?></td>
                <td hidden><?php echo $row['normal_price'] ?></td>
                <td hidden><?php echo $row['describe'] ?></td>
                <td hidden><?php echo $row['brand_id'] ?></td>
                <td hidden><?php echo $row['category_id'] ?></td>
                <td hidden><?php echo $row['img'] ?></td>
                <?php if($row['img']==""){ ?>
                  <td style="width: 300px"><div style="padding: 25px 30%"><i style="font-size:400%; color: #6777ef" class="fas fa-regular fa-image"></div></i></td>
                <?php } else { ?>
                  <td style="width: 300px; max-height: 100px; padding: 10px"><div class="fluid" style="width: 100%"><img class="rounded fluid" style="width:100%;" src="data/pro_img/<?php echo $row['img'] ?>"></div></td>
                <?php } ?>
                <td style="padding: 10px 10px"><?php echo $row['product_name'].' ('.$row['product_code'].')' ?></td>
                <td style="padding: 10px 10px"><?php echo $row['brand_id'] ?></td>
                <td style="padding: 10px 10px"><?php echo $row['color'] ?></td>
                <td style="padding: 10px 10px"><?php echo $row['category_id'] ?></td>
                <td style="padding: 10px 10px"><?php echo $row['amount'] ?></td>
                <td style="padding: 10px 10px;"><?php echo toMoney($row['normal_price'])."<br>in total<br>".toMoney($row['normal_price']*$row['amount'])?></td>
                <td style="padding: 10px;">
                  <a href="" class="editProduct" data-toggle="modal" data-target="#editProduct">
                      <i class="fas fa-edit"></i>
                  </a> &nbsp; | &nbsp;
                  <a href="" class="deleteConfirmProduct" id="" data-toggle="modal" data-target="#deleteConfirmProduct">
                      <i class="fas fa-trash"></i>
                  </a>
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
  
  <!-- Add product screen -->
  <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div style="max-width: 800px"  class="modal-dialog " role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Add Product</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formAddProduct" onsubmit="return validateProductAdd();">

            <div class="form-group row">
              <div class="col-md-1" style="text-align: left ; padding: 10px 0px 5px 15px"><b style="color: #383838;font-size: 18px;">Name:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
              <div class="col-md-11">
                <input type="text" maxlength="150" class="form-control" id="product_name" name="product_name" value="<?php if(isset($proName)) echo $proName?>" onchange="validateProName(this.value)" placeholder="Enter product name (Donut, Bimbim, ...)">
                <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_name_status"></p>
              </div>
            </div>

            <div class="row" >
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Code:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                  <div class="col-md-10">
                    <input type="text" maxlength="15" class="form-control" id="product_code" name="product_code" value="<?php if(isset($proCode)) echo $proCode?>" onchange="validateProCode(this.value)" placeholder="Enter product code (FDN22, FBN22, ...)">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_code_status"></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 0px"><b style="color: #383838;font-size: 18px;">Amount:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" min="0" id="amount" name="amount" value="<?php if(isset($proAmount)) echo $proAmount?>" onchange="validateProAmount(this.value)" placeholder="Amount">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_amount_status"></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left; padding: 10px 5px 5px 15px"><b style="color:#383838;font-size: 18px">Color:</b></div>
                  <div class="col-md-10">
                    <input class="form-control" maxlength="30" list="colorList" id="color" name="color" value="<?php if(isset($proColor)) echo $proColor?>" onchange="validateProColor(this.value)" placeholder="Color">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_color_status"></p>
                    <datalist id="colorList">
                      <option value="Blue">Blue</option>
                      <option value="Red">Red</option>
                      <option value="Yellow">Yellow</option>
                      <option value="White">White</option>
                      <option value="Black">Black</option>
                      <option value="Green">Green</option>
                      <option value="Pink">Pink</option>
                      <option value="Brown">Brown</option>
                      <option value="Silver">Silver</option>
                      <option value="Gray">Gray</option>
                      <option value="Orange">Orange</option>
                    </datalist>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left; padding: 10px 5px 5px 5px"><b style="color:#383838;font-size: 18px">Brand:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                  <div class="col-md-10">
                    <input class="form-control" maxlength="30" list="brandList" id="product_brand" name="product_brand" value="<?php if(isset($proBrand)) echo $proBrand?>" onchange="validateProBrand(this.value)" placeholder="Brand">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_brand_status"></p>
                    <datalist id="brandList">
                      <?php
                        $result = mysqli_query($conn, "select brand_name from brand where account_id =".$_SESSION['account_id']."");
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                          echo "<option value='".$row['brand_name']."'></option>";
                        }
                      ?>
                    </datalist>
                  </div>
                </div>
              </div>
            </div>

            <div class="row" >
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Price:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" min="1" id="product_nprice" name="product_nprice" value="<?php if(isset($proNPrice)) echo $proNPrice?>" onchange="validateProNPrice(this.value)" placeholder="($)">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_nprice_status"></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 5px"><b style="color: #383838;font-size: 18px;">Discount %:</b></div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" min="0" max="100" id="product_dprice" name="product_dprice" value="<?php if(isset($proDPrice)) echo $proDPrice?>" onchange="validateProDPrice(this.value)" placeholder="(%)">
                    <p style="font-size: 12px; position: absolute; color: red; bottom: -33px; left: 15px" id="pro_dprice_status"></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6" style="padding: 10px 15px 10px 15px;">
                <div style="top: 10px; left: 30px; width: 100%; border-radius: 5px; display: flex; justify-content: center" id="img" hidden>
                  <img id="selected_img" style="border-radius: 5px; max-height: 200px" src="#" />  
                </div>
                <div style="border: 4px dashed #6777ef; height: 250px" id="up_img">
                  <input style="position:absolute; width:84%; height:90%; opacity:0; cursor:pointer;" type='file' onchange="readURLadd(this);" id="product_img" name="product_img" accept="image/*" />
                  <div style="text-align: center;">
                    <h3 style="font-weight: 100;text-transform: uppercase;text-decoration: underline;color: #6777ef;padding: 100px 0;">Upload Image</h3>
                  </div>
                </div>
                <input style="margin-top: 10px" type='file' hidden onchange="readURLadd(this);" id="product_img2" name="product_img2" accept="image/*" />
              </div>
              <div class="col-md-6" style="padding-left: 0">
                <div style="text-align: left; padding: 0 5px 5px 5px"><b style="color:#383838;font-size: 18px;">Category:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                <div style="padding-left: 10px; padding-bottom: 10px">
                    <input class="form-control" maxlength="30" list="catList" id="product_cat" name="product_cat" value="<?php if(isset($proCat)) echo $proCat?>" onchange="validateProCat(this.value)" placeholder="Category">
                    <p style="font-size:12px;position:absolute;color:red;bottom:153px;left:15px" id="pro_cat_status"></p>
                    <datalist id="catList">
                      <?php
                        $result = mysqli_query($conn, "select category_name from category where account_id =".$_SESSION['account_id']."");
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                          echo "<option value='".$row['category_name']."'></option>";
                        }
                      ?>
                    </datalist>
                </div>
                <div style="text-align: left; padding: 0 5px 5px 5px"><b style="color:#383838;font-size: 18px;">Describe:</b></div>
                <div style="padding-left: 10px">
                  <textarea class="form-control" style="height: 142px; resize:none" row="10" id="des" name="des" placeholder="Product description..."></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="addProduct" onclick="validateProduct()">Add</button>
            </div>
          </form>
        </div>

        <div class="errBox" id="errBox" hidden >
          <p class="errMess" id="errMess"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Add product screen -->

  <!-- Edit product screen -->
  <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
    <div style="max-width: 800px"  class="modal-dialog " role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Edit Product</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formAddProduct" onsubmit="return validateProductEdit();">

            <input type="text" hidden id="product_id_edit" name="product_id_edit" >

            <div class="form-group row">
              <div class="col-md-1" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Name:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
              <div class="col-md-11">
                <input type="text" maxlength="150" class="form-control" id="product_name_edit" name="product_name_edit" value="<?php if(isset($proNameEdit)) echo $proNameEdit?>" onchange="validateProNameEdit(this.value)" placeholder="Enter product name (Donut, Bimbim, ...)">
                <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_name_status_edit"></p>
              </div>
            </div>

            <div class="row" >
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Code:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                  <div class="col-md-10">
                    <input type="text" maxlength="15" class="form-control" id="product_code_edit" name="product_code_edit" value="<?php if(isset($proCodeEdit)) echo $proCodeEdit?>" onchange="validateProCodeEdit(this.value)" placeholder="Enter product code (FDN22, FBN22, ...)">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_code_status_edit"></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 0"><b style="color: #383838;font-size: 18px;">Amount:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" min="0" id="product_amount_edit" name="product_amount_edit" value="<?php if(isset($proAmount)) echo $proAmount?>" onchange="validateProAmountEdit(this.value)" placeholder="Amount">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_amount_status_edit"></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left; padding: 10px 5px 5px 15px"><b style="color:#383838;font-size: 18px">Color:</b></div>
                  <div class="col-md-10">
                    <input class="form-control" maxlength="30" list="colorList" id="product_color_edit" name="product_color_edit" value="<?php if(isset($proColorEdit)) echo $proColorEdit?>" onchange="validateProColorEdit(this.value)" placeholder="Color">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_color_status_edit"></p>
                    <datalist id="colorList">
                      <option value="Blue">Blue</option>
                      <option value="Red">Red</option>
                      <option value="Yellow">Yellow</option>
                      <option value="White">White</option>
                      <option value="Black">Black</option>
                      <option value="Green">Green</option>
                      <option value="Pink">Pink</option>
                      <option value="Brown">Brown</option>
                      <option value="Silver">Silver</option>
                      <option value="Gray">Gray</option>
                      <option value="Orange">Orange</option>
                    </datalist>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left; padding: 10px 5px 5px 5px"><b style="color:#383838;font-size: 18px">Brand:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                  <div class="col-md-10">
                  <input class="form-control" maxlength="30" list="brandList" id="product_brand_edit" name="product_brand_edit" value="<?php if(isset($proBrandEdit)) echo $proBrandEdit?>" onchange="validateProBrandEdit(this.value)" placeholder="Brand">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_brand_status_edit"></p>
                    <datalist id="brandList">
                      <?php
                        $result = mysqli_query($conn, "select brand_name from brand where account_id =".$_SESSION['account_id']."");
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                          echo "<option value='".$row['brand_name']."'></option>";
                        }
                      ?>
                    </datalist>
                  </div>
                </div>
              </div>
            </div>

            <div class="row" >
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Price:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                  <div class="col-md-10">
                    <input type="number" class="form-control" min="1" maxLength="11" id="product_nprice_edit" name="product_nprice_edit" value="<?php if(isset($proNPriceEdit)) echo $proNPriceEdit?>" onchange="validateProNPriceEdit(this.value)" placeholder="($)">
                    <p style="font-size:12px;position:absolute;color:red;bottom:-33px;left:15px" id="pro_nprice_status_edit"></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 5px"><b style="color: #383838;font-size: 18px;">Discount %:</b></div>
                  <div class="col-md-8">
                    <input type="number" class="form-control" min="0" max="100"  maxLength="11" id="product_dprice_edit" name="product_dprice_edit" value="<?php if(isset($proDPriceEdit)) echo $proDPriceEdit?>" onchange="validateProDPriceEdit(this.value)" placeholder="(%)">
                    <p style="font-size: 12px; position: absolute; color: red; bottom: -33px; left: 15px" id="pro_dprice_status_edit"></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6" style="padding: 10px 15px 10px 15px;">
                <div style="top: 10px; left: 30px; width: 100%; border-radius: 5px; display: flex; justify-content: center" id="img">
                  <img id="selected_img_edit" style="border-radius: 5px; max-height: 200px" src="<?php if(isset($proImgEdit)) echo $proImgEdit?>" />  
                </div>
                <input style="margin-top: 10px" type='file' onchange="readURLedit(this);" id="product_img2_edit" name="product_img_edit" accept="image/*" />
              </div>
              <div class="col-md-6" style="padding-left: 0">
                <div style="text-align: left; padding: 0 5px 5px 5px"><b style="color:#383838;font-size: 18px;">Category:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
                <div style="padding-left: 10px; padding-bottom: 10px">
                <input class="form-control" maxlength="30" list="catList" id="product_cat_edit" name="product_cat_edit" value="<?php if(isset($proCatEdit)) echo $proCatEdit?>" onchange="validateProCatEdit(this.value)" placeholder="Category">
                    <p style="font-size:12px;position:absolute;color:red;bottom:153px;left:15px" id="pro_cat_status_edit"></p>
                    <datalist id="catList">
                      <?php
                        $result = mysqli_query($conn, "select category_name from category where account_id =".$_SESSION['account_id']."");
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                          echo "<option value='".$row['category_name']."'></option>";
                        }
                      ?>
                    </datalist>
                </div>
                <div style="text-align: left; padding: 0 5px 5px 5px"><b style="color:#383838;font-size: 18px;">Describe:</b></div>
                <div style="padding-left: 10px">
                  <textarea class="form-control" style="height: 142px; resize:none" row="10" id="product_des_edit" name="product_des_edit" placeholder="Product description..."></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="editProduct">Add</button>
            </div>
          </form>
        </div>

        <div class="errBox" id="errBoxEdit" hidden >
          <p class="errMess" id="errMessEdit"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Edit product screen -->
  
  <!-- Delete Confirm -->
  <div class="modal fade" id="deleteConfirmProduct" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding-top: 25px">
          <h4> Are you sure to delete product <b id="deleteMess" ></b></h4>
        </div>
        <div class="modal-footer">
        <form method="post">
          <input name="delete_id" class="delete_id" id="delete_id" hidden>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="delete">Confirm</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Confirm -->

</div>



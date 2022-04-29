<div class="container-fluid" id="container-wrapper">
<?php
  // Add Category
  if(isset($_POST['addCat']))
  {
    $catName = $_POST['cat_name'];
    $result = mysqli_query($conn, "select * from category where account_id='".$_SESSION['account_id']."' and category_name='$catName'");
    if(mysqli_num_rows($result)==0)
    {
      mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Category Add: ".trim(ucwords($catName))."','".$_SESSION['account_id']."')");
      mysqli_query($conn,"insert into category(category_name, account_id) values('".trim(ucwords($catName))."','".$_SESSION['account_id']."')");
      
      unset($catName);
      $err = "successAddCat";
    } else {
      $err = "duplicatedCat";
    }
  }

  // Add Brand
  if(isset($_POST['addBrand']))
  {
    $brandName = $_POST['brand_name'];
    $result = mysqli_query($conn, "select * from brand where account_id='".$_SESSION['account_id']."' and brand_name='$brandName'");
    if(mysqli_num_rows($result)==0)
    {
      mysqli_query($conn,"insert into brand(brand_name, account_id) values('".trim(ucwords($brandName))."','".$_SESSION['account_id']."')");
      mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Brand Add: ".trim(ucwords($brandName))."','".$_SESSION['account_id']."')");
      unset($brandName);
      $err = "successAddBrand";
    } else {
      $err = "duplicatedBrand";
    }
  }

  // Edit Category
  if(isset($_POST['editCat']))
  {
    $catId = $_POST['cat_id_edit'];
    $catName = $_POST['cat_name_edit'];
    $result = mysqli_query($conn, "select * from category where account_id='".$_SESSION['account_id']."' and category_name='$catName' and category_id <> '$catId'");
    if(mysqli_num_rows($result)==0)
    {
      $result = mysqli_query($conn, "select * from category where account_id='".$_SESSION['account_id']."' and category_id = '$catId'");
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      mysqli_query($conn,"UPDATE product SET category_id = '".trim(ucwords($catName))."' WHERE category_id='".$row['category_name']."' and account_id = '".$_SESSION['account_id']."'");
      mysqli_query($conn,"UPDATE category SET category_name = '".trim(ucwords($catName))."' WHERE category_id='$catId' and account_id = '".$_SESSION['account_id']."'");
      mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Category Edit: ".trim(ucwords($catName))."','".$_SESSION['account_id']."')");
      unset($catName);
      $err = "successEditCat";
    } else {

      $err = "duplicatedCatEdit";
    }
    
  }

  // Edit Brand
  if(isset($_POST['editBrand']))
  {
    $brandId = $_POST['brand_id_edit'];
    $brandName = $_POST['brand_name_edit'];
    $result = mysqli_query($conn, "select * from brand where account_id='".$_SESSION['account_id']."' and brand_name='$brandName' and brand_id <> '$brandId'");
    if(mysqli_num_rows($result)==0)
    {
      $result = mysqli_query($conn, "select * from brand where account_id='".$_SESSION['account_id']."' and brand_id = '$brandId'");
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      mysqli_query($conn,"UPDATE product SET brand_id = '".trim(ucwords($brandName))."' WHERE brand_id='".$row['brand_name']."' and account_id = '".$_SESSION['account_id']."'");
      mysqli_query($conn,"UPDATE brand SET brand_name = '".trim(ucwords($brandName))."' WHERE brand_id='$brandId' and account_id = '".$_SESSION['account_id']."'");
      mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Brand Edit: ".trim(ucwords($brandName))."','".$_SESSION['account_id']."')");

      unset($brandName);
      $err = "successEditBrand";
    } else {
      $err = "duplicatedBrandEdit";
    }
  }

  // Delete Category
  if(isset($_POST['delete_cat'])){
    $id =$_POST['delete_id_cat'];

    $result = mysqli_query($conn, "select category_name from category where category_id = '$id'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Category Delete: ".$row['category_name']."','".$_SESSION['account_id']."')");

    mysqli_query($conn, "delete from category where category_id = '$id' and account_id='".$_SESSION['account_id']."'");
    $err = "successDelCat";
  }

  // Delete Brand
  if(isset($_POST['delete_brand'])){  
    $id =$_POST['delete_id_brand'];

    $result = mysqli_query($conn, "select brand_name from brand where brand_id = '$id'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Brand Delete: ".$row['brand_name']."','".$_SESSION['account_id']."')");

    mysqli_query($conn, "delete from brand where brand_id = '$id' and account_id='".$_SESSION['account_id']."'");
    $err = "successDelBrand";
  }
?>
  <!-- Row -->
  <div class="row">


    <!-- CATEGORY -->
    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Category</h6>
          <a style="font-size: 30px" href="javascript:void(0);" data-toggle="modal" data-target="#addCat" onclick="errMess()">
              <i class="fas fa-plus-square"></i>
          </a>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th hidden="true"></th>
                <th>Type</th>
                <th style="width: 76px;">Edit</th>
              </tr>
            </thead>
            <tbody>
            <?php
                  $result = mysqli_query($conn, "select * from category where account_id = '".$_SESSION['account_id']."' ");
                  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <tr>
                  <td hidden="true"><?php echo $row['category_id'] ?></td>
                  <td><?php echo $row['category_name'] ?></td>
                  <td style="width: 100px;">

                    <a href="" data-toggle="modal" data-target="#editCat" class="editCat" id="">
                        <i class="fas fa-edit"></i>
                    </a>
                    
                    &nbsp;|&nbsp;
                    <a href="" class="deleteConfirmCat" id="" data-toggle="modal" data-target="#deleteConfirmCat">
                        <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- CATEGORY -->


    <!-- BRAND -->
    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Brand</h6>
          <a style="font-size: 30px" href="javascript:void(0);" data-toggle="modal" data-target="#addBrand" onclick="errMessB()">
              <i class="fas fa-plus-square"></i>
          </a>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
            <thead class="thead-light">
              <tr>
                <th hidden="true"></th>
                <th>Brand</th>
                <th style="width: 76px;">Edit</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $result = mysqli_query($conn, "select * from brand where account_id = '".$_SESSION['account_id']."'");
                  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <tr>
                  <td hidden="true"><?php echo $row['brand_id']?></td>
                  <td><?php echo $row['brand_name']?></td>
                  <td style="width: 100px;">
                    <a href="" data-toggle="modal" data-target="#editBrand" class="editBrand" id="">
                        <i class="fas fa-edit"></i>
                    </a>
                    &nbsp;|&nbsp;
                    <a href="" class="deleteConfirmBrand" id="" data-toggle="modal" data-target="#deleteConfirmBrand">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- BRAND -->


  </div>
  <!--Row-->
  
  <!-- Add category modal -->
  <div class="modal fade" id="addCat" tabindex="-1" role="dialog" aria-hidden="true">
    <div style="max-width: 25%"  class="modal-dialog " role="document">
      <div style="width:100" class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" onsubmit="return validateCatAdd();" >
            <div class="form-group">
              <input type="text" class="form-control" name="cat_name" id="cat_name" maxlength="50" placeholder="Category Name" 
              onchange="validateCatNameAdd(this.value)" value="<?php if(isset($catName)) echo $catName ?>">
              <p style="font-size: 12px; position: absolute; color: red;bottom: 54px;left: 20px" id="cat_status"></p>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-block" name="addCat" value="Add Category">
            </div>
          </form>
        </div>
        <div class="errBox" id="errBox" hidden>
          <p class="errMess" id="errMess"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Add category modal -->

  <!-- Add brand modal -->
  <div class="modal fade" id="addBrand" tabindex="-1" role="dialog" aria-hidden="true">
    <div   style="max-width: 25%"  class="modal-dialog " role="document">
      <div style="width:1000" class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Add Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="#" method="post" enctype="multipart/form-data" role="form"  onsubmit="return validateBrandAdd()">
            <div class="form-group">
              <input type="text" class="form-control" name="brand_name" id="brand_name" maxlength="50" placeholder="Brand Name"  onchange="validateBrandNameAdd(this.value)" >
              <p style="font-size: 12px; position: absolute; color: red;bottom: 54px;left: 20px" id="brand_status"></p>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-block" name="addBrand" value="Add Brand">
            </div>
          </form>
        </div>
        <div class="errBox" id="errBoxB" hidden>
          <p class="errMess" id="errMessB"></p>
        </div>
      </div>
    </div>
  </div>
  <!-- Add brand modal -->

  <!-- Edit category modal -->
  <div class="modal fade" id="editCat" tabindex="-1" role="dialog" aria-hidden="true">
    <div  style="max-width: 25%"  class="modal-dialog " role="document">
      <div style="width:1000" class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="#" method="post" enctype="multipart/form-data" role="form" onsubmit="return validateCatEdit();">
            <div class="form-group">
              <input hidden="true" type="text" class="form-control" name="cat_id_edit" id="cat_id_edit" maxlength="50" placeholder="Cat ID">
              <input type="text" class="form-control" name="cat_name_edit" id="cat_name_edit" maxlength="50" placeholder="Category Name"  onchange="validateCatNameEdit(this.value)" >
              <p style="font-size: 12px; position: absolute; color: red;bottom: 54px;left: 20px" id="cat_status_edit"></p>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-block" name="editCat" value="Confirm Edit">
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Edit category modal -->

  <!-- Edit brand modal -->
  <div class="modal fade" id="editBrand" tabindex="-1" role="dialog" aria-hidden="true">
    <div  style="max-width: 25%"  class="modal-dialog " role="document">
      <div style="width:1000" class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Edit Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="#" method="post" enctype="multipart/form-data" role="form"  onsubmit="return validateBrandEdit();">
            <div class="form-group">
              <input hidden="true" type="text" class="form-control" name="brand_id_edit" id="brand_id_edit" maxlength="50" placeholder="Brand ID">
              <input type="text" class="form-control" name="brand_name_edit" id="brand_name_edit" maxlength="50" placeholder="Brand Name"  onchange="validateBrandNameEdit(this.value)" >
              <p style="font-size: 12px; position: absolute; color: red;bottom: 54px;left: 20px" id="brand_status_edit"></p>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-block" name="editBrand" value="Confirm Edit">
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Edit brand modal -->

  <!-- Delete confirm -->
  <div class="modal fade" id="deleteConfirmCat" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding-top: 25px">
          <h4> Are you sure to delete category <b id="deleteMessCat" ></b></h4>
        </div>
        <div class="modal-footer">
        <form method="post">
          <input name="delete_id_cat" id="delete_id_cat" hidden>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="delete_cat">Confirm</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete confirm -->

  <!-- Delete confirm -->
  <div class="modal fade" id="deleteConfirmBrand" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding-top: 25px">
          <h4> Are you sure to delete brand <b id="deleteMessBrand" ></b></h4>
        </div>
        <div class="modal-footer">
        <form method="post">
          <input name="delete_id_brand" id="delete_id_brand" hidden>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="delete_brand">Confirm</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete confirm -->
  
</div>
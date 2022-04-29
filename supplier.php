<?php 
// Add Supplier
if(isset($_POST['addSupplier']))
{
  $supName = $_POST['sup_name'];
  $supAddr = $_POST['sup_addr'];
  $supPhone = $_POST['sup_phone'];
  $supEmail = $_POST['sup_email'];
  $supPurchased = $_POST['sup_purchased'];
  $supDebt = $_POST['sup_debt'];
  $supDes = $_POST['sup_des'];
  $result = mysqli_query($conn, "select * from supplier 
  where account_id='".$_SESSION['account_id']."' 
  and (phone = '$supPhone' or email = '$supEmail')");
  if(mysqli_num_rows($result)==0)
  {
    mysqli_query($conn,"INSERT INTO `supplier` (`supplier_name`, `addr`, `phone`, `email`, `purchased`, `debt`, `describe`, `account_id`)
    values('$supName','$supAddr','$supPhone','$supEmail','$supPurchased','$supDebt', '$supDes' ,'".$_SESSION['account_id']."')");
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Supplier Add: $supName','".$_SESSION['account_id']."')");

    unset($supName);
    unset($supAddr);
    unset($supPhone);
    unset($supEmail);
    unset($supPurchased);
    unset($supDebt);
    unset($supDes);
    $err = "successAddSup";
  } else {
    $err = "duplicatedSup";
  }
}

// Edit Supplier
if(isset($_POST['editSupplier']))
{
  $supId = $_POST['sup_id_edit'];
  $supName = $_POST['sup_name_edit'];
  $supAddr = $_POST['sup_addr_edit'];
  $supPhone = $_POST['sup_phone_edit'];
  $supEmail = $_POST['sup_email_edit'];
  $supPurchased = $_POST['sup_purchased_edit'];
  $supDebt = $_POST['sup_debt_edit'];
  $supDes = $_POST['sup_des_edit'];
  $result = mysqli_query($conn, "select * from supplier 
  where account_id='".$_SESSION['account_id']."' 
  and (phone = '$supPhone' or email = '$supEmail')
  and supplier_id <> '$supId'");
  if(mysqli_num_rows($result)==0)
  {
    mysqli_query($conn,"UPDATE `supplier` 
    SET `supplier_name` = '$supName', 
    `addr` = '$supAddr', `phone` = '$supPhone', `email` = '$supEmail', `purchased` = '$supPurchased', `debt` = '$supDebt', `describe` = '$supDes' 
    WHERE `supplier_id` = '$supId';");
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Supplier Add: $supName','".$_SESSION['account_id']."')");

    unset($supName);
    unset($supAddr);
    unset($supPhone);
    unset($supEmail);
    unset($supPurchased);
    unset($supDebt);
    unset($supDes);
    $err = "successEditSup";
  } else {
    $err = "duplicatedSupEdit";
  }
}

// Delete Supplier
if(isset($_POST['delete']))
{
  $supId = $_POST['delete_id_sup'];

  $result = mysqli_query($conn, "select supplier_name from supplier where supplier_id = '$supId'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Supplier Delete: ".$row['supplier_name']."','".$_SESSION['account_id']."')");

  $result = mysqli_query($conn, "DELETE FROM supplier WHERE supplier_id = '$supId' and account_id = '".$_SESSION['account_id']."' ");
  $err = "successDelSup";
}
?>


<div class="container-fluid" id="container-wrapper">
  <!-- Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between" style="padding-bottom: 0">
          <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
          <a style="font-size: 30px" href="" data-toggle="modal" data-target="#addSupplier" onclick="errMess()">
              <i class="fas fa-plus-square"></i>
          </a>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" style="table-layout: fixed;" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th hidden>ID</th>
                <th style="width: 185px;padding-left: 10px">Name</th>
                <th style="width: 80px;padding-left: 10px">Phone</th>
                <th style="width: 150px;padding-left: 10px">Email</th>
                <th style="width: 150px; padding-left: 10px">Purchased</th>
                <th style="width: 150px; padding-left: 10px">Debt</th>
                <th style="width: 40px;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($conn, "SELECT * FROM supplier WHERE account_id = '".$_SESSION['account_id']."'");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <tr>
                <td hidden><?php echo $row['supplier_id']?></td>
                <td hidden><?php echo $row['addr']?></td>
                <td hidden><?php echo $row['phone']?></td>
                <td hidden><?php echo $row['purchased']?></td>
                <td hidden><?php echo $row['debt']?></td>
                <td hidden><?php echo $row['describe']?></td>
                <td style="padding: 10px 10px"><?php echo $row['supplier_name'] ?></td>
                <td style="padding: 10px 10px"><?php echo $row['phone'] ?></td>
                <td style="padding: 10px 10px"><?php echo $row['email'] ?></td>
                <td style="padding: 10px 10px"><?php echo toMoney($row['purchased']) ?></td>
                <td style="padding: 10px 10px"><?php echo toMoney($row['debt']) ?></td>
                <td style="padding: 10px;">
                  <a href="" class="editSupplier" data-toggle="modal" data-target="#editSupplier">
                      <i class="fas fa-edit"></i>
                  </a> &nbsp; | &nbsp;
                  <a href="" class="deleteConfirmSup" id="" data-toggle="modal" data-target="#deleteConfirmSup">
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
  
  <!-- Add supplier screen -->
  <div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-hidden="true">
    <div style="max-width: 650px"  class="modal-dialog " role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Add Supplier</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formAddSupplier" onsubmit="return validateSupplierAdd()">

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Full Name:</b></div>
              <div class="col-md-10">
                <input type="text" maxlength="50" class="form-control" id="sup_name" name="sup_name" value="<?php if(isset($supName)) echo $supName ?>" onchange="validateSupName(this.value)" placeholder="Enter supplier name (John, D.P Tom, ...)">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_name_status"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Address:</b></div>
              <div class="col-md-10">
                <input type="text" maxlength="150" class="form-control" id="sup_addr" name="sup_addr" value="<?php if(isset($supAddr)) echo $supAddr ?>" onchange="" placeholder="Enter address ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_addr_status"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Phone:</b></div>
              <div class="col-md-10"  >
                <input type="text" maxlength="10" class="form-control" id="sup_phone" name="sup_phone" value="<?php if(isset($supPhone)) echo $supPhone ?>" onchange="validateSupPhone(this.value)" placeholder="Enter phone number ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_phone_status"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
              <div class="col-md-10"  >
                <input type="text" maxlength="40" class="form-control" id="sup_email" name="sup_email" value="<?php if(isset($supEmail)) echo $supEmail ?>" onchange="validateSupEmail(this.value)" placeholder="Enter email ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_email_status"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6" style="padding-left: 10">
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Purchased:</b></div>
                  <div class="col-md-8"  >
                    <input type="number" min="0" class="form-control" id="sup_purchased" name="sup_purchased" value="<?php echo isset($supPurchased)? $supPurchased : 0 ?>" onchange="validateSupPurchased(this.value)" placeholder="$">
                    <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_purchased_status"></p>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Debt:</b></div>
                  <div class="col-md-8"  >
                    <input type="number" min="0" maxlength="150" class="form-control" id="sup_debt" name="sup_debt" value="<?php echo isset($supDebt)? $supDebt : 0 ?>" onchange="validateSupDebt(this.value)" placeholder="$">
                    <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_debt_status"></p>
                  </div>
                </div>
              </div>

              <div class="col-md-6" style="padding-left: 0">
              <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Describe:</b></div>
                    <div class="col-md-8"  >
                      <textarea maxlength="150" class="form-control" style="height: 102px; resize:none" row="10" id="sup_des" value="<?php if(isset($supDes)) echo $supDes ?>" name="sup_des" placeholder="Description about this supplier..."></textarea>
                      <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_des_status"></p>
                    </div>
                  </div>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="addSupplier">Add</button>
            </div>
          </form>
        </div>

        <div class="errBox" id="errBox" hidden >
          <p class="errMess" id="errMess"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Add supplier screen -->

  <!-- Edit supplier screen -->
  <div class="modal fade" id="editSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div style="max-width: 650px"  class="modal-dialog " role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Edit Supplier</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formEditSupplier" onsubmit="return validateSupplierEdit()">

            <input id="sup_id_edit" name="sup_id_edit" hidden >

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Full Name:</b></div>
              <div class="col-md-10">
                <input type="text" maxlength="50" class="form-control" id="sup_name_edit" name="sup_name_edit" value="<?php if(isset($supName)) echo $supName ?>" onchange="validateSupNameEdit(this.value)" placeholder="Enter supplier name (John, D.P Tom, ...)">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_name_status_edit"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Address:</b></div>
              <div class="col-md-10">
                <input type="text" maxlength="150" class="form-control" id="sup_addr_edit" name="sup_addr_edit" value="<?php if(isset($supAddr)) echo $supAddr ?>" onchange="validateSupNameEdit(this.value)" placeholder="Enter address ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_addr_status_edit"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Phone:</b></div>
              <div class="col-md-10"  >
                <input type="text" maxlength="10" class="form-control" id="sup_phone_edit" name="sup_phone_edit" value="<?php if(isset($supPhone)) echo $supPhone ?>" onchange="validateSupPhoneEdit(this.value)" placeholder="Enter phone number ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_phone_status_edit"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
              <div class="col-md-10"  >
                <input type="email" maxlength="40" class="form-control" id="sup_email_edit" name="sup_email_edit" value="<?php if(isset($supEmail)) echo $supEmail ?>" onchange="validateSupEmailEdit(this.value)" placeholder="Enter email ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_email_status_edit"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6" style="padding-left: 10">
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Purchased:</b></div>
                  <div class="col-md-8"  >
                    <input type="number" min="0" maxlength="150" class="form-control" id="sup_purchased_edit" name="sup_purchased_edit" value="<?php if(isset($supPurchased)) echo $supPurchased ?>" onchange="validateSupPurchasedEdit(this.value)" placeholder="$">
                    <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_purchased_status_edit"></p>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Debt:</b></div>
                  <div class="col-md-8"  >
                    <input type="number" min="0" maxlength="150" class="form-control" id="sup_debt_edit" name="sup_debt_edit" value="<?php if(isset($supDebt)) echo $supDebt ?>" onchange="validateSupDebtEdit(this.value)" placeholder="$">
                    <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_debt_status_edit"></p>
                  </div>
                </div>
              </div>

              <div class="col-md-6" style="padding-left: 0">
              <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Describe:</b></div>
                    <div class="col-md-8"  >
                      <textarea class="form-control" style="height: 102px; resize:none" row="10" id="sup_des_edit" name="sup_des_edit" value="<?php if(isset($supDes)) echo $supDes ?>" placeholder="Description about this supplier..."></textarea>
                      <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="sup_des_status_edit"></p>
                    </div>
                  </div>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="editSupplier">Submit Edit</button>
            </div>
          </form>
        </div>

        <div class="errBox" id="errBoxEdit" hidden >
          <p class="errMess" id="errMessEdit"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Edit supplier screen -->


  <!-- Delete Confirm -->
  <div class="modal fade" id="deleteConfirmSup" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding-top: 25px">
          <h4> Are you sure to delete supplier <b id="deleteMessSup" ></b></h4>
        </div>
        <div class="modal-footer">
        <form method="post">
          <input name="delete_id_sup" class="delete_id_sup" id="delete_id_sup" hidden>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="delete">Confirm</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Confirm -->
  
</div>
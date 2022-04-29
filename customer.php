<?php 
// Add Customer
if(isset($_POST['addCustomer']))
{
  $cusName = $_POST['cus_name'];
  $cusAddr = $_POST['cus_addr'];
  $cusPhone = $_POST['cus_phone'];
  $cusEmail = $_POST['cus_email'];
  $cusPurchased = $_POST['cus_purchased'];
  $cusDebt = $_POST['cus_debt'];
  $cusDes = $_POST['cus_des'];
  $result = mysqli_query($conn, "select * from customer 
  where account_id='".$_SESSION['account_id']."' 
  and (phone = '$cusPhone' or email = '$cusEmail')");
  if(mysqli_num_rows($result)==0)
  {
    mysqli_query($conn,"INSERT INTO `customer` (`customer_name`, `addr`, `phone`, `email`, `purchased`, `debt`, `describe`, `account_id`)
    values('$cusName','$cusAddr','$cusPhone','$cusEmail','$cusPurchased','$cusDebt', '$cusDes' ,'".$_SESSION['account_id']."')");
    mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Customer Add: $cusName','".$_SESSION['account_id']."')");

    unset($cusName);
    unset($cusAddr);
    unset($cusPhone);
    unset($cusEmail);
    unset($cusPurchased);
    unset($cusDebt);
    unset($cusDes);
    $err = "successAddCus";
  } else {
    $err = "duplicatedCus";
  }
}

// Edit Customer
if(isset($_POST['editCustomer']))
{
  $cusId = $_POST['cus_id_edit'];
  $cusName = $_POST['cus_name_edit'];
  $cusAddr = $_POST['cus_addr_edit'];
  $cusPhone = $_POST['cus_phone_edit'];
  $cusEmail = $_POST['cus_email_edit'];
  $cusPurchased = $_POST['cus_purchased_edit'];
  $cusDebt = $_POST['cus_debt_edit'];
  $cusDes = $_POST['cus_des_edit'];
  $result = mysqli_query($conn, "select * from customer 
  where account_id='".$_SESSION['account_id']."' 
  and (phone = '$cusPhone' or email = '$cusEmail')
  and customer_id <> '$cusId'");
  if(mysqli_num_rows($result)==0)
  {
    mysqli_query($conn,"UPDATE `customer` 
    SET `customer_name` = '$cusName', 
    `addr` = '$cusAddr', `phone` = '$cusPhone', `email` = '$cusEmail', `purchased` = '$cusPurchased', `debt` = '$cusDebt', `describe` = '$cusDes' 
    WHERE `customer_id` = '$cusId';");
      mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Customer Edit: $cusName','".$_SESSION['account_id']."')");

    unset($cusName);
    unset($cusAddr);
    unset($cusPhone);
    unset($cusEmail);
    unset($cusPurchased);
    unset($cusDebt);
    unset($cusDes);
    $err = "successEditCus";
  } else {
    $err = "duplicatedCusEdit";
  }
}

// Delete Customer
if(isset($_POST['delete']))
{
  $cusId = $_POST['delete_id_cus'];

  $result = mysqli_query($conn, "select customer_name from customer where customer_id = '$cusId'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Customer Delete: ".$row['customer_name']."','".$_SESSION['account_id']."')");

  $result = mysqli_query($conn, "DELETE FROM customer WHERE customer_id = '$cusId' and account_id = '".$_SESSION['account_id']."' ");
  $err = "successDelCus";
}
?>


<div class="container-fluid" id="container-wrapper">
  <!-- Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between" style="padding-bottom: 0">
          <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
          <a style="font-size: 30px" href="" data-toggle="modal" data-target="#addCustomer" onclick="errMess()">
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
                <th style="width: 170px;padding-left: 10px" hidden>Email</th>
                <th style="width: 150px; padding-left: 10px">Purchased</th>
                <th style="width: 150px; padding-left: 10px">Debt</th>
                <!-- <th style="width: 90px; padding-left: 10px">Membership</th> -->
                <th style="width: 40px;">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($conn, "SELECT * FROM customer WHERE account_id = '".$_SESSION['account_id']."' and customer_name <> 'Passerby'");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <tr>
                <td hidden><?php echo $row['customer_id']?></td>
                <td hidden><?php echo $row['addr']?></td>
                <td hidden><?php echo $row['phone']?></td>
                <td hidden><?php echo $row['purchased']?></td>
                <td hidden><?php echo $row['debt']?></td>
                <td hidden><?php echo $row['describe']?></td>
                <td style="padding: 10px 10px"><?php echo $row['customer_name'] ?></td>
                <td style="padding: 10px 10px"><?php echo $row['phone'] ?></td>
                <td style="padding: 10px 10px" hidden><?php echo $row['email'] ?></td>
                <td style="padding: 10px 10px"><?php echo toMoney($row['purchased']) ?></td>
                <td style="padding: 10px 10px"><?php echo toMoney($row['debt']) ?></td>
                <!-- <td style="padding: 10px 10px"><?php //echo $row['purchased'] > 5000000 ? "True": "False"?></td> -->
                <td style="padding: 10px;">
                  <a href="" class="editCustomer" data-toggle="modal" data-target="#editCustomer">
                      <i class="fas fa-edit"></i>
                  </a> &nbsp; | &nbsp;
                  <a href="" class="deleteConfirmCus" id="" data-toggle="modal" data-target="#deleteConfirmCus">
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

  <div class="row">
    <div class="col-lg-4">
      <div class="card mb-4">
        <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" style="table-layout: fixed;" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th style="width: 120px">Name</th>
                <th style="width: 200px">Purchased</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($conn, "SELECT * FROM customer WHERE account_id = '".$_SESSION['account_id']."' and customer_name='Passerby'");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <tr>
                <td><?php echo $row['customer_name'] ?></td>
                <td><?php echo toMoney($row['purchased']) ?></td>
              </tr>
              <?php } ?>

            </tbody>
          </table>

          
        </div>
      </div>
    </div>
  </div>
  
  <!--Row-->
  
  <!-- Add customer screen -->
  <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div style="max-width: 660px"  class="modal-dialog " role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Add Customer</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formAddCustomer" onsubmit="return validateCustomerAdd()">

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 0 5px 15px"><b style="color: #383838;font-size: 18px;">Full Name:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
              <div class="col-md-10">
                <input type="text" maxlength="50" class="form-control" id="cus_name" name="cus_name" value="<?php if(isset($cusName)) echo $cusName ?>" onchange="validateCusName(this.value)" placeholder="Enter customer name (John, D.P Tom, ...)">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_name_status"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Address:</b></div>
              <div class="col-md-10">
                <input type="text" maxlength="150" class="form-control" id="cus_addr" name="cus_addr" value="<?php if(isset($cusAddr)) echo $cusAddr ?>" onchange="" placeholder="Enter address ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_addr_status"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Phone:</b><b style="color:red;font-size: 16px; font-weight: 1">*</b></div>
              <div class="col-md-10"  >
                <input type="text" maxlength="10" class="form-control" id="cus_phone" name="cus_phone" value="<?php if(isset($cusPhone)) echo $cusPhone ?>" onchange="validateCusPhone(this.value)" placeholder="Enter phone number ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_phone_status"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
              <div class="col-md-10"  >
                <input type="text" maxlength="40" class="form-control" id="cus_email" name="cus_email" value="<?php if(isset($cusEmail)) echo $cusEmail ?>" onchange="validateCusEmail(this.value)" placeholder="Enter email ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_email_status"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6" style="padding-left: 10">
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Purchased:</b></div>
                  <div class="col-md-8"  >
                    <input type="number" min="0" class="form-control" id="cus_purchased" name="cus_purchased" value="<?php echo isset($cusPurchased)? $cusPurchased : 0 ?>" onchange="validateCusPurchased(this.value)" placeholder="$">
                    <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_purchased_status"></p>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Debt:</b></div>
                  <div class="col-md-8"  >
                    <input type="number" min="0" maxlength="150" class="form-control" id="cus_debt" name="cus_debt" value="<?php echo isset($cusDebt)? $cusDebt : 0 ?>" onchange="validateCusDebt(this.value)" placeholder="$">
                    <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_debt_status"></p>
                  </div>
                </div>
              </div>

              <div class="col-md-6" style="padding-left: 0">
              <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Describe:</b></div>
                    <div class="col-md-8"  >
                      <textarea maxlength="150" class="form-control" style="height: 102px; resize:none" row="10" id="cus_des" value="<?php if(isset($cusDes)) echo $cusDes ?>" name="cus_des" placeholder="Description about this customer..."></textarea>
                      <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_des_status"></p>
                    </div>
                  </div>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="addCustomer">Add</button>
            </div>
          </form>
        </div>

        <div class="errBox" id="errBox" hidden >
          <p class="errMess" id="errMess"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Add customer screen -->

  <!-- Edit customer screen -->
  <div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div style="max-width: 650px"  class="modal-dialog " role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <b class="modal-title" style="color: #383838;font-size: 24px; ">Edit Customer</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data" role="form" id="formEditCustomer" onsubmit="return validateCustomerEdit()">

            <input id="cus_id_edit" name="cus_id_edit" hidden >

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Full Name:</b></div>
              <div class="col-md-10">
                <input type="text" maxlength="50" class="form-control" id="cus_name_edit" name="cus_name_edit" value="<?php if(isset($cusName)) echo $cusName ?>" onchange="" placeholder="Enter customer name (John, D.P Tom, ...)">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_name_status_edit"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Address:</b></div>
              <div class="col-md-10">
                <input type="text" maxlength="150" class="form-control" id="cus_addr_edit" name="cus_addr_edit" value="<?php if(isset($cusAddr)) echo $cusAddr ?>" onchange="validateCusNameEdit(this.value)" placeholder="Enter address ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_addr_status_edit"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Phone:</b></div>
              <div class="col-md-10"  >
                <input type="text" maxlength="10" class="form-control" id="cus_phone_edit" name="cus_phone_edit" value="<?php if(isset($cusPhone)) echo $cusPhone ?>" onchange="validateCusPhoneEdit(this.value)" placeholder="Enter phone number ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_phone_status_edit"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-2" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
              <div class="col-md-10"  >
                <input type="email" maxlength="40" class="form-control" id="cus_email_edit" name="cus_email_edit" value="<?php if(isset($cusEmail)) echo $cusEmail ?>" onchange="validateCusEmailEdit(this.value)" placeholder="Enter email ...">
                <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_email_status_edit"></p>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6" style="padding-left: 10">
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Purchased:</b></div>
                  <div class="col-md-8"  >
                    <input type="number" min="0" maxlength="150" class="form-control" id="cus_purchased_edit" name="cus_purchased_edit" value="<?php if(isset($cusPurchased)) echo $cusPurchased ?>" onchange="validateCusPurchasedEdit(this.value)" placeholder="$">
                    <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_purchased_status_edit"></p>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Debt:</b></div>
                  <div class="col-md-8">
                    <input type="number" min="0" maxlength="150" class="form-control" id="cus_debt_edit" name="cus_debt_edit" value="<?php if(isset($cusDebt)) echo $cusDebt ?>" onchange="validateCusDebtEdit(this.value)" placeholder="$">
                    <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_debt_status_edit"></p>
                  </div>
                </div>
              </div>

              <div class="col-md-6" style="padding-left: 0">
              <div class="form-group row">
                  <div class="col-md-4" style="text-align: left ; padding: 10px 5px 5px 15px"><b style="color: #383838;font-size: 18px;">Describe:</b></div>
                    <div class="col-md-8"  >
                      <textarea class="form-control" style="height: 102px; resize:none" row="10" id="cus_des_edit" name="cus_des_edit" value="<?php if(isset($cusDes)) echo $cusDes ?>" placeholder="Description about this customer..."></textarea>
                      <p style="font-size: 12px; position: absolute; color: red;bottom: -33px; left: 15px; left: 15px" id="cus_des_status"></p>
                    </div>
                  </div>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="editCustomer">Submit Edit</button>
            </div>
          </form>
        </div>

        <div class="errBox" id="errBoxEdit" hidden >
          <p class="errMess" id="errMessEdit"></p>
        </div>

      </div>
    </div>
  </div>
  <!-- Edit customer screen -->


  <!-- Delete Confirm -->
  <div class="modal fade" id="deleteConfirmCus" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding-top: 25px">
          <h4> Are you sure to delete customer <b id="deleteMessCus" ></b></h4>
        </div>
        <div class="modal-footer">
        <form method="post">
          <input name="delete_id_cus" class="delete_id_cus" id="delete_id_cus" hidden>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="delete">Confirm</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Confirm -->
  
</div>
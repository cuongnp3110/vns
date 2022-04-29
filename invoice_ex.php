<div class="container-fluid" id="container-wrapper">
<?php
if(isset($_POST['delete_invoice_ex'])){
  $result = mysqli_query($conn, "select customer_id, total, payment from invoice_ex where invoice_ex_id = '".$_POST['delete_id_invoice']."'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $debt = $row['total'] - $row['payment'];
  mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Invoice Export Delete (Total Price): $".$row['total']."','".$_SESSION['account_id']."')");

  mysqli_query($conn, "
  UPDATE customer SET purchased = purchased - '".$row['total']."', debt = debt - '".$debt."'
  WHERE customer_id = '".$row['customer_id']."' and account_id = '".$_SESSION['account_id']."'");

  $result = mysqli_query($conn, "select * from invoice_ex_item where invoice_ex_id = '".$_POST['delete_id_invoice']."'");
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      mysqli_query($conn, "
      UPDATE product SET amount = amount + '".$row['quantity']."'
      WHERE product_code = '".$row['product_code']."'
      ");
  }
  mysqli_query($conn, "DELETE FROM invoice_ex_item WHERE invoice_ex_id = '".$_POST['delete_id_invoice']."' ");
  mysqli_query($conn, "DELETE FROM invoice_ex WHERE invoice_ex_id = '".$_POST['delete_id_invoice']."' ");
}
?>


<!-- Row -->
  <div class="row">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold " style="color: #66bb6a">Sell Out Invoices</h6>
          <a style="font-size: 30px" href="?page=create_invoice_ex">
              <i class="fas fa-plus-square" style="color: #66bb6a"></i>
          </a>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th hidden>ID</th>
                <th>Customer Name</th>
                <th>Total Price</th>
                <th>Note</th>
                <th>Time</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($conn, "select account.account_id, invoice_ex.invoice_ex_id, invoice_ex.total, invoice_ex.note, invoice_ex.time, invoice_ex.customer_id, invoice_ex.payment, invoice_ex.note, invoice_ex.time, customer.customer_id, customer.customer_name
                from invoice_ex, customer, account
                where invoice_ex.customer_id = customer.customer_id and invoice_ex.account_id = '".$_SESSION['account_id']."'
                group by invoice_ex_id order by time DESC");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <tr>
                <td hidden><?php echo $row['invoice_ex_id'] ?></td>
                <td><?php echo $row['customer_name'] ?></td>
                <td><?php echo toMoney($row['total']) ?></td>
                <td><?php echo $row['note']?></td>
                <td><?php echo $row['time']?></td>
                <td style="width: 100px;">
                <a href="?page=pdf_invoice_ex&&id=<?php echo $row['invoice_ex_id'] ?>">
                      <i class="fas fa-print"></i>
                  </a>
                  &nbsp;|&nbsp;
                  <a href="?page=edit_invoice_ex&&id=<?php echo $row['invoice_ex_id'] ?>">
                      <i class="fas fa-edit"></i>
                  </a>
                  &nbsp;|&nbsp;
                  <a href="" class="deleteConfirmInvoice" id="" data-toggle="modal" data-target="#deleteConfirmInvoice">
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

  <!-- Delete confirm -->
  <div class="modal fade" id="deleteConfirmInvoice" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body" style="padding-top: 25px">
          <h4> Are you sure to delete this bill <br>
              From Customer: <b class="text-primary" id="sup"></b><br>
                With Price: <b class="text-primary" id="price"></b><br>
                  At Date: <b class="text-primary" id="date"></b><br> ?
          </h4>
        </div>
        <div class="modal-footer">
        <form method="post">
          <input name="delete_id_invoice" id="delete_id_invoice" hidden>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="delete_invoice_ex">Confirm</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete confirm -->
  
</div>
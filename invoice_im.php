<div class="container-fluid" id="container-wrapper">
<?php
if(isset($_POST['delete_invoice_im'])){
  $result = mysqli_query($conn, "select supplier_id, total, payment from invoice_im where invoice_im_id = '".$_POST['delete_id_invoice']."'");
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $debt = $row['total'] - $row['payment'];
  mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Invoice Import Delete (Total Price): $".$row['total']."','".$_SESSION['account_id']."')");

  mysqli_query($conn, "
  UPDATE supplier SET purchased = purchased - '".$row['total']."', debt = debt - '".$debt."'
  WHERE supplier_id = '".$row['supplier_id']."' and account_id = '".$_SESSION['account_id']."'");

  $result = mysqli_query($conn, "select * from invoice_im_item where invoice_im_id = '".$_POST['delete_id_invoice']."'");
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      mysqli_query($conn, "
      UPDATE product SET amount = amount - '".$row['quantity']."'
      WHERE product_code = '".$row['product_code']."'
      ");
  }
  mysqli_query($conn, "DELETE FROM invoice_im_item WHERE invoice_im_id = '".$_POST['delete_id_invoice']."' ");
  mysqli_query($conn, "DELETE FROM invoice_im WHERE invoice_im_id = '".$_POST['delete_id_invoice']."' ");
}
?>
<!-- Row -->
  <div class="row">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold " style="color: #fc544b">Buy In Invoices</h6>
          <a style="font-size: 30px" href="?page=create_invoice_im">
              <i class="fas fa-plus-square" style="color: #fc544b"></i>
          </a>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th hidden>ID</th>
                <th>Supplier Name</th>
                <th>Total Price</th>
                <th>Note</th>
                <th>Time</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($conn, "select account.account_id, invoice_im.invoice_im_id, invoice_im.total, invoice_im.note, invoice_im.time, invoice_im.supplier_id, invoice_im.payment, invoice_im.note, invoice_im.time, supplier.supplier_id, supplier.supplier_name
                from invoice_im, supplier, account
                where invoice_im.supplier_id = supplier.supplier_id and  invoice_im.account_id = '".$_SESSION['account_id']."'
                group by invoice_im_id");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <tr>
                <td hidden><?php echo $row['invoice_im_id'] ?></td>
                <td><?php echo $row['supplier_name'] ?></td>
                <td><?php echo toMoney($row['total']) ?></td>
                <td><?php echo $row['note']?></td>
                <td><?php echo $row['time']?></td>
                <td style="width: 100px;">
                  <a href="?page=pdf_invoice_im&&id=<?php echo $row['invoice_im_id'] ?>">
                      <i class="fas fa-print"></i>
                  </a>
                  &nbsp;|&nbsp;
                  <a href="?page=edit_invoice_im&&id=<?php echo $row['invoice_im_id'] ?>">
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
              From Supplier: <b class="text-primary" id="sup"></b><br>
                With Price: <b class="text-primary" id="price"></b><br>
                  At Date: <b class="text-primary" id="date"></b><br> ?
          </h4>
        </div>
        <div class="modal-footer">
        <form method="post">
          <input name="delete_id_invoice" id="delete_id_invoice" hidden>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="delete_invoice_im">Confirm</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete confirm -->
  
</div>
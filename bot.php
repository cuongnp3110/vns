<?php
  if($_SESSION['role'] == 1){
?>

<div class="container-fluid" id="container-wrapper">
  <!-- Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between" style="padding-bottom: 0">
          <h6 class="m-0 font-weight-bold text-primary">Unsolved Data List</h6>
        </div>
        <div class="table-responsive p-3">
          <table class="table align-items-center table-flush table-hover" style="table-layout: fixed;" id="dataTableHover">
            <thead class="thead-light">
              <tr>
                <th>Unsolved Data</th>
                <th>Date</th>
                <th>User</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($conn, "SELECT bot_data.raw_data, bot_data.time, account.account_id, account.email FROM bot_data, account WHERE account.account_id = bot_data.account_id");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <tr>
                <td><?php echo $row['raw_data'] ?></td>
                <td><?php echo $row['time'] ?></td>
                <td><a href=""><?php echo $row['email'] ?></a></td>
              </tr>
              <?php } ?>

            </tbody>
          </table>

          
        </div>
      </div>
    </div>
  </div>
  
  <!--Row-->
  
</div>

<?php
  } else {
    echo '<meta http-equiv="refresh" content="0;URL = index.php"';
  }
?>

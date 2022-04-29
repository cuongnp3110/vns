<div class="container-fluid" id="container-wrapper">

    <div class="col-xl-12 col-md-12 mb-12">
      <div class="card h-100">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Logs History</h6>
      </div>
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-1" style="height: 440px; overflow-y: scroll">
              <?php
                $monthlyIncome = 0;
                $result = mysqli_query($conn, "select log, log_time from log where account_id ='".$_SESSION['account_id']."' order by log_time desc");
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              ?>
              <div class="h5 mb-0 text-gray-800" style="padding: 5px 0"><?php echo $row['log_time'].' | '.$row['log'] ?></div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div><br>
    </div>
  

</div>
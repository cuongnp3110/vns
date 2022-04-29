<div class="container-fluid" id="container-wrapper">

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-10">
                      <?php
                        $result = mysqli_query($conn, "select sum(payment) as payment from invoice_ex where account_id ='".$_SESSION['account_id']."' and time > now() - INTERVAL 30 day");
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC)
                      ?>
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Income (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo toMoney($row['payment']) ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>Since last month</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <!-- New User Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <?php
                        $result = mysqli_query($conn, "select sum(debt) as total from customer where account_id ='".$_SESSION['account_id']."'");
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC)
                      ?>
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Customer's Debt</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo toMoney($row['total']) ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-credit-card fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Product Quantity Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <?php
                        $result = mysqli_query($conn, "select sum(amount) as total FROM product where account_id ='".$_SESSION['account_id']."'");
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC)
                      ?>
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Number of Products</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo isset($row['total'])? $row['total'] : 0?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-box-open fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <?php
                        $productSold = 0;
                        $result = mysqli_query($conn, "select quantity from invoice_ex_item where account_id ='".$_SESSION['account_id']."' and time > now() - INTERVAL 30 day");
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                          $productSold += $row['quantity'];
                        }
                      ?>
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Products Sold</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $productSold ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last month</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
            

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                  <div class="chart-pie">
                    <canvas id="myBarChart"></canvas>
                  </div>
                  <hr>
                  Top 5 Best Seller Category
                </div>
              </div>
            </div>
            <!-- Donut Chart -->
            <div class="col-xl-3 col-lg-3">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pie Chart</h6>
                </div>
                <div class="card-body">
                  <div class="chart-pie">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <hr>
                  Sales Volume / Product
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Best Seller<br></h6>
                </div>
                <?php
                  $result = mysqli_query($conn, "SELECT count(product_name) as count from invoice_ex_item
                  where account_id = '".$_SESSION['account_id']."'");
                  $rowC = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  $sqlArr[0] = 0; $sqlArr[1] = 0; $sqlArr[2] = 0; $sqlArr[3] = 0; $sqlArr[4] = 0;
                  if($rowC['count'] != 0){
                    $result = mysqli_query($conn, "SELECT product_name, 
                    SUM(quantity) as total 
                    FROM invoice_ex_item 
                    where account_id = '".$_SESSION['account_id']."'
                    GROUP BY product_name 
                    order by total desc limit 5");
                    $i = 0;
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      $sqlArr[$i] = $row;
                      $i++;
                    }
                    $result = mysqli_query($conn, "SELECT SUM(quantity) as sumQuantity from invoice_ex_item where account_id = '".$_SESSION['account_id']."'");
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  }
                ?>
                <div class="card-body chart-bar">
                  <div class="mb-3">
                    <div class="small text-gray-500"><?php echo $rowC['count'] == 0 ? 0 : $sqlArr[0]['product_name']?>
                      <div class="small float-right"><b><?php echo $rowC['count'] == 0 ? 0 : $sqlArr[0]['total'].' of '.$row['sumQuantity'].' items'?></b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo  $sqlArr[0]['total'] == 0 ? $sqlArr[0]['total'] : $sqlArr[0]['total']/$row['sumQuantity']*100?>%"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500"><?php echo $rowC['count'] == 0 ? 0 :  $sqlArr[1]['product_name'] ?>
                      <div class="small float-right"><b><?php echo $rowC['count'] == 0 ? 0 :  $sqlArr[1]['total'].' of '.$row['sumQuantity'].' items'?></b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $sqlArr[1]['total'] == 0 ? $sqlArr[0]['total'] : $sqlArr[1]['total']/$row['sumQuantity']*100?>%"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500"><?php echo $rowC['count'] == 0 ? 0 :  $sqlArr[2]['product_name'] ?>
                      <div class="small float-right"><b><?php echo $rowC['count'] == 0 ? 0 :  $sqlArr[2]['total'].' of '.$row['sumQuantity'].' items'?></b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $sqlArr[2]['total'] == 0 ? $sqlArr[0]['total'] : $sqlArr[2]['total']/$row['sumQuantity']*100?>%"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500"><?php echo $rowC['count'] == 0 ? 0 :  $sqlArr[3]['product_name'] ?>
                      <div class="small float-right"><b><?php echo $rowC['count'] == 0 ? 0 :  $sqlArr[3]['total'].' of '.$row['sumQuantity'].' items'?></b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $sqlArr[3]['total'] == 0 ? $sqlArr[0]['total'] : $sqlArr[3]['total']/$row['sumQuantity']*100?>%"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500"><?php echo $rowC['count'] == 0 ? 0 :  $sqlArr[4]['product_name'] ?>
                      <div class="small float-right"><b><?php echo $rowC['count'] == 0 ? 0 :  $sqlArr[4]['total'].' of '.$row['sumQuantity'].' items'?></b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $sqlArr[4]['total'] == 0 ? $sqlArr[0]['total'] : $sqlArr[4]['total']/$row['sumQuantity']*100?>%"></div>
                    </div>
                  </div>

                  <hr>
                  Top 5 Best Seller
                </div>
                
              </div>
            </div>
            <!-- Area Charts -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Year&nbsp;&nbsp;<i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Select Year</div>
                      <?php
                        $thisYear = date("Y");
                        for($i = 0; $i < 5; $i++){
                          $yearList[$i] = $thisYear - $i;
                        }
                      ?>
                      <a class="dropdown-item" style="cursor: pointer; color: black" id="year1"><?php echo $yearList[0] ?></a>
                      <a class="dropdown-item" style="cursor: pointer; color: black" id="year2"><?php echo $yearList[1] ?></a>
                      <a class="dropdown-item" style="cursor: pointer; color: black" id="year3"><?php echo $yearList[2] ?></a>
                      <a class="dropdown-item" style="cursor: pointer; color: black" id="year4"><?php echo $yearList[3] ?></a>
                      <a class="dropdown-item" style="cursor: pointer; color: black" id="year5"><?php echo $yearList[4] ?></a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-area" id="canvas-container">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                  <hr>
                  Business Process
                </div>
              </div>
            </div>
          </div>
</div>
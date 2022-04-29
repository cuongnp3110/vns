<div class="container-fluid" id="container-wrapper" style="display: flex; justify-content: center;">
    <div class="col-lg-7">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
            </div>
            <div class="card-body" style="padding-top: 0">
                <form>
                    <div class="row" >
                        <?php
                            $result = mysqli_query($conn,"select * from account where account_id = '".$_SESSION['account_id']."'");
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $today = date("m/d/Y");
                            $expireDate = date('d/m/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'));
                            $remain = round(abs(strtotime(date('m/d/Y', strtotime($row['open_day']. ' + '.$row['duration'].' days'))) - strtotime($today)) / (60*60*24),0); 
                        ?>
                        <div class="col-md-5" style="padding: 0 20px 0 0">
                            <div  style="padding: 0 0 0 10%">
                                <img src="<?php echo $row['avt']!=""? "data/user_avt/".$row['avt'] : "img/boy.png" ?>" alt="Avatar" style="border-radius: 50%; border: 2px; border-style: solid; object-fit: cover; width: 210px; height: 210px">
                            </div>
                        </div>
                        <!-- <div class="col-md-1"></div> -->
                        <div class="row col-md-7">
                            <div class="col-md-4" style="padding: 10px 5px 10px 10px"><b style="color: #383838;font-size: 18px;">Name:</b></div>
                            <div class="col-md-8" style="text-align: left ; padding: 13px 5px 10px 5px"><h6 class="m-0 font-weight-bold text-primary"><?php echo $row['fname'] ?></h6></div>

                            <div class="col-md-4" style="padding: 10px 5px 10px 10px"><b style="color: #383838;font-size: 18px;">Email:</b></div>
                            <div class="col-md-8" style="text-align: left ; padding: 13px 5px 10px 5px"><h6 class="m-0 font-weight-bold text-primary"><?php echo $row['email'] ?></h6></div>

                            <div class="col-md-4" style="padding: 10px 5px 10px 10px"><b style="color: #383838;font-size: 18px;">Phone:</b></div>
                            <div class="col-md-8" style="text-align: left ; padding: 13px 5px 10px 5px"><h6 class="m-0 font-weight-bold text-primary"><?php echo $row['phone'] ?></h6></div>

                            <div class="col-md-4" style="padding: 10px 5px 10px 10px"><b style="color: #383838;font-size: 18px;">Address:</b></div>
                            <div class="col-md-8" style="text-align: left ; padding: 13px 5px 10px 5px"><h6 class="m-0 font-weight-bold text-primary"><?php echo $row['addr'] ?></h6></div>

                            <?php
                                if($_SESSION['role'] != 1) 
                                {
                            ?>
                            <div class="col-md-4" style="padding: 10px 5px 10px 10px"><b style="color: #383838;font-size: 18px;">Remain Time:</b></div>
                            <div class="col-md-7" style="text-align: left ; padding: 13px 5px 10px 5px"><h6 class="m-0 font-weight-bold text-primary"><?php echo $remain ?> day(s)</h6></div>

                            <div class="col-md-4" style="padding: 10px 5px 10px 10px"><b style="color: #383838;font-size: 18px;">Expire Day:</b></div>
                            <div class="col-md-7" style="text-align: left ; padding: 13px 5px 10px 5px"><h6 class="m-0 font-weight-bold text-primary"><?php echo $expireDate ?></h2></div>

                            <?php } ?>
                        </div>
                    </div>
                    <div style="padding-top: 15px">
                        <a href="?page=edit_profile" class="btn btn-primary"> Edit Profiles</a> <a href="?page=change_pass" class="btn btn-primary"> Change Password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
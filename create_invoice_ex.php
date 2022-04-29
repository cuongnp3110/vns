<?php
if(isset($_POST['invoiceCreate'])){

    $validate = true;
    for ($i = 0; $i < count($_POST['productCode']); $i++) {
        if($_POST['productCode'][$i] == "" || $_POST['quantity'][$i] == ""){
            $validate = false;
        }
    }
    if($_POST['discount'] < 0 || $_POST['discount'] > 100 || $_POST['paid'] < 0 || $_POST['paid'] > $_POST['total'] || $_POST['discount'] == "" ||  $_POST['paid'] == ""){
        $validate = false;
    }

    if($validate == true){
        mysqli_query($conn, "
        INSERT INTO invoice_ex(customer_id, discount, subtotal, total, payment, note, account_id) 
        VALUES ('".$_POST['cus']."', '".$_POST['discount']."', '".$_POST['subtotal']."', '".$_POST['total']."', '".$_POST['paid']."', '".$_POST['note']."', '".$_SESSION['account_id']."')");
    
        $lastInsertId = mysqli_insert_id($conn);
        for ($i = 0; $i < count($_POST['productCode']); $i++) {
    
            mysqli_query($conn, "
            INSERT INTO invoice_ex_item(invoice_ex_id, product_code, product_name, quantity, price, total, account_id) 
            VALUES ('$lastInsertId', '".$_POST['productCode'][$i]."', '".$_POST['productName'][$i]."', 
            '".$_POST['quantity'][$i]."', '".$_POST['price'][$i]."', '".$_POST['totalRow'][$i]."', '".$_SESSION['account_id']."')");
    
            mysqli_query($conn, "
            UPDATE product SET amount = amount - '".$_POST['quantity'][$i]."' 
            WHERE product_code = '".$_POST['productCode'][$i]."' and account_id = '".$_SESSION['account_id']."'");
        }
        mysqli_query($conn, "insert into log(log, account_id) values('By ".$_SESSION['email']." | Invoice Export Add (Total Price): $".$_POST['total']."','".$_SESSION['account_id']."')");

        mysqli_query($conn, "
        UPDATE customer SET purchased = purchased + '".$_POST['total']."', debt = debt + '".$_POST['debt']."' 
        WHERE customer_id = '".$_POST['cus']."' and account_id = '".$_SESSION['account_id']."'");
    
        echo '<meta http-equiv="refresh"content="0;URL=?page=invoice_ex"';
    } else {
        $err = "invoiceEmpty";
    }
    
}

?>

<div class="container-fluid" id="container-wrapper" style="display: flex; justify-content: center;">
    <div class="col-lg-12">
        <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold" style="color: #66bb6a"><i class="fas fa-fw fa-file-invoice"></i> Create Invoice for Export Products</h6>
        </div>
            <div class="card-body" style="padding-top: 0; padding-bottom: 0">
                <!-- <form> -->
                <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="" onsubmit="return invoiceValidate()"> 
                    <div class="load-animate animated fadeInUp">
                        <div class="row">
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            </div>		    		
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table class="table table-bordered table-hovers" id="invoiceItem" style="table-layout:; border:1px solid" >	
                                    <tr>
                                        <th style="padding: 10px" width="30px"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                        <th style="padding: 10px" width="150px">Code</th>
                                        <th style="padding: 10px" width="150px">Product Image</th>
                                        <th style="padding: 10px" width="300px">Product Name</th>
                                        <th style="padding: 10px" width="90px">Quantity</th>
                                        <th style="padding: 10px" width="130px">Price ($)</th>
                                        <th style="padding: 10px" width="130px">Total ($)</th>
                                    </tr>
                                    <tr>
                                        <td style="padding: 20px 0 0 10px"><input class="itemRow" type="checkbox"></td>
                                        <td style="padding: 10px"><input type="text" name="productCode[]" list="productCode1" id="productCode_1" class="form-control" onchange="selectPrice(this.value, 1)"></td>
                                        <td style="padding: 10px"><img src="" id="productImg_1" class="invoiceImg"></td>
                                        <td style="padding: 10px"><input type="text" readonly name="productName[]" id="productName_1" class="form-control"></td>
                                        <td style="padding: 10px"><input id="quantity_1" name="quantity[]" type="number" min="1" class="form-control"></td>
                                        <td style="padding: 10px"><input id="price_1" readonly name="price[]" type="number" min="1" class="form-control"></td>
                                        <td style="padding: 10px"><input readonly value="0" name="totalRow[]" id="total_1" type="number" min="1" class="form-control"></td>
                                        
                                        <datalist id="productCode1">
                                            <?php
                                                $i=0;
                                                $result = mysqli_query($conn, "select product_code from product where account_id =".$_SESSION['account_id']."");
                                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                    echo "<option>".$row['product_code']."</option>";
                                                    echo "<p id='price_val_1'>1</p>";
                                                }
                                            ?>
                                        </datalist>
                                        <datalist id="productCode">
                                            <?php
                                                $result = mysqli_query($conn, "select product_code from product where account_id =".$_SESSION['account_id']."");
                                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                    echo "<option>".$row['product_code']."</option>";
                                                    echo "<p id='price_val_1' hidden>".$row['normal_price']."</p>";
                                                }
                                            ?>
                                        </datalist>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                    <button class="btn btn-primary" id="removeRows" type="button">&nbsp; &minus; &nbsp;</button>
                                    <button class="btn btn-primary" id="addRows" type="button">&nbsp; &plus; &nbsp;</button>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row">
                                    <div class="col-md-5" style="text-align: left ; padding: 20px 5px 5px 5px"><b>Customer:</b></div>
                                    <div class="col-md-7" style="padding: 10px 20px 0 0">
                                    <select class="select2-single form-control" name="cus" id="cus">
                                        <?php
                                        $result = mysqli_query($conn, "select * from customer where account_id =".$_SESSION['account_id']."");
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                            echo "<option value=".$row['customer_id'].">".$row['customer_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row">
                                    <div class="col-md-5" style="text-align: left; right: 0; padding: 20px 5px 5px 5px"><b style="color: #383838;font-size: 18px;">
                                    Sub Total ($):</b></div>
                                    <div class="col-md-7" style="padding: 10px 20px 0 0">
                                        <input value="0" type="number" readonly class="form-control" name="subtotal" id="subtotal" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6"></div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row">
                                    <div class="col-md-5" style="text-align: left; right: 0; padding: 20px 5px 5px 5px">
                                    <b style="">Discount (%):</b></div>
                                    <div class="col-md-7" style="padding: 10px 20px 0 0">
                                        <input value="" type="number" min="0" max="100" maxLength="3" class="form-control" name="discount" id="discount" placeholder="%" onchange="calculateTotal(), calculateDebt()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row">
                                    <div class="col-md-5" style="text-align: left; right: 0; padding: 20px 5px 5px 5px">
                                    <b style="color: #383838;font-size: 18px;">Total ($):</b></div>
                                    <div class="col-md-7" style="padding: 10px 20px 0 0">
                                        <input value="0" type="number" readonly class="form-control" name="total" id="total">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6"></div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row">
                                    <div class="col-md-5" style="text-align: left; right: 0; padding: 20px 5px 5px 5px">
                                    <b style="">Paid ($):</b></div>
                                    <div class="col-md-7" style="padding: 10px 20px 0 0">
                                        <input value="" type="number" class="form-control" name="paid" id="paid" placeholder="$" onchange="calculateDebt()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
                                <div class="row">
                                    <div class="col-md-5" style="text-align: left; right: 0; padding: 20px 5px 5px 5px">
                                    <b style="color: #383838;font-size: 18px;">Debt ($):</b></div>
                                    <div class="col-md-7" style="padding: 10px 20px 0 0">
                                        <input value="0" type="number" readonly class="form-control" name="debt" id="debt" placeholder="%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10">
                                <h3>Notes: </h3>
                                <div class="form-group">
                                    <textarea class="form-control txt" rows="3" name="note" id="note" placeholder="Your Notes"></textarea>
                                </div>
                                <br>
                            </div>
                            <div class="col-lg-2" style="padding-bottom: 0" >
                                <div class="form-group" style="position: absolute; bottom: 0; right: 10px">
                                    <input  style="background-color: #66bb6a; border-color: #66bb6a" data-loading-text="Saving Invoice..." type="submit" name="invoiceCreate" value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">						
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


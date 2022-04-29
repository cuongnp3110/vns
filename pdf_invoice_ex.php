<!-- PRINT -->
<div id="divToPrint" style="display:none; opacity: 1;width: 1px; height: 1px" >
<?php
    if(isset($_GET['id'])){
        $result = mysqli_query($conn, "
        SELECT customer.customer_name, invoice_ex.customer_id, invoice_ex.time, invoice_ex.discount, invoice_ex.subtotal,invoice_ex.total, invoice_ex.payment, invoice_ex.note
        FROM customer, invoice_ex 
        WHERE customer.customer_id = invoice_ex.customer_id and invoice_ex_id = ".$_GET['id']." ");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>
    <h1 style="">VNS GROUP</h1>
    <h1 style="font-size: 40px; text-align: center">INVOICE</h1>
    <p>Customer: <?php echo $row['customer_name'] ?></p>
    <p>Time: <?php echo $row['time'] ?></p>
    <p>____________________________________________________________________________________________________________________________________________________________________________________________</p>
    <table id="invoiceItem" style="width: 100%">	
        <tr>
            <th style="text-align: left">Code</th>
            <th style="text-align: left">Product Name</th>
            <th style="text-align: center">Quantity</th>
            <th style="text-align: right">Price/Unit</th>
            <th style="text-align: right">Total</th>
        </tr>

        <?php
            if(isset($_GET['id'])){
                $i=0;
                $invoiceImId = $_GET['id'];
                $result2 = mysqli_query($conn, "
                select invoice_ex_id, invoice_ex_item.product_code, invoice_ex_item.product_name, quantity, price, total, img 
                from invoice_ex_item, product
                    where invoice_ex_item.product_code = product.product_code and invoice_ex_id = '$invoiceImId'");
                while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){ ?>
                <tr>
                    <td style="height: 40px"><p><?php echo $row2['product_code']?></p></td>
                    <td style=""><p><?php echo $row2['product_name']?></p></td>
                    <td style="text-align: center"><p><?php echo $row2['quantity']?></p></td>
                    <td style="text-align: right"><p>&nbsp;&nbsp;<?php echo toMoney($row2['price'])?></p></td>
                    <td style="text-align: right"><p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo toMoney($row2['total'])?></p></td>
                </tr>
                    <?php
                    $i++;
                }
            }
        ?>
    </table>
    <p style="margin-top: -10px">____________________________________________________________________________________________________________________________________________________________________________________________</p>
    <div style="text-align: right">
        <p style="width: 100%">Subtotal: <?php echo toMoney($row['subtotal']) ?></p>
        <p style="width: 100%">Discount %: <?php echo $row['discount'] ?></p>
        <p style="width: 100%">Total: <?php echo toMoney($row['total']) ?></p>
        <p style="width: 100%">Paid: <?php echo toMoney($row['payment']) ?></p>
        <p style="width: 100%">Debt: <?php echo toMoney($row['total'] - $row['payment']) ?></p>
        <p style="width: 100%">Note: <?php echo $row['note']?></p>
    </div>
    

</div>

<script type="text/javascript">     
    function PrintDiv() {    
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=1000,height=700');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
        window.location = "index.php?page=invoice_ex";
    }
    PrintDiv();
 </script>
<!-- PRINT -->
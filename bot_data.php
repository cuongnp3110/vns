<?php 
session_start();
include_once("connection.php");
if(isset($_GET['data'])){
    $rawData = $_GET['data'];
    mysqli_query($conn, "insert into bot_data(raw_data, account_id) values('$rawData', '".$_SESSION['account_id']."')");
}
if(isset($_GET['product_count'])){
    $result = mysqli_query($conn, "select sum(amount) as total FROM product where account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ob_clean();
    echo $row['total'];
}
if(isset($_GET['product_trade_count'])){
    $result = mysqli_query($conn, "select count(product_id) as total FROM product where account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ob_clean();
    echo $row['total'];
}
if(isset($_GET['customer_count'])){
    $result = mysqli_query($conn, "select count(customer_id) as total FROM customer where account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ob_clean();
    echo $row['total'];
}
if(isset($_GET['supplier_count'])){
    $result = mysqli_query($conn, "select count(supplier_id) as total FROM supplier where account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ob_clean();
    echo $row['total'];
}
if(isset($_GET['category_count'])){
    $result = mysqli_query($conn, "select count(category_id) as total FROM category where account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ob_clean();
    echo $row['total'];
}
if(isset($_GET['brand_count'])){
    $result = mysqli_query($conn, "select count(brand_id) as total FROM brand where account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ob_clean();
    echo $row['total'];
}
if(isset($_GET['ex_invoice_count'])){
    $result = mysqli_query($conn, "select count(invoice_ex_id) as total FROM invoice_ex where account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ob_clean();
    echo $row['total'];
}
if(isset($_GET['im_invoice_count'])){
    $result = mysqli_query($conn, "select count(invoice_im_id) as total FROM invoice_im where account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ob_clean();
    echo $row['total'];
}
if(isset($_GET['best_seller'])){
    $result = mysqli_query($conn, "select product.product_name, SUM(invoice_ex_item.quantity) as total 
    from invoice_ex_item inner 
    join product on invoice_ex_item.product_code = product.product_code 
    join category on category.category_name = product.category_id 
    WHERE invoice_ex_item.account_id = '".$_SESSION['account_id']."'
    group by invoice_ex_item.product_name order by total desc");

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['product_name'], $row['total']);
    }
    
    ob_clean();
    echo json_encode($res);
}

?>
<?php 
session_start();
include_once("connection.php");
if(isset($_GET['barChart'])){
    $result = mysqli_query($conn, "select category.category_name, SUM(invoice_ex_item.total) as total 
    from invoice_ex_item inner 
    join product on invoice_ex_item.product_code = product.product_code 
    join category on category.category_name = product.category_id 
    WHERE invoice_ex_item.account_id = '".$_SESSION['account_id']."'
    group by category.category_name
    order by total asc
    limit 5");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['category_name'], $row['total']);
    }
    ob_clean();
    echo json_encode($res);
}

if(isset($_GET['pieChart'])){
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
if(isset($_GET['areaChart'])){
    $year = $_GET['areaChart'];
    //Jan
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 1 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Feb
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 2 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Mar
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 3 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Apr
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 4 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //May
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 5 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Jun
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 6 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //July
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 7 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Aug
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 8 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Sep
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 9 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Oct
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 10 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Nov
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 11 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    //Dec
    $result = mysqli_query($conn, "SELECT sum(payment) as total FROM invoice_ex WHERE MONTH(time) = 12 and YEAR(time) = $year and account_id = '".$_SESSION['account_id']."'");
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $res[] = array($row['total']);
    }
    ob_clean();
    echo json_encode($res);
}

?>
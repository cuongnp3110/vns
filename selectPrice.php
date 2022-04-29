<?php 
session_start();
include_once("connection.php");
if(isset($_GET['selectPrice'])){
    $proCode = $_GET['selectPrice'];
    $id = $_GET['id'];
    $result = mysqli_query($conn, "select product_name, normal_price, img from product where product_code='$proCode' and account_id ='".$_SESSION['account_id']."'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $res = array(intval($row['normal_price']), $row['product_name'], $row['img']);
    
    ob_clean();
    echo json_encode($res);
}
?>
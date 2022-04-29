<?php
include_once("connection.php");
if(isset($_GET['register'])){
    $email = $_GET['register'];
    $result = mysqli_query($conn, "SELECT email FROM account WHERE email = '$email'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result)==1){
        echo 0;
    } else {
        echo 1;
    }
}

?>
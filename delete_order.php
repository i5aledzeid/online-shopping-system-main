<?php
    include "db.php";
    session_start();
    $order_id = $_GET['id'];
    $order_pro_id = $_GET['oid'];
	//$sql = "DELETE FROM order_products WHERE order_id = '$order_id' AND user_id = '$_SESSION[uid]'";
	//$sql = "DELETE FROM `order_products` WHERE order_pro_id = '$order_pro_id'";
    $sql = "DELETE FROM order_products WHERE `order_products`.`order_pro_id` = '$order_pro_id'";
    $sqli = "DELETE FROM orders_info WHERE `orders_info`.`order_id` = '$order_id'";
    
    if(mysqli_query($con,$sql)){
        if(mysqli_query($con,$sqli)){
            echo "<script>alert('Order order_products deleted!');</script>";
        }
        echo "<script>alert('Order orders_info deleted!');</script>";
    }
    include 'Location: myorders.php';
?>
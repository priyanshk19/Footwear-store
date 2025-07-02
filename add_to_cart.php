<?php

require('connection.php');
require('function.php');

if (!isset($_SESSION['USER_LOGIN']) || $_SESSION['USER_LOGIN'] != 'yes') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = get_safe_value($con, $_POST['product_id']);
    $size = get_safe_value($con, $_POST['size']);
    $quantity = get_safe_value($con, $_POST['quantity']);

    
    $user_id = $_SESSION['USER_ID'];
    $added_on = date('Y-m-d h:i:s');
    
    $insert_cart_sql = "insert into cart (user_id, product_id, size, quantity, added_on) values ('$user_id', '$product_id', '$size', '$quantity', '$added_on')";
    
    mysqli_query($con, $insert_cart_sql);

  
    header("Location: cart.php");
    exit();
}
?>
 
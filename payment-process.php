<?php
session_start();
require('connection.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);
    $order_id = mysqli_real_escape_string($con, $_POST['order_id']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    
    // Insert payment details into the payments table
    $payment_query = "INSERT INTO payments (order_id, payment_id, amount, status) VALUES ('$order_id', '$payment_id', '$amount', 'Success')";
    if (mysqli_query($con, $payment_query)) {
        // Update order status to 'Paid'
        $update_order_query = "UPDATE orders SET status='0' WHERE id='$order_id'";
        mysqli_query($con, $update_order_query);
        
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid_request';
}
?>

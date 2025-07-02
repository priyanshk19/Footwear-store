<?php
ob_start();
require('top.php');

// Check if the user is logged in
if (!isset($_SESSION['USER_LOGIN'])) {
    header('Location: login.php');
    exit();
}

// Check if order_id is set
if (!isset($_GET['order_id'])) {
    header('Location: user_orders.php');
    exit();
}

// Fetch the order details
$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['USER_ID'];

$order_query = "SELECT * FROM orders WHERE id='$order_id' AND user_id='$user_id' AND status=0";
$order_res = mysqli_query($con, $order_query);

if (mysqli_num_rows($order_res) == 1) {
    $update_query = "UPDATE orders SET status=2 WHERE id='$order_id'";
    if (mysqli_query($con, $update_query)) {
        $_SESSION['MESSAGE'] = 'Order cancelled successfully';
    } else {
        $_SESSION['MESSAGE'] = 'Error cancelling order: ' . mysqli_error($con);
    }
} else {
    $_SESSION['MESSAGE'] = 'Invalid order or order cannot be cancelled';
}
header('Location: user_orders.php');
    exit();
ob_end_flush();

?>

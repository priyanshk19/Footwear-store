<?php
require('connection.php');
// Check if the user is logged in
if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] == 'yes') {
    // If logged in, redirect to cart.php
    header('Location: user_orders.php');
    exit;
} else {
    // If not logged in, redirect to login.php
    header('Location: login.php');
    exit;
}
?>


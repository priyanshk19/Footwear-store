<?php
session_start();
require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['USER_ID'];

    if (!isset($user_id)) {
        echo "You need to login to remove items from your wishlist.";
        exit();
    }

    $sql = "DELETE FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
    if (mysqli_query($con, $sql)) {
        header("Location: wishlist.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Invalid request";
}
?>

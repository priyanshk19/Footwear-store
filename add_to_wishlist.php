<?php
require('top.php');

if (!isset($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['USER_ID'];
$product_id = intval($_POST['product_id']);

// Check if the product is already in the wishlist
$check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
$check_result = mysqli_query($con, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Product is already in the wishlist
    $_SESSION['message'] = "Product is already in your wishlist!";
} else {
    // Product is not in the wishlist, so add it
    $add_query = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
    if (mysqli_query($con, $add_query)) {
        $_SESSION['message'] = "Product added to wishlist!";
    } else {
        $_SESSION['message'] = "Failed to add product to wishlist!";
    }
}

header("Location: wishlist.php");
exit();
?>

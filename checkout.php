<?php
session_start();
ob_start();

// Include necessary files and configurations
require('top.php');

// Redirect if user is not logged in
if (!isset($_SESSION['USER_LOGIN'])) {
    header('Location: login.php');
    exit();
}

// Fetch cart items for the current user
$user_id = $_SESSION['USER_ID'];
$cart_res = mysqli_query($con, "SELECT cart.*, product.name, product.price, product.image, product.qty AS product_qty FROM cart JOIN product ON cart.product_id = product.id WHERE cart.user_id='$user_id'");

$total_amount = 0;
$cart_items = [];
while ($row = mysqli_fetch_assoc($cart_res)) {
    $total_price = $row['quantity'] * $row['price'];
    $total_amount += $total_price;
    $cart_items[] = $row;
}

// Process the order when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $zip = mysqli_real_escape_string($con, $_POST['zip']);
    $payment_method = mysqli_real_escape_string($con, $_POST['payment_method']);

    // Insert order details into the database
    $order_query = "INSERT INTO orders (user_id, total_amount, address, city, state, zip, status, payment_method) VALUES ('$user_id', '$total_amount', '$address', '$city', '$state', '$zip', 0, '$payment_method')";
    mysqli_query($con, $order_query);
    $order_id = mysqli_insert_id($con);

    // Insert payment details into the database
    if ($payment_method !== 'online') {
        $payment_query = "INSERT INTO payments (order_id, payment_id, amount, status) VALUES ('$order_id', '', '$total_amount', 'pending')";
        mysqli_query($con, $payment_query);
    }

    // Insert order items into the database and update product quantities
    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        // Insert order item
        $order_items_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        mysqli_query($con, $order_items_query);

        // Update product quantity
        $new_qty = $item['product_qty'] - $quantity;
        $update_product_query = "UPDATE product SET qty='$new_qty' WHERE id='$product_id'";
        mysqli_query($con, $update_product_query);
    }

    // Clear the cart
    mysqli_query($con, "DELETE FROM cart WHERE user_id='$user_id'");

    // Redirect based on payment method
    if ($payment_method === 'online') {
        // Redirect to Razorpay initialization
        header('Location: razorpay_init.php?order_id=' . $order_id);
        exit();
    } else {
        header('Location: order_confirmation.php?order_id=' . $order_id);
        exit();
    }
}

// Check if there are items in the cart
if (empty($cart_items)) {
    echo "<div class='container'><h2>No products found in the cart.</h2></div>";
    require('footer.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .checkout-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .checkout-form .form-group {
            margin-bottom: 15px;
        }
        .checkout-btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Checkout</h2>
        <form method="post" action="checkout.php" class="checkout-form">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="zip">Zip Code</label>
                <input type="text" id="zip" name="zip" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select id="payment_method" name="payment_method" class="form-control" required>
                    <option value="online">Online</option>
                    <option value="cod">Cash on Delivery</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary checkout-btn">Place Order</button>
        </form>
    </div>
</body>
</html>

<?php
require('footer.php');

// End output buffering and flush the output
ob_end_flush();
?>

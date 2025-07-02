<?php
require('top.php');

// Check if order ID is set in the URL
if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
    $order_id = mysqli_real_escape_string($con, $_GET['order_id']);
    
    // Fetch order details
    $order_query = "SELECT * FROM orders WHERE id='$order_id'";
    $order_res = mysqli_query($con, $order_query);
    
    // Check if the order exists
    if (mysqli_num_rows($order_res) > 0) {
        $order = mysqli_fetch_assoc($order_res);
        
        // Fetch order items
        $order_items_query = "SELECT order_items.*, product.name, product.image 
                              FROM order_items 
                              JOIN product ON order_items.product_id = product.id 
                              WHERE order_items.order_id='$order_id'";
        $order_items_res = mysqli_query($con, $order_items_query);
        
        // Check if order items exist
        if (mysqli_num_rows($order_items_res) == 0) {
            echo "<div class='container'><h2>No items found in this order.</h2></div>";
            require('footer.php');
            exit();
        }
    } else {
        echo "<div class='container'><h2>Order not found.</h2></div>";
        require('footer.php');
        exit();
    }
} else {
    echo "<div class='container'><h2>Order ID is missing.</h2></div>";
    require('footer.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .order-details {
            background: #ffffff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .order-header {
            margin-bottom: 30px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="order-details">
        <div class="order-header">
            <h2>Order Details</h2>
            <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['id']); ?></p>
            <p><strong>Total Amount:</strong> <?php echo htmlspecialchars($order['total_amount']); ?> INR</p>
            <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['created_at']); ?></p>
            <p><strong>Status:</strong> <?php echo ($order['status'] == 0) ? 'On The Way' : 'Delivered'; ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address'] . ', ' . $order['city'] . ', ' . $order['state'] . ' ' . $order['zip']); ?></p>
        </div>
        <h3>Order Items</h3>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($order_items_res)) { 
                    $total_price = $row['quantity'] * $row['price']; ?>
                    <tr>
                        <td>
                            <img src="admin/pic/product/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                            <p><?php echo htmlspecialchars($row['name']); ?></p>
                        </td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><?php echo htmlspecialchars($total_price); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="user_orders.php" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>
</div>

<?php
require('footer.php');
?>

</body>
</html>

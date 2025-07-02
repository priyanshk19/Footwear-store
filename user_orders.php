<?php
require('top.php');

// Check if the user is logged in
if (!isset($_SESSION['USER_LOGIN'])) {
    header('Location: login.php');
    exit();
}

// Fetch the current user's orders
$user_id = $_SESSION['USER_ID'];
$order_query = "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY created_at DESC";
$order_res = mysqli_query($con, $order_query);

if (!$order_res) {
    die('Error fetching orders: ' . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .orders-table {
            background: #ffffff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .orders-header {
            margin-bottom: 30px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="orders-table">
        <div class="orders-header">
            <h2>Your Orders</h2>
        </div>
        <?php if (mysqli_num_rows($order_res) > 0) { ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Total Amount</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = mysqli_fetch_assoc($order_res)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_amount']); ?></td>
                            <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                            <td>
                                <?php 
                                    if ($order['status'] == 0) {
                                        echo 'On The Way';
                                    } else if ($order['status'] == 1) {
                                        echo 'Delivered';
                                    } else if ($order['status'] == 2) {
                                        echo 'Cancelled';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="order_details.php?order_id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-primary btn-sm">View Details</a>
                                <?php if ($order['status'] == 0) { ?>
                                    <a href="cancel_order.php?order_id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No orders found.</p>
        <?php } ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
</div>

<?php
require('footer.php');
?>
</body>
</html>

<?php
session_start();
ob_start();

require('connection.php'); // Include your database and other configurations

// Fetch order details from the database based on order_id
$order_id = $_GET['order_id']; // Assuming you pass order_id via GET parameter

// Fetch order total amount from orders table
$order_query = mysqli_query($con, "SELECT * FROM orders WHERE id='$order_id'");
$order_details = mysqli_fetch_assoc($order_query);

$total_amount = $order_details['total_amount']; // Fetch total amount from orders table

// Razorpay configuration
$razorpay_key = 'rzp_test_AyuZq4s3xRPZvf'; // Replace with your Razorpay Key ID

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <!-- Include Bootstrap or any other CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <form id="checkoutForm" method="post" action="payment-process.php">
            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
            <div class="form-group">
                <label for="amount">Amount: <?php echo htmlspecialchars($total_amount); ?> INR</label>
                <input type="hidden" id="amount" name="amount" value="<?php echo htmlspecialchars($total_amount); ?>">
            </div>
            <button type="button" id="razorpayBtn" class="btn btn-primary checkout-btn">Proceed to Payment</button>
        </form>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Razorpay Checkout script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            $('#razorpayBtn').click(function(e) {
                e.preventDefault();

                var orderId = '<?php echo $order_id; ?>';
                var amount = <?php echo $total_amount * 100; ?>; // Amount in paisa (100 times the amount in INR)

                var options = {
                    key: '<?php echo $razorpay_key; ?>',
                    amount: amount,
                    currency: 'INR',
                    name: 'Your Company Name',
                    description: 'Payment for Order ID: ' + orderId,
                    image: 'https://example.com/your_logo.png', // Replace with your logo URL
                    handler: function(response) {
                        // Redirect to payment-process.php for processing payment on server-side
                        var paymentId = response.razorpay_payment_id;
                        $.ajax({
                            url: 'payment-process.php',
                            type: 'POST',
                            data: { payment_id: paymentId, order_id: orderId, amount: <?php echo $total_amount; ?> },
                            success: function(data) {
                                if (data === 'success') {
                                    // Payment successful, redirect or show success message
                                    alert('Payment successful!');
                                    window.location.href = 'order_confirmation.php?order_id=' + orderId;
                                } else {
                                    // Payment failed, handle error
                                    alert('Payment failed. Please try again or contact support.');
                                    console.error('Payment failed:', data);
                                }
                            },
                            error: function(err) {
                                alert('Error processing payment. Please try again.');
                                console.error('Error:', err);
                            }
                        });
                    }
                };

                var rzp = new Razorpay(options);
                rzp.open();
            });
        });
    </script>
</body>
</html>

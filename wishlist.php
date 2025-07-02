<?php
require('top.php');

// Check if the user is logged in
if (!isset($_SESSION['USER_ID'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['USER_ID'];

// Fetch wishlist items for the logged-in user
$wishlist_res = mysqli_query($con, "SELECT product.* FROM wishlist JOIN product ON wishlist.product_id = product.id WHERE wishlist.user_id = '$user_id'");

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/your/css/file.css"> <!-- Update this with the path to your CSS file -->
    <style>
        /* Include your additional styles here */
        .remove-btn {
            background: none;
            border: none;
            color: red;
            font-size: 18px;
            cursor: pointer;
        }

        .add-to-cart-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .message {
            color: green;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Breadcrumb Area -->
<!-- <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Wishlist</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- End Breadcrumb Area -->

<!-- Wishlist Area Start -->
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <?php if ($message) { ?>
                        <div class="message"><?php echo htmlspecialchars($message); ?></div>
                    <?php } ?>
                    <div class="wishlist-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-remove"><span class="nobr">Remove</span></th>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name"><span class="nobr">Product Name</span></th>
                                    <th class="product-price"><span class="nobr">Unit Price</span></th>
                                    <th class="product-stock-status"><span class="nobr">Stock Status</span></th>
                                    <th class="product-add-to-cart"><span class="nobr">Add To Cart</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($wishlist_res) > 0) {
                                    while ($product = mysqli_fetch_assoc($wishlist_res)) {
                                ?>
                                <tr>
                                    <td class="product-remove">
                                        <form method="post" action="remove_form_wishlist.php" style="display:inline;">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <button type="submit" class="remove-btn">×</button>
                                        </form>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="product.php?id=<?php echo $product['id']; ?>"><img src="admin/pic/product/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image"></a>
                                    </td>
                                    <td class="product-name">
                                        <a href="product.php?id=<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></a>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount"><?php echo htmlspecialchars($product['price']); ?></span>
                                    </td>
                                    <td class="product-stock-status">
                                        <span class="wishlist-in-stock"><?php echo ($product['qty'] > 0) ? 'In Stock' : 'Out of Stock'; ?></span>
                                    </td>
                                    <td class="product-add-to-cart">
                                        <?php if ($product['qty'] > 0) { ?>
                                            <form method="post" action="add_to_cart.php" style="display:inline;">
                                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                                <input type="hidden" name="quantity" value="1"> <!-- Default quantity is set to 1 -->
                                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                                            </form>
                                        <?php } else { ?>
                                            <button type="button" class="add-to-cart-btn" disabled>Out of Stock</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>Your wishlist is empty.</td></tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wishlist Area End -->

<?php
require('footer.php');
?>

</body>
</html>

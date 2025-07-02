<?php
session_start();
ob_start();

require('top.php'); 

if (!isset($_SESSION['USER_LOGIN']) || $_SESSION['USER_LOGIN'] != 'yes') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['USER_ID'];



if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'delete') {
        $cart_id = get_safe_value($con, $_GET['id']);
        $delete_sql = "DELETE FROM cart WHERE id='$cart_id' AND user_id='$user_id'";
        mysqli_query($con, $delete_sql);
        // Refresh the page to update the cart
        header("Location: cart.php");
        exit();
    }
}

$get_cart_sql = "SELECT cart.id, product.name, product.image, product.price, cart.size, cart.quantity 
                 FROM cart 
                 INNER JOIN product ON cart.product_id = product.id 
                 WHERE cart.user_id = '$user_id'";
$result = mysqli_query($con, $get_cart_sql);

$total_net_amount = 0;

?>

<!-- Start Bradcaump area -->
<!-- <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Shopping Cart</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- End Bradcaump area -->

<!-- cart-main-area start -->
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Products</th>
                                    <th class="product-name">Name of Products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-size">Size</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $total_amount = $row['price'] * $row['quantity'];
                                        $total_net_amount += $total_amount;
                                ?>
                                <tr>
                                    <td>
                                        <img src="admin/pic/product/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100">
                                        <br>
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['size']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $total_amount; ?></td>
                                    <td><a href="?type=delete&id=<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></a></td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="7">No items in your cart.</td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="index.php">Continue Shopping</a>
                                </div>
                                <h2>Cart Total</h2>
                                <ul>
                                    <li>Total Amount <span><?php echo $total_net_amount; ?></span></li>
                                </ul>
                                <div class="buttons-cart checkout--btn">
                                    <a href="checkout.php">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form> 
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->

<?php require('footer.php'); ?>

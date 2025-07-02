<?php
require('top.php');

// Initialize default quantity
$default_quantity = 1;

// Check if product ID is set in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Fetch product details for the specific product ID
    $product_res = mysqli_query($con, "SELECT * FROM product WHERE id='$product_id'");
    $product = mysqli_fetch_assoc($product_res);
    
    // Check if the product exists
    if (!$product) {
        echo "<p>Product not found</p>";
        require('footer.php');
        exit();
    }
} else {
    // Redirect to homepage if product ID is not set
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .product__details {
            background-color: #fff;
            padding: 30px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }
        .product__details .product__info {
            flex: 1;
            text-align: left;
            padding-left: 20px;
        }
        .product__details .product__image {
            flex: 1;
            text-align: center;
        }
        .product__details .product__image img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .product__details h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .product__details .pro__prize {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }
        .product__details .pro__prize li {
            display: inline-block;
            margin-right: 10px;
            font-weight: bold;
            color: #333;
        }
        .product__details .pro__prize .old__prize {
            text-decoration: line-through;
            color: #888;
        }
        .product__details .pro__info {
            color: #666;
            margin-bottom: 20px;
        }
        .product__details .availability {
            color: #333;
        }

        /* Size Chart Styles */
        .size__chart {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
        }
        .size__chart h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .size__chart .size__options {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 10px;
        }
        .size__chart .size__options label {
            display: block;
            width: 60px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            margin-right: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        .size__chart .size__options label:hover {
            background-color: #e0e0e0;
        }
        .size__chart .size__options input[type="radio"] {
            display: none;
        }
        .size__chart .size__options input[type="radio"]:checked + label {
            background-color: #4CAF50;
            color: white;
        }

        /* Add to Cart Button Styles */
        .add-to-cart {
            margin-top: 20px;
            text-align: center;
        }
        .add-to-cart .add-to-cart-btn, .add-to-wishlist-btn {
            background-color: #c43b68;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        .add-to-cart .add-to-cart-btn:hover, .add-to-wishlist-btn:hover {
            background-color: #FFFFFF;
        }

        /* Error Message Style */
        .error-message {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- Product Details Section -->
<section class="product__details">
    <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 product__image">
                <img src="admin/pic/product/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
            </div>
            
            <!-- Product Info -->
            <div class="col-md-6 product__info">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <ul class="pro__prize">
                    <li class="old__prize"><?php echo htmlspecialchars($product['mrp']); ?></li>
                    <li><?php echo htmlspecialchars($product['price']); ?></li>
                </ul>
                <p class="pro__info"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="availability"><span>Availability:</span> <?php echo ($product['qty'] > 0) ? 'In Stock (' . $product['qty'] . ')' : 'Out of Stock'; ?></p>
                <form id="productForm" method="post" action="add_to_cart.php" onsubmit="return validateForm()">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="size__chart">
                        <h3>Size Chart (UK Sizes)</h3>
                        <div class="size__options">
                            <?php
                            // Generate radio buttons for UK sizes 1 to 12
                            for ($i = 4; $i <= 12; $i++) {
                                echo '<input type="radio" id="size' . $i . '" name="size" value="UK ' . $i . '">';
                                echo '<label for="size' . $i . '">UK ' . $i . '</label>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="quantity">
                        <label>Quantity:</label>
                        <select name="quantity">
                            <?php
                            // Generate options for quantity dropdown
                            for ($i = 1; $i <= $product['qty']; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="add-to-cart">
                        <?php if ($product['qty'] > 0) { ?>
                            <button type="submit" class="fv-btn add-to-cart-btn">Add to Bag</button>
                        <?php } else { ?>
                            <button type="button" class="fv-btn add-to-cart-btn" disabled>Out of Stock</button>
                        <?php } ?>
                        <button type="button" class="fv-btn add-to-wishlist-btn" onclick="addToWishlist(<?php echo $product['id']; ?>)">Add to Wishlist</button>
                    </div>
                    <div id="errorMessage" class="error-message"></div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Product Details Section -->

<?php
require('footer.php');
?>

<!-- JavaScript for Form Validation -->
<script>
    function validateForm() {
        var sizeSelected = false;
        var sizeOptions = document.getElementsByName('size');
        
        for (var i = 0; i < sizeOptions.length; i++) {
            if (sizeOptions[i].checked) {
                sizeSelected = true;
                break;
            }
        }
        
        if (!sizeSelected) {
            document.getElementById('errorMessage').innerHTML = 'Please select a size.';
            return false; // Prevent form submission
        } else {
            document.getElementById('errorMessage').innerHTML = '';
            return true; // Allow form submission
        }
    }

    function addToWishlist(productId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_wishlist.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText === 'login_required') {
                    alert('Please log in to add to wishlist.');
                    window.location.href = 'login.php'; // Redirect to login page
                } else {
                    alert('Product added to wishlist');
                }
            }
        };
        xhr.send("product_id=" + productId);
    }
</script>
</body>
</html>

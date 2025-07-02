<?php
include('top.php'); 

// Default sorting order
$sort_order = "ORDER BY name ASC";

// Check if sort option is set in the URL
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    if ($sort == 'name_asc') {
        $sort_order = "ORDER BY name ASC";
    } elseif ($sort == 'name_desc') {
        $sort_order = "ORDER BY name DESC";
    } elseif ($sort == 'price_asc') {
        $sort_order = "ORDER BY price ASC";
    } elseif ($sort == 'price_desc') {
        $sort_order = "ORDER BY price DESC";
    }
}

if (isset($_GET['id'])) {
    $brand_id = intval($_GET['id']);
    
    $brand_query = "SELECT * FROM brand WHERE brand_id = $brand_id";
    $brand_result = mysqli_query($con, $brand_query);
    $brand = mysqli_fetch_assoc($brand_result);
    
    $product_query = "SELECT * FROM product WHERE brand_id = $brand_id $sort_order";
    $product_result = mysqli_query($con, $product_query);
} else {
    header('Location: index.php');
    exit;
}
?>

<!-- Start Bradcaump area -->
    <!-- <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/banner/pk1.jpg) no-repeat scroll center center / cover;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="index.php">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active" a class="breadcrumb-item" href="brand_product.php">Brand</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<!-- End Bradcaump area -->

<!-- Start Product Grid -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 align="center">Products by <?php echo htmlspecialchars($brand['brand_name']); ?></h1>
                <div class="htc__product__rightidebar">
                    <div class="htc__grid__top">
                        <div class="htc__select__option">
                            <form method="GET" id="sortForm">
                                <input type="hidden" name="id" value="<?php echo $brand_id; ?>">
                                <select class="ht__select" name="sort" onchange="document.getElementById('sortForm').submit();">
                                    <option value="">Default sorting</option>
                                    <option value="name_asc" <?php if (isset($sort) && $sort == 'name_asc') echo 'selected'; ?>>Sort by name: A to Z</option>
                                    <option value="name_desc" <?php if (isset($sort) && $sort == 'name_desc') echo 'selected'; ?>>Sort by name: Z to A</option>
                                    <option value="price_asc" <?php if (isset($sort) && $sort == 'price_asc') echo 'selected'; ?>>Sort by price: Low to High</option>
                                    <option value="price_desc" <?php if (isset($sort) && $sort == 'price_desc') echo 'selected'; ?>>Sort by price: High to Low</option>
                                </select>
                            </form>
                        </div>
                        
                        <!-- Start List And Grid View -->
                        <ul class="view__mode" role="tablist">
                            <li role="presentation" class="grid-view active"><a href="#grid-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-grid"></i></a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                    <!-- Start Product View -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                <div class="product__list clearfix mt--30">
                                    <?php
                                    while ($product = mysqli_fetch_assoc($product_result)) {
                                    ?>
                                    <!-- Start Single Category -->
                                    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                        <div class="category">
                                            <div class="ht__cat__thumb">
                                                <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                                                    <img src="admin/pic/product/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                                </a>
                                            </div>
                                            <div class="fr__product__inner">
                                                <h4><a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>"><?php echo htmlspecialchars($product['name']); ?></a></h4>
                                                <ul class="fr__pro__prize">
                                                    <li class="old__prize"><?php echo htmlspecialchars($product['mrp']); ?></li>
                                                    <li><?php echo htmlspecialchars($product['price']); ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Category -->
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Product View -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require('footer.php');
?>

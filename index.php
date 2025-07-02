<?php
    require('top.php');
    $sql = "select * from product where id IN (74, 75)"; // Replace 1, 2 with the product IDs you want to display
$result = $con->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
    
?>


        <!-- End Offset Wrapper -->

        <!-- Start Slider Area -->
   
<div class="slider__container slider--one bg__cat--3">
    <div class="slide__container slider__activation__wrap owl-carousel">
        <?php foreach ($products as $product)
        { ?>
        <!-- Start Single Slide -->
        <div class="single__slide animation__style01 slider__fixed--height">
            <div class="container">
                <div class="row align-items__center">
                    <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                        <div class="slide">
                            <div class="slider__inner">
                                <h2>collection 2024</h2>
                                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                                <div class="cr__btn">
                                    <a href="product_details.php?id=<?php echo $product['id']; ?>">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                        <div class="slide__thumb">
                            <a href="product_details.php?id=<?php echo $product['id']; ?>">
                                <img src="admin/pic/product/<?php echo htmlspecialchars($product['image']); ?>" alt="slider images">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slide -->
        <?php } ?>
    </div>
</div>


        <!-- Start Slider Area -->
        <!-- Start Category Area -->

        <!-- End Category Area -->
        <!-- Swiper -->

        <section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">Shop By Brand</h2>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row">          
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php
                        $get_brand = get_brand($con);
                        foreach ($get_brand as $list) {
                    ?>
                    <div class="swiper-slide">
                        <a href="brand_product.php?id=<?php echo $list['brand_id']; ?>">
                            <img alt="" src="admin/pic/brand/<?php echo $list['brand_logo']; ?>" class="primary-image" height="220" width="70">
                        </a>
                        <div class="fr__product__inner">
                            <h4><a href="brand_product.php?id=<?php echo $list['brand_id']; ?>"><?php echo $list['brand_name']; ?></a></h4>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>      
</section>


  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 0,
      loop: true,
      mousewheel: true,
      pagination: {
        
        clickable: true,
      },
      
    });
  </script>


<section class="htc__category__area ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">New Arrivals</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="htc__product__container">
                    <div class="row">
                        <div class="product__list clearfix mt--30">
                            <?php
                             $get_product=get_product($con,4);
                             foreach($get_product as $list)
                             {
                             ?>
                            <!-- Start Single Category -->
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                    <a href="product_details.php?id=<?php echo $list['id']; ?>">
                                        <img src="admin/pic/product/<?php echo $list['image']; ?>">
                                        </a>
                                    </div>
                                    <div class="fr__product__inner">
                                    <h4><a href="product_details.php?id=<?php echo $list['id']; ?>"><?php echo $list['name']; ?></a></h4>
                                        <ul class="fr__pro__prize">
                                            <li class="old__prize"><?php echo $list['mrp'] ?></li>
                                            <li><?php echo $list['price'] ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                             }
                             ?>
                            <!-- End Single Category -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
   <!-- Start Most Trending Area -->

   <!-- <section class="ftr__product__area ptb--100 most-trend">
            <div class="container ">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Most Trending</h2>                           
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__wrap clearfix">
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="product-details.html">
                                        <img src="images/product/9.jpg" alt="product images">
                                    </a>
                                </div>
                                <div class="fr__product__inner">
                                    <h4><a href="product-details.html">Special Wood Basket</a></h4>
                                    <ul class="fr__pro__prize">
                                        <li class="old__prize">$30.3</li>
                                        <li>$25.9</li>
                                    </ul>
                                </div>
                            </div>
                        </div>               
                    </div>
                </div>
            </div>
    </section> -->

        <!-- End Most treding -->

        <!-- Start Product Area -->
        <!-- <section class="ftr__product__area ptb--100">
            <div class="container ">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section__title--2 text-center">
                            <h2 class="title__line">Best Seller</h2>
                            <p>But I must explain to you how all this mistaken idea</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="product__wrap clearfix">
                       
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="product-details.html">
                                        <img src="images/product/9.jpg" alt="product images">
                                    </a>
                                </div>
                                <div class="fr__product__inner">
                                    <h4><a href="product-details.html">Special Wood Basket</a></h4>
                                    <ul class="fr__pro__prize">
                                        <li class="old__prize">$30.3</li>
                                        <li>$25.9</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                       
                        
                        
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Product Area -->

        <?php

// Fetch best-selling products
$best_sellers_res = mysqli_query($con, "
    SELECT 
        product.id, 
        product.name, 
        product.image,
        product.mrp,
        product.price,
        SUM(order_items.quantity) AS total_sold
    FROM 
        order_items
    JOIN 
        product ON order_items.product_id = product.id
    GROUP BY 
        order_items.product_id
    ORDER BY 
        total_sold DESC
    LIMIT 4");
?>

<section class="ftr__product__area ptb--100">
    <div class="container ">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">Best Seller</h2>
                    <p>But I must explain to you how all this mistaken idea</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product__wrap clearfix">
                <?php while ($product = mysqli_fetch_assoc($best_sellers_res)) { ?>
                    <!-- Start Single Category -->
                    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                        <div class="category">
                            <div class="ht__cat__thumb">
                                <a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                                    <img src="admin/pic/product/<?php echo htmlspecialchars($product['image']); ?>" alt="product images">
                                </a>
                            </div>
                            <div class="fr__product__inner">
                                <h4><a href="product_details.php?id=<?php echo htmlspecialchars($product['id']); ?>"><?php echo htmlspecialchars($product['name']); ?></a></h4>
                                <ul class="fr__pro__prize">
                                <li class="old__prize"><?php echo $product['mrp'] ?></li>
                                    <li><?php echo htmlspecialchars($product['price']); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Category -->
                <?php } ?>
            </div>
        </div>
    </div>
</section>




        <?php
        require('footer.php');
        ?>
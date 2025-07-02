<?php
ob_start();

require('connection.php');
require('function.php');

// Fetch categories
$cat_res = mysqli_query($con, "SELECT * FROM category");
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
    // Fetch subcategories for each category
    $sub_cat_res = mysqli_query($con, "SELECT * FROM sub_cat WHERE category_id=" . $row['category_id']);
    $sub_cat_arr = array();
    while ($sub_row = mysqli_fetch_assoc($sub_cat_res)) {
        $sub_cat_arr[] = $sub_row;
    }
    $row['subcategories'] = $sub_cat_arr;
    $cat_arr[] = $row;
}

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ragnar Footwear</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- Modernizr JS -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-md-2 col-sm-3 col-xs-5"> 
                                <div class="logo">
                                     <a href="index.php"><img src="images/logo/ragnarlogo.jpg" alt="Ragnar Logo"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                            <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php
                                        foreach ($cat_arr as $list) {
                                        ?>
                                        <li class="drop">
                                            <a href="category.php?id=<?php echo $list['category_id']; ?>"><?php echo $list['category_name']; ?></a>
                                            <ul class="dropdown mega_dropdown">
                                                <div class="row">
                                                <?php
                                                foreach ($list['subcategories'] as $subcat) {
                                                ?>
                                                <div class="col-md-3">
                                                    <li><a href="sub_cat.php?id=<?php echo $subcat['sub_cat_id']; ?>"><?php echo $subcat['sub_cat_name']; ?></a></li>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                </div>
                                            </ul>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <li><a href="redirect_contact.php">Contact</a></li>
                                        <li><a href="redirect_cart.php"><i class="zmdi zmdi-shopping-cart"></i></a></li>
                                        <li><a href="redirect_wishlist.php"><i class="bi bi-heart-fill"></i></a></li>
                                        <li><a href="redirect_bag.php"><i class="bi bi-bag-fill"></i></a></li>
                                    </ul>
                                </nav>
                                
                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.html">Home</a></li>
                                            <?php
                                            foreach ($cat_arr as $list) {
                                            ?>
                                            <li>
                                                <a href="index.php?id=<?php echo $list['category_id']; ?>"><?php echo $list['category_name']; ?></a>
                                                <ul>
                                                    <?php
                                                    foreach ($list['subcategories'] as $subcat) {
                                                    ?>
                                                    <li><a href="sub_cat.php?id=<?php echo $subcat['sub_cat_id']; ?>"><?php echo $subcat['sub_cat_name']; ?></a></li>
                                                    <?php
                                                    }
                                                    ?> 
                                                </ul>
                                            </li>
                                            <?php
                                            }
                                            ?>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>  
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                        <?php if(isset($_SESSION['USER_NAME'])){
                                            echo '<a href="profile.php">'.htmlspecialchars($_SESSION['USER_NAME']).'</a>';
                                            echo '<a href="logout.php">Logout</a>';

										}else{
											echo '<a href="login.php">Login/Register</a>';
										}
										?>                                    
                                    </div>
                                     
                                </div>
                                </div>

                               
                            

                              
                            
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            
            <!-- End Mainmenu Area -->
        </header>
        <?php
         require('search.inc.php');

         ob_end_flush();
        ?>
       
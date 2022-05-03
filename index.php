<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
    $id=intval($_GET['id']);
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity']++;
    }else{
        $sql_p="SELECT * FROM products WHERE id={$id}";
        $query_p=mysqli_query($con,$sql_p);
        if(mysqli_num_rows($query_p)!=0){
            $row_p=mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
        
        }else{
            $message="Product ID is invalid";
        }
    }
        echo "<script>alert('Product has been added to the cart')</script>";
        echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}


?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Luch FabRick</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
       <!--  top header -->
        <!-- Main-header -->
        <!-- menu-Bar -->
    </header>
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="img/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag,kids</span>
                            <h1>Black friday</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="img/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag,kids</span>
                            <h1>Black friday</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    

    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="img/products/women-large.jpg">
                        <h2>Thrift</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li class="active">Thrift</li>
                            <li>Ready Made</li>
                            <li>Pre - Order</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                      
                        <?php
$ret=mysqli_query($con,"select * from products");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="" width="170" height="300">
                                <div class="sale">Sale</div>
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <?php if($row['productAvailability']=='In Stock'){?>

                                    <li class="w-icon active"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><i class="icon_bag_alt"></i></a></li>
                                    

                                    <li class="quick-view"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>">+ Add to Cart</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    <?php } else {?>
                                    <!-- <li class="w-icon active"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><i class="icon_bag_alt"></i></a></li>
                                    
 -->
                                    <li class="quick-view"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">+ OUT OF STOCK</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">luch fabrick</div>
                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                    <h5><?php echo htmlentities($row['productName']);?></h5>
                                </a>
                                <div class="product-price">
                                    &#8358;<?php echo htmlentities($row['productPrice']);?>
                                    <span>&#8358;<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->

    <!-- Deal Of The Week Section Begin-->
    <section class="deal-of-week set-bg spad" data-setbg="img/time-bg.jpg">
        <div class="container">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                        consectetur adipisicing elit </p>
                    <div class="product-price">
                       &#8358;35.00
                        <span>/ HanBag</span>
                    </div>
                </div>
                <div class="countdown-timer" id="countdown">
                    <div class="cd-item">
                        <span>56</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span>12</span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span>40</span>
                        <p>Mins</p>
                    </div>
                    <div class="cd-item">
                        <span>52</span>
                        <p>Secs</p>
                    </div>
                </div>
                <a href="#" class="primary-btn">Shop Now</a>
            </div>
        </div>
    </section>
    <!-- Deal Of The Week Section End -->

<section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="img/products/women-large.jpg">
                        <h2>Ready Made</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li>Thrift</li>
                            <li class="active">Ready Made</li>
                            <li>Pre - Order</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                      
                        <?php
$ret=mysqli_query($con,"select * from products");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="" width="170" height="300">
                                <div class="sale">Sale</div>
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <?php if($row['productAvailability']=='In Stock'){?>

                                    <li class="w-icon active"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><i class="icon_bag_alt"></i></a></li>
                                    

                                    <li class="quick-view"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>">+ Add to Cart</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    <?php } else {?>
                                    
                                               <li class="quick-view"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">+ OUT OF STOCK</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">luch fabrick</div>
                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                    <h5><?php echo htmlentities($row['productName']);?></h5>
                                </a>
                                <div class="product-price">
                                    &#8358;<?php echo htmlentities($row['productPrice']);?>
                                    <span>&#8358;<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="img/products/man-large.jpg">
                        <h2>Preorder</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li>Thrift</li>
                            <li>Ready Made</li>
                            <li class="active">Pre - Order</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                      
                        <?php
$ret=mysqli_query($con,"select * from products");
while ($row=mysqli_fetch_array($ret)) 
{
    # code...


?>
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="" width="170" height="300">
                                <div class="sale">Sale</div>
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <?php if($row['productAvailability']=='In Stock'){?>

                                    <li class="w-icon active"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><i class="icon_bag_alt"></i></a></li>
                                    

                                    <li class="quick-view"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>">+ Add to Cart</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    <?php } else {?>
                                    
                                    
 -->
                                    <li class="quick-view"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">+ OUT OF STOCK</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">luch fabrick</div>
                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                    <h5><?php echo htmlentities($row['productName']);?></h5>
                                </a>
                                <div class="product-price">
                                    &#8358;<?php echo htmlentities($row['productPrice']);?>
                                    <span>&#8358;<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                </div>
                            </div>
                        </div>
                            <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->
    

    

    <?php include('includes/instagram.php');?>

   

    <?php include('includes/footer.php');?>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery.dd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <!-- For demo purposes – can be removed on production -->
    
    <script src="switchstylesheet/switchstylesheet.js"></script>
    
    <script>
        $(document).ready(function(){ 
            $(".changecolor").switchstylesheet( { seperator:"color"} );
            $('.show-theme-options').click(function(){
                $(this).parent().toggleClass('open');
                return false;
            });
        });

        $(window).bind("load", function() {
           $('.show-theme-options').delay(2000).trigger('click');
        });
    </script>
    <!-- For demo purposes – can be removed on production : End -->

    
</body>

</html>
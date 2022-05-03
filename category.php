<?php
session_start();
error_reporting(0);
include('includes/config.php');
$cid=intval($_GET['cid']);
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
                echo "<script>alert('Product has been added to the cart')</script>";
        echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
        }else{
            $message="Product ID is invalid";
        }
    }
    
}
// COde for Wishlist
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','".$_GET['pid']."')");
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

}
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
    <title>Luch FabRick | Product Category</title>

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

       <!--  top header -->
        <!-- Main-header -->
        <!-- menu-Bar -->
<div class="nav-item">
            <div class="container">
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        

                        <li><a href="#">Sub Category</a>
                            <ul class="dropdown">
                                <?php $sql=mysqli_query($con,"select id,subcategory  from subcategory where categoryid='$cid'");
while($row=mysqli_fetch_array($sql))
{
    ?>
                                <li><a href="sub-category.php?scid=<?php echo $row['id'];?>"><?php echo $row['subcategory'];?></a></li>
        <?php } ?>
                            </ul>
                        </li>

                        <li><a href="#">Categories</a>
                            <ul class="dropdown">
                                <?php $sql=mysqli_query($con,"select id,categoryName  from category limit 6");
while($row=mysqli_fetch_array($sql))
{
    ?>
                                <li><a href="category.php?cid=<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></a></li>
        <?php } ?>
                            </ul>
                        </li>
                        <!-- <li><a href="./blog.html">About</a></li>
                        <li><a href="./contact.html">Contact</a></li> -->
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
        <!-- menu Bar -->
    </header>
    <!-- Header End -->


    

    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="img/products/women-large.jpg">
                        <h2>Luch FabRick</h2>
                        <a href="#">Thrift store</a>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li class="active">Thrift</li>
                            <li class="active">Ready Made</li>
                            <li class="active">Pre Order</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                      
                      <?php
$ret=mysqli_query($con,"select * from products where category='$cid'");
$num=mysqli_num_rows($ret);
if($num>0)
{
while ($row=mysqli_fetch_array($ret)) 
{?> 
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="thrift" width="180" height="300">
                                <div class="sale">Sale</div>
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <?php if($row['productAvailability']=='In Stock'){?>

                                    <li class="w-icon active"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"><i class="icon_bag_alt"></i></a></li>
                                    

                                    <li class="quick-view"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">+ Add to Cart</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    <?php } else {?>
                                    
                                    <li class="quick-view"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">+ OUT OF STOCK</a></li>
                                    <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">Luch FabRick</div>
                                <a href="#">
                                    <h5><?php echo htmlentities($row['productName']);?></h5>
                                </a>
                                <div class="product-price">
                                    &#8358;<?php echo htmlentities($row['productPrice']);?>
                                    <span>&#8358;<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                </div>
                            </div>
                        </div>
                            <?php } } else {?>
    
        <div class="col-sm-6 col-md-4 wow fadeInUp"> <h3>No Product Found</h3>
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
</body>

</html>
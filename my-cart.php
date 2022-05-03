<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){
        if(!empty($_SESSION['cart'])){
        foreach($_POST['quantity'] as $key => $val){
            if($val==0){
                unset($_SESSION['cart'][$key]);
            }else{
                $_SESSION['cart'][$key]['quantity']=$val;

            }
        }
            echo "<script>alert('Your Cart hasbeen Updated');</script>";
        }
    }
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
    {

if(!empty($_SESSION['cart'])){
        foreach($_POST['remove_code'] as $key){
            
                unset($_SESSION['cart'][$key]);
        }
            echo "<script>alert('Your Cart has been Updated');</script>";
    }
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{
    
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

    $quantity=$_POST['quantity'];
    $pdd=$_SESSION['pid'];
    $value=array_combine($pdd,$quantity);


        foreach($value as $qty=> $val34){



mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','$qty','$val34')");
header('location:payment-method.php');
}
}
}

// code for billing address updation
    if(isset($_POST['update']))
    {
        $baddress=$_POST['billingaddress'];
        $bstate=$_POST['bilingstate'];
        $bcity=$_POST['billingcity'];
        $bpincode=$_POST['billingpincode'];
        $query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
        if($query)
        {
echo "<script>alert('Billing Address has been updated');</script>";
        }
    }


// code for Shipping address updation
    if(isset($_POST['shipupdate']))
    {
        $saddress=$_POST['shippingaddress'];
        $sstate=$_POST['shippingstate'];
        $scity=$_POST['shippingcity'];
        $spincode=$_POST['shippingpincode'];
        $query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
        if($query)
        {
echo "<script>alert('Shipping Address has been updated');</script>";
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
    <title>Luch FabRick | Shopping Cart</title>

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
    </header>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.php">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <form name="cart" method="post">    
<?php
if(!empty($_SESSION['cart'])){
    ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
            foreach($_SESSION['cart'] as $id => $value){
            $sql .=$id. ",";
            }
            $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
            $query = mysqli_query($con,$sql);
            $totalprice=0;
            $totalqunty=0;
            if(!empty($query)){
            while($row = mysqli_fetch_array($query)){
                $quantity=$_SESSION['cart'][$row['id']]['quantity'];
                $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
                $totalprice += $subtotal;
                $_SESSION['qnty']=$totalqunty+=$quantity;

                array_push($pdtid,$row['id']);
//print_r($_SESSION['pid'])=$pdtid;exit;
    ?>
                                <tr>
                                    <td class="cart-pic first-row"><img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" height="170px" width="170px"  alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5><?php echo $row['productName'];$_SESSION['sid']=$pd; ?></h5>
                                    </td>
                                    <td class="p-price first-row"><?php echo "&#8358;"." ".$row['productPrice']; ?>.00</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                        <input typtype="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row"><?php echo "&#8358;"." ".$row['shippingCharge']; ?>.00</td>
                                    <td class="total-price first-row">&#8358;<?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00</td>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>
                                </tr>
                                <?php } }
$_SESSION['pid']=$pdtid;
                ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-buttons">
                                <a href="index.php" class="primary-btn continue-shop">Continue shopping</a>
                                <input type="submit" name="submit" value="Update shopping cart" class="btn btn-primary">
                                <!-- <a class="primary-btn up-cart" type="submit" name="submit">Update cart</a> -->
                            </div>
                    <div class="row">

                        <div class="col-lg-4">
                            
                            
                            <!-- shipping -->
                                
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    <span class="estimate-title">Shipping Address</span>
                </th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <div class="form-group">
<?php
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
?>

<div class="form-group">
                        <label class="info-title" for="Billing Address">Billing Address<span>*</span></label>
                        <textarea class="form-control unicase-form-control text-input"  name="billingaddress" required="required"><?php echo $row['billingAddress'];?></textarea>
                      </div>



                        <div class="form-group">
                        <label class="info-title" for="Billing State ">Billing State  <span>*</span></label>
             <input type="text" class="form-control unicase-form-control text-input" id="bilingstate" name="bilingstate" value="<?php echo $row['billingState'];?>" required>
                      </div>
                      <div class="form-group">
                        <label class="info-title" for="Billing City">Billing City <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input" id="billingcity" name="billingcity" required="required" value="<?php echo $row['billingCity'];?>" >
                      </div>
 <div class="form-group">
                        <label class="info-title" for="Billing Pincode">Billing Pincode <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input" id="billingpincode" name="billingpincode" required="required" value="<?php echo $row['billingPincode'];?>" >
                      </div>


                      <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
            
                    <?php } ?>
        
                        </div>
                    
                    </td>
                </tr>
        </tbody>
    </table>

                            <!-- shipping ends -->
                        </div>

                        <!-- billing -->
                        <div class="col-lg-4">
                            
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    <span class="estimate-title">Billing Address</span>
                </th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <div class="form-group">
        <?php
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
?>

<div class="form-group">
                        <label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
                        <textarea class="form-control unicase-form-control text-input"  name="shippingaddress" required="required"><?php echo $row['shippingAddress'];?></textarea>
                      </div>



                        <div class="form-group">
                        <label class="info-title" for="Billing State ">Shipping State  <span>*</span></label>
             <input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" value="<?php echo $row['shippingState'];?>" required>
                      </div>
                      <div class="form-group">
                        <label class="info-title" for="Billing City">Shipping City <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required" value="<?php echo $row['shippingCity'];?>" >
                      </div>
 <div class="form-group">
                        <label class="info-title" for="Billing Pincode">Shipping Pincode <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shippingPincode'];?>" >
                      </div>


                      <button type="submit" name="shipupdate" class="btn-upper btn btn-primary checkout-page-button">Update</button>
                    <?php } ?>

        
                        </div>
                    
                    </td>
                </tr>
        </tbody>
    </table>

                        </div>
                        <!-- billing ends -->

                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>&#8358;<?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span></li>
                                    <li class="cart-total">Total <span>&#8358;<?php echo $_SESSION['tp']="$totalprice". ".00"; ?></span></li>
                                </ul>
                                <button type="submit" name="ordersubmit" class="btn btn-dark">PROCEED TO CHEKOUT</button>
                            </div>
                        </div>


                    </div>
                    <?php } else {
echo "Your shopping Cart is empty";
        }?>
                </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <?php include('includes/footer.php');?>
    <!-- Footer Section End -->

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
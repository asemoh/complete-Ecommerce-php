<?php 

 if(isset($_Get['action'])){
        if(!empty($_SESSION['cart'])){
        foreach($_POST['quantity'] as $key => $val){
            if($val==0){
                unset($_SESSION['cart'][$key]);
            }else{
                $_SESSION['cart'][$key]['quantity']=$val;
            }
        }
        }
    }
?>

<div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="./index.php">
                                <img src="img/loggo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <form name="search" method="post" action="search-result.php" class="form">
                            
                            <div class="input-group">
                                <input type="text" name="product" placeholder="What do you need?">
                                <button type="submit" name="search" ><i class="ti-search"></i></button>
                            </div>
                        </form>
                        </div>
                    </div>

                <?php
if(!empty($_SESSION['cart'])){
    ?>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            
                            <!-- cart starts -->
    
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span><?php echo $_SESSION['qnty'];?></span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                <?php
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

    ?>
                                                <tr>
                                                    <td class="si-pic"><img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" height="70px" width="70px" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>&#8358;<?php echo ($row['productPrice']+$row['shippingCharge']); ?> x <?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></p>
                                                            <h6><?php echo $row['productName']; ?></h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close"></i>
                                                    </td>
                                                </tr>
                                               <?php } }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>&#8358;<?php echo $_SESSION['tp']="$totalprice". ".00"; ?></h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="my-cart.php" class="primary-btn view-card">VIEW CART</a>
                                        <!-- <a href="#" class="primary-btn checkout-btn">CHECK OUT</a> -->
                                    </div>
                                </div>
                            </li>
                            <!-- cart ends -->
                            <li class="cart-price">&#8358;<?php echo $_SESSION['tp']; ?></li>
                        </ul>
                    </div>
                        <?php } else { ?>


<div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                           
                            <li class="cart-icon"><a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span>0</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <p>Your Shopping Cart is Empty</p>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>&#8358;00.00</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="index.php" class="primary-btn view-card">Continue Shopping</a>
                                        <!-- <a href="#" class="primary-btn checkout-btn">CHECK OUT</a> -->
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">&#8358;00.00</li>
                        </ul>
                    </div>
                    <?php }?>



                </div>
            </div>
        </div>
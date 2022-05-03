<?php 
//session_start();

?>
<div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <?php if(strlen($_SESSION['login']))
    {   ?>
                    <div class="mail-service">
                        <i class=" fa fa-user"></i>
                        Welcome - <?php echo htmlentities($_SESSION['username']);?>
                    </div> <?php } ?>
                     <div class="phone-service">
                        
                        <a href="my-account.php" style="color: black !important;"><i class="icon fa fa-user"></i>My Account</a>
                    </div> 
                </div>
                <div class="ht-right">
                    <?php if(strlen($_SESSION['login'])==0)
    {   ?>
                    <a href="login.php" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    <?php }
else{ ?>
    <a href="logout.php" class="login-panel"><i class="fa fa-user"></i>Logout</a>
                    <?php } ?>
                    
                    <div class="top-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-instagram"></i></a>
                       </div>
                </div>
            </div>
        </div>
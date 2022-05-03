<div class="nav-item">
            <div class="container">
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./shop.php">Shop</a></li>
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
                        <li><a href="./contact.php">Contact</a></li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
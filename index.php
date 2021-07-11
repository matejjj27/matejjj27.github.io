<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebSite</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="navbar">
        <div class="logo">
            <a href="index.php"><img src="images/Slogo1.jpg" width="125px"></a>
        </div>
        
        <nav>
            <ul id="MenuItems">
                <li><a href="index.php">Home</a></li>

                <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<li><a href='products.php'>Products</a></li>";
                        echo "<li><a href='./includes/logout.php'>Log out</a></li>";
                    }
                    else if (isset($_SESSION["useruidA"])) {
                        echo "<li><a href='adminedit.php'>Edit</a></li>";
                        echo "<li><a href='./includes/logout.php'>Log out</a></li>";
                    }
                    else {
                        echo "<li><a href='products.php'>Products</a></li>";
                        echo "<li><a href='admin.php'>Admin</a></li>";
                        echo "<li><a href='signup.php'>Sign up</a></li>";
                        echo "<li><a href='login.php'>Log in</a></li>";
                        echo '<li><a href="cart.php" class="nav-link"> <i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a></li>';
                    }
                ?>

            </ul>
        </nav>
        
    </div>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h1>Give Your Workout<br>A New Style</h1>
                <p class="color-black">Success is not always about greatness. It is about consistency.
                 Consistent<br>hard work gains success. Greatness will come.</p>
                 <br>
                <a href="products.php"><button class="btn">Explore now &#8594;</button></a> <br> <br>
            </div>
            <div class="col-2">
                <img src="images/image1.png">
            </div>
        </div>
    </div>
</div>

<!--------footer--------->

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3>Download Our App</h3>
                <p>Download Our APP for Android and IOS mobile phone</p>
                <div class="app-logo">
                    <a href="https://play.google.com/store"><img src="images/play-store.png"></a>
                    <a href="https://www.apple.com/app-store/"><img src="images/app-store.png"></a>
                </div>
            </div>
            <div class="footer-col-2">
                <img src="images/Slogo1.jpg">
                <p>Our Purpose is to Sustainably Make the Pleasure and
                     Benefits of Sports Accessible to the Many</p>
            </div>
            
            <div class="footer-col-4">
                <h3>Follow us</h3>
                <ul>
                    <a href="https://www.facebook.com/"> <li>Facebook</li></a>
                    <a href="https://twitter.com/home"> <li>Twitter</li></a>
                    <a href="https://www.instagram.com/"> <li>Instagram</li></a>
                    <a href="https://www.youtube.com/"> <li>YouTube</li></a>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright">Copyright 2021 - IBT Project</p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
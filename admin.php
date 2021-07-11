<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
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
                    <li><a href="products.php">Products</a></li>

                <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<li><a href='./includes/logout.php'>Log out</a></li>";
                    }
                    else {
                        echo "<li><a href='admin.php'>Admin</a></li>";
                        echo "<li><a href='signup.php'>Sign up</a></li>";
                        echo "<li><a href='login.php'>Log in</a></li>";
                    }
                ?>

                </ul>
            </nav>
            <a href="cart.php" class="nav-link"> <i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </div>

<!------ login page ------->

<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="images/image1.png" width="100%">
            </div>

            <div class="col-2">
                <div class="form-container">
                    <div class="form-btn">
                        <h5>Admin Login<h5>
                        <hr id="Indicator">
                    </div>

                    <form id="LoginForm" action="includes/admin.php" method="POST">
                        <input type="text" name="uidA" placeholder="Username/Email">
                        <input type="password" name="pwdA" placeholder="Password">
                        <select name="utype" class="form-control">
                            <option selected value="admin">Admin</option>
                        </select>
                        <button type="submit" name="submit" class="btn">Admin Log in</button>
                    </form>

                    <style>
                        .extra {
                        padding-top: 15px;
                        color: #ff523b;
                        font-weight: bold;
                        }
                    </style>

                    <?php
                        if (isset($_GET["error"])) {
                            if($_GET["error"] == "emptyinput") {
                                echo "<p class='mt-2'>Fill in all fields!</p>"; 
                            }
                            else if ($_GET["error"] == "wronglogin") {
                                echo "<p class='mt-2'>Invalid Username or Password!</p>";
                            }
                        }
                    ?>

                </div>
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
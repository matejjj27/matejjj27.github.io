<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header"></div>
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

<div class="header">

<div class="container">
    <div id="message"></div>
    <br>
    <div class="row">

    <?php
    include './includes/dbh.php';

    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()):
    ?>

    <div class="col-lg-3">
        <div class="card-deck">
            <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['products_image'] ?>" class="card-img-top" height = "250">
                <div class="car-body p-1">
                    <h4 class="card-title text-center text-info"><?= $row['products_name'] ?></h4>
                    <h6 class="text-center width-15"><?= $row['products_description'] ?></h6>
                    <h5 class="card-text text-center text-danger"><?= number_format($row['products_price'],2) ?> $</h5>
                </div>
                <div class="card-footer p-1">
                    <form action="" class="form-submit">
                        <input type="hidden" class="pid" value="<?= $row['products_id'] ?>">
                        <input type="hidden" class="pname" value="<?= $row['products_name'] ?>">
                        <input type="hidden" class="pprice" value="<?= $row['products_price'] ?>">
                        <input type="hidden" class="pdesc" value="<?= $row['products_description'] ?>">
                        <input type="hidden" class="pimage" value="<?= $row['products_image'] ?>">
                        <input type="hidden" class="pimage2" value="<?= $row['products_image2'] ?>">
                        <input type="hidden" class="pimage3" value="<?= $row['products_image3'] ?>">
                        <input type="hidden" class="pimage4" value="<?= $row['products_image4'] ?>">
                        <input type="hidden" class="pcode" value="<?= $row['code'] ?>">
                        <button class="btn btn-info btn-block addItemBtn">
                        <i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php endwhile; ?>
    
    </div>
</div>
</div>
<br>

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

<script type="text/javascript">
$(document).ready(function(){
    $(".addItemBtn").click(function(e){
        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var pid = $form.find(".pid").val();
        var pname = $form.find(".pname").val();
        var pprice = $form.find(".pprice").val();
        var pdesc = $form.find(".pdesc").val();
        var pimage = $form.find(".pimage").val();
        var pimage2 = $form.find(".pimage2").val();
        var pimage3 = $form.find(".pimage3").val();
        var pimage4 = $form.find(".pimage4").val();
        var pcode = $form.find(".pcode").val();

        $.ajax({
            url: './includes/action.php',
            method: 'post',
            data: {pid:pid, pname:pname, pprice:pprice, pdesc:pdesc, pimage:pimage, pimage2:pimage2, pimage3:pimage3, pimage4:pimage4, pcode:pcode},
            
            success:function(response){
                $("#message").html(response);
                load_cart_item_number();
            }
        });
    });

    load_cart_item_number();

    function load_cart_item_number(){
        $.ajax({
            url: './includes/action.php',
            method: 'get',
            data: {cartItem:"cart_item"},
            success:function(response){
                $("#cart-item").html(response);
            }
        });
    }
});
</script>

</body>
</html>
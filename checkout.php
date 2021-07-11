<?php
    session_start();

    require './includes/dbh.php';

    $grand_total = 0;
    $allItems = '';
    $items = array();

    $sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()){
        $grand_total += $row['total_price'];
        $items[] = $row['ItemQty'];
    }

    $allItems = implode(", ", $items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
                ?>
                    
                </ul>
            </nav>
            <a href="cart.php" class="nav-link"> <i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
                <h4 class="text-center text-info p-2">Complete your order</h4>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h6 class="lead"><b>Product(s): </b> <?= $allItems; ?></h6>
                    <h6 class="lead"><b>Delivery Charge: </b>Free</h6>
                    <h5><b>Total Ammount Payable: </b><?= number_format($grand_total,2); ?><i class="fas fa-dollar-sign"></i> &nbsp;&nbsp;</h5>
                </div>
                <form action="order" method="post" id="placeOrder">
                    <input type="hidden" name="products" value="<?= $allItems; ?>">
                    <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">

                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone" required>
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="form-control" cols="10" rows="2" placeholder="Enter Delivery Address Here..."></textarea>
                    </div>
                    
                    <h6 class="text-center lead">Select Payment Method</h6>
                    <div class="form-group">
                        <select name="pmode" class="form-control">
                            <option value="cod">Cash on Delivery</option>
                            <option value="cards">Debit/Credit Card</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
                    </div>

                </form>
                </form>
                </form>
                </form>
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
  
    $("#placeOrder").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: './includes/action.php',
            method: 'post',
            data: $('form').serialize()+"&action=order",
            success:function(response){
                $("#order").html(response);
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
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
    <div class="row justify-content-center">
        <div class="col-lg-10">
        <div class="alert alert-success alert-dismisable mt-3" style="display:<?php if (isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];} else {echo 'none'; unset($_SESSION['showAlert']);} ?>" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php if (isset($_SESSION['message'])){echo $_SESSION['message'];} unset($_SESSION['showAlert']); ?></strong>
        </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <td colspan="7">
                            <h4 class="text-center text-info m-0">Products in your Cart</h4>
                        </td>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th><a href="./includes/action.php?clear=all" class="badge-danger badge p-1"
                         onclick="return confirm('Are you sure you want to clear your cart?');"> <i class="fas fa-trash"></i>&nbsp;Clear Cart</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php
                        require './includes/dbh.php';
                        $stmt = $conn->prepare("SELECT * FROM cart");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $grand_total = 0;
                        while($row = $result->fetch_assoc()):
                        ?>
                        
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                            <td><img src="<?= $row['product_image'] ?>" width="50"></td>
                            <td><?= $row['product_name']?></td>
                            <td><i class="fas fa-dollar-sign"></i>&nbsp;<?= number_format($row['product_price'],2) ?></td>
                            <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                            <td><input type="number" class="form-control itemQty"
                             value="<?=$row['qty']?>" style="width:75px;"></td>
                             <td><i class="fas fa-dollar-sign"></i>&nbsp;<?= number_format($row['total_price'],2) ?></td>
                             <td>
                                <a href="./includes/action.php?remove=<?= $row['id'] ?>" 
                                class="text-danger lead" onclick= "return confirm('Are you sure you want to remove this item from your cart?')"><i class="fas fa-trash-alt"></i></a>
                             </td>
                        </tr>
                        <?php 
                            $grand_total += $row['total_price']; ?>

                        <?php endwhile; ?>
                        <tr>
                            <td colspan="3">
                                <a href="products.php" class="btn btn-success">
                                <i class="fas fa-cart-plus">&nbsp;</i> Continue shopping</a>
                            </td>
                            <td colspan="2"><b>Grand Total</b></td>
                            <td><b><i class="fas fa-dollar-sign"></i>&nbsp;
                            <?= number_format($grand_total,2) ?></b></td>
                            <td>
                                <a href="checkout.php" class="btn btn-info <?php if ($grand_total<1 || !(isset($_SESSION['useruid']))){ ?> disabled <?php   } ?>"  ><i class="far fa-credit-card"></i>&nbsp; Checkout</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

<script type="text/javascript">
$(document).ready(function(){
    
    $(".itemQty").on('change', function(){
        var $el = $(this).closest('tr');

        var pid = $el.find(".pid").val();
        var pprice = $el.find(".pprice").val();
        var qty = $el.find(".itemQty").val();
        location.reload(true);

        $.ajax({
            url: './includes/action.php',
            method: 'post',
            cache: false,
            data: {qty:qty, pid:pid, pprice:pprice},
            success: function(response){
                console.log(response);
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
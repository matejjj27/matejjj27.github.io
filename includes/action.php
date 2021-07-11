<?php
session_start();

require 'dbh.php';

if(isset($_POST['pid'])){
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pdesc = $_POST['pdesc'];
    $pimage = $_POST['pimage'];
    $pimage2 = $_POST['pimage2'];
    $pimage3 = $_POST['pimage3'];
    $pimage4 = $_POST['pimage4'];
    $pcode = $_POST['pcode'];
    $pqty = 1;

    $stmt = $conn->prepare("SELECT code FROM cart WHERE code=?");
    $stmt->bind_param("s",$pcode);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['code'];

    if(!$code){
        $query = $conn->prepare("INSERT INTO cart (product_name, product_price,
         product_description, product_image, product_image2,
         product_image3, product_image4, qty, total_price, code) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param("sssssssiss",$pname, $pprice, $pdesc, $pimage,
        $pimage2, $pimage3, $pimage4, $pqty, $pprice, $pcode);
        $query->execute();

        echo '<div class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Item added to your cart!</strong>
        </div>';
    }
    else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Item already added to your cart!</strong>
        </div>';
    }
}

if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $stmt = $conn->prepare("SELECT * FROM cart");
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}

if(isset($_GET['remove'])){
    $id = $_GET['remove'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart';
    header('location: ../cart.php');
}
if(isset($_GET['removeA'])){
    $id = $_GET['removeA'];

    $stmt = $conn->prepare("DELETE FROM products WHERE products_id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the products';
    header('location: ../adminedit.php');
}

if(isset($_GET['clear'])){
    $stmt = $conn->prepare("DELETE FROM cart");
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Items removed from the cart';
    header('location: ../cart.php');
}

if(isset($_POST['qty'])){
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];

    $tprice = $qty*$pprice;

    $stmt = $conn->prepare("UPDATE cart SET qty=?, total_price=? WHERE id=?");

    $stmt->bind_param("isi", $qty, $tprice, $pid);
    $stmt->execute();
}

if(isset($_POST['action']) && isset($_POST['action']) == 'order'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];

    $data = '';

    $stmt = $conn->prepare("INSERT INTO orders 
    (namee, email, phone, adress, pmode, products, ammount_paid) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $address, $pmode, $products, $grand_total);
    $stmt->execute();
    $data .= '<div class="text-center">
                <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
                <h2 class="text-success">Your Order is Placed Successfully!</h2>
                <h4 class="bg-danger text-light rounded p-2">Items Purchased: '.$products.'</h4>
                <h4>Your Name: '.$name.'</h4>
                <h4>Your Email: '.$email.'</h4>
                <h4>Your Phone: '.$phone.'</h4>
                <h4>Total Ammount Paid: '.number_format($grand_total,2).'</h4>
                <h4>Payment Method: '.$pmode.'</h4>
             </div>';

        echo $data;
}

?>
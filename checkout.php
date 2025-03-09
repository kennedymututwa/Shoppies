<?php
    include 'connection.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }
    if(isset($_POST['order-btn'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $method  = mysqli_real_escape_string($conn, $_POST['method']);
        $size  = mysqli_real_escape_string($conn, $_POST['size']);
        $address = mysqli_real_escape_string($conn, 'flat no.' . $_POST['flate'] . ',' . $_POST['street'] . ',' . $_POST['city'] . ',' . $_POST['state'] . ',' . $_POST['country'] . ',' . $_POST['pin-code']);
        $placed_on = date('d-M-Y');
        $cart_total=0;
        $cart_product=array(); 
        $cart_query= mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    
        if(mysqli_num_rows($cart_query)>0){
            while($cart_item=mysqli_fetch_assoc($cart_query)){
                $cart_product[]=$cart_item['name'];
                $cart_total += $cart_item['price'];
            }
        }
        $total_product= implode(',',$cart_product); 
        $total_price = $cart_total; 
        mysqli_query($conn, "INSERT INTO `order`(`user_id`, `name`, `number`,  `email`, `method`, `address`, `total_product`, `total_price`, `placed_on`, `size`) VALUES('$user_id','$name','$number', '$email', '$method', '$address', '$total_product', '$total_price', '$placed_on', '$size')");
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");
        $message[]='order placed successfully';
        header('location:checkout.php'); 
    }
?>
<style type="text/css">
    <?php
        include 'main.css';
    ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <title>PrintnPlay</title>
</head>
<body> 
    <?php include 'header.php'?>
    <div class="banner">
        <div class="detail">
            <h1>checkout</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis veniam asperiores </p>
            <a href="index.php"></a><span>checkout</span>
        </div>  
    </div>
    <div class="line"></div>
    <div class="checkout-form">
        <h1 class="title">payment process</h1>
        <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '
                        <div class="message">
                            <span>'.$message.'</span>
                            <i class="bi bi-x-circles" onclick="this.parentElement.remove()"></i>
                        </div>
                    ';
                }
            }
        ?>
        <div class="display-order">
            <?php
                $total=0;
                if(mysqli_num_rows($select_cart)){
                    while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                        $total += $fetch_cart['price'];
            ?>
            <div class="box-container">
                <div class="box">
                    <img src="image/<?php echo $fetch_cart['image'];?>">
                    <div><?= $fetch_cart['name'];?></div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            <span class="grand-total">Total amount Payable : $<?= $total; ?></span>
        </div>
        <form method="post">
            <div>   
                <label for="sze">Size:</label>
                <select name="size" id="size">
                    <option selected value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    <option value="Extra Large">Extra Large</option>
                </select><br>
            </div>
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="name" placeholder="enter your name">
            </div>
            <div class="input-field">
                <label>your number</label>
                <input type="text" name="number" placeholder="enter your number">
            </div>
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="email" placeholder="enter your email">
            </div>
            <div class="input-field">
                <label>Select payment menthod</label>
                <select name="method">
                    <option selected disabled>Select payment method</option>
                    <option value="COD">Cash on delivery</option>
                </select>
            </div>
            <div class="input-field">
                <label>Address line 1</label>
                <input type="text" name="flate" placeholder="e.g flate no">
            </div>
            <div class="input-field">
                <label>Address line 2</label>
                <input type="text" name="street" placeholder="e.g street name">
            </div>
            <div class="input-field">
                <label>city</label>
                <input type="text" name="city" placeholder="e.g New Delhi">
            </div>
            <div class="input-field">
                <label>State</label>
                <input type="text" name="state" placeholder="e.g Delhi">
            </div>
            <div class="input-field">
                <label>country</label>
                <input type="text" name="country" placeholder="country">
            </div>
            <div class="input-field">
                <label>pin code</label>
                <input type="text" name="pin-code" placeholder="e.g 110033">
            </div>
            <input type="submit" name="order-btn" class="btn" value="order now">
        </form>
    </div>
    <div class="line"></div>
    <?php include 'footer.php'?>
    <script type="text/javascript" src="script2.js"></script>
</body>
</html>
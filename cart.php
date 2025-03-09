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
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE id='$delete_id'") or die('query failed');
        header('location:cart.php');
    }
    if(isset($_GET['delete_all'])){
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'") or die('query failed');
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
            <h1>My Cart</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis veniam asperiores </p>
            <a href="index.php"></a><span>Cart</span>
        </div>  
    </div>
    <div class="line"></div>
    <section class="shop">
        <h2 class="title">Product Added In Cart</h2>
        <?php
          if(isset($message)) {
            foreach($message as $message){
              echo '
                <div class="message">
                  <span>'.$message.'</span>
                  <i class="bx bx-x-circle" onclick="this.parentNode.remove()"></i>
                  </div>
              ';
            }        
          }
        ?>
        <div class="box-container">
            <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_cart)>0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>
            <div class="box">
                <div class="icon">
                    <a href="view_page.php?pid=<?php echo $fetch_cart['id'];?>" class="bi bi-eye-fill"></a>
                    <a href="cart.php?delete=<?php echo $fetch_cart['id'];?>" class="bi bi-x" onclick="return confirm('Do you want to delete this product from cart?')"></a>
                </div>
              <img src="image/<?php echo $fetch_cart['image'];?>">
              <div class="price">$<?php echo $fetch_cart['price'];?></div>
              <div class="name"><?php echo $fetch_cart['name'];?></div>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty"> no product added to cart yet.</p>';
            }
            $select_cart_prices = mysqli_query($conn, "SELECT price FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');
                $total_price = 0; 
                while ($row = mysqli_fetch_assoc($select_cart_prices)) {
                    $total_price += $row['price'];
                }
            ?>
        </div>
        <div>
            <a href="cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all item in your cart')">delete all</a>
        </div>
        <div class="cart_total">
            <p>Total amount payable : <span><?php echo $total_price; ?>/-</span></p>
            <a href="shop.php" class="btn">continue shoping</a>
            <a href="checkout.php" class="btn <?php echo ($total_price>1)?'':'disabled'?>" onclick="return confirm('do you want to checkout')">proceed to checkout</a>
        </div>
        <div class="line2"></div>
    </section>
    <div class="line"></div>
    <?php include 'footer.php'?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
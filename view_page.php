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
    if(isset($_POST['add_to_cart'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
                            
        $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id ='$user_id'") or die('query failed');
        if(mysqli_num_rows($cart_num)>0){
        $message[]='Product already exists in cart';
        }else{
            mysqli_query($conn, "INSERT INTO `cart` (`user_id`,`pid`,`name`,`price`,`image`) VALUES ('$user_id','$product_id','$product_name','$product_price','$product_image')");
            $message[]='Product successfuly added in cart';
        }
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
            <h1>product detail</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis veniam asperiores </p>
            <a href="index.php"></a><span>shop</span>
        </div>  
    </div>
    <div class="line"></div>
    <section class="view_page">
        <h2 class="title">Shop Best Seller</h2>
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
              if(isset($_GET['pid'])){
                $pid = $_GET['pid'];
                $select_products = mysqli_query($conn, "SELECT * FROM `product` WHERE id = '$pid'") or die('query failed');
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_products =mysqli_fetch_assoc($select_products)){

            ?>
            <form method="post" >
              <img src="image/<?php echo $fetch_products['image'];?>">
              <div class="detail">
                <div class="price">$<?php echo $fetch_products['price'];?></div>
                <div class="name"><?php echo $fetch_products['name'];?></div>
                <div class="detail"><?php echo $fetch_products['product_detail'];?></div>
                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'];?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">
                <div class="icon">
                    <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                </div>
              </div>
            </form>
            <?php
                        }
                    }
                }
            ?>
        </div>
    </section>
    <?php include 'footer.php'?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
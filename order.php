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
            <h1>Order</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis veniam asperiores </p>
            <a href="index.php"></a><span>Order</span>
        </div>  
    </div>
    <div class="line"></div>
    <div class="order-section">
        <div class="box-container">
            <h1 class="title">Order</h1><br>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_order)>0){
                    while($fetch_order = mysqli_fetch_assoc($select_order)){
            ?>
            <div class="box">
                <p>placed on: <span><?php echo $fetch_order['placed_on'];?></span></p>
                <p>name: <span><?php echo $fetch_order['name'];?></span></p>
                <p>number: <span><?php echo $fetch_order['number'];?></span></p>
                <p>email: <span><?php echo $fetch_order['email'];?></span></p>
                <p>address: <span><?php echo $fetch_order['placed_on'];?></span></p>
                <p>payment method: <span><?php echo $fetch_order['method'];?></span></p>
                <p>your order: <span><?php echo $fetch_order['total_product'];?></span></p>
                <p>total price: <span><?php echo $fetch_order['total_price'];?></span></p>

            </div>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>no order placed yet<p>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
    <div class="line2"></div>
    <div class="order-section">
        <div class="box-container">
        <h1 class="title">Customize Order</h1><br>
            <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `customize` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_order)>0){
                    while($fetch_order = mysqli_fetch_assoc($select_order)){
            ?>
            <div class="box">
                <p>placed on: <span><?php echo $fetch_order['placed_on'];?></span></p>
                <p>name: <span><?php echo $fetch_order['name'];?></span></p>
                <p>number: <span><?php echo $fetch_order['number'];?></span></p>
                <p>email: <span><?php echo $fetch_order['email'];?></span></p>
                <p>address: <span><?php echo $fetch_order['placed_on'];?></span></p>
                <p>payment method: <span><?php echo $fetch_order['method'];?></span></p>
                <p>total price: <span><?php echo $fetch_order['price'];?></span></p>

            </div>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>no order placed yet<p>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
    <?php include 'footer.php'?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
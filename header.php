<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icons link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class ="flex">
            <a href="admin_pannel.php" class= "logo"><img src="logo1.png" width ="175rem"></a>
            <nav class="navbar">
                <a href="index.php">home</a>
                <a href="shop.php">Shop</a>
                <a href="customize.php">customize</a>
                <a href="order.php">order</a>
                <a href="contact.php">contact</a>
                <a href="about.php">about us</a>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    $cart_num_row = mysqli_num_rows($select_cart);
                ?>
                <a href="cart.php"><i class="bi bi-cart"><sup><?php echo $cart_num_row; ?></sup></i></a>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['user_name'];?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']?></span></p>
                <form method="post">
                    <button type="submit" name="logout" class='logout-btn'>logout</button>
                </form>
            </div>
        </div>
    </header>
</body>
</html>
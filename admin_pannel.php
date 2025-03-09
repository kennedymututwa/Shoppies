<?php
    include 'connection.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icons link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>admin panel</title>
</head>
<body>
    <?php include('admin_header.php'); ?>
    <div class="line4"></div>
    <section class="dashboard">
        <h1 class="title">Overview</h1>
        <div class="box-container">
            <div class="box">
            <?php
                $order_query = "SELECT SUM(total_price) AS order_total FROM `order`";

                $customize_query = "SELECT SUM(price) AS customize_total FROM `customize`";

                $order_result = mysqli_query($conn, $order_query);
                $customize_result = mysqli_query($conn, $customize_query);

                $order_row = mysqli_fetch_assoc($order_result);
                $customize_row = mysqli_fetch_assoc($customize_result);

                $total_price = $order_row['order_total'] + $customize_row['customize_total'];

                echo "Total Price: $" . $total_price;
            ?>
                <h3>$ <?php echo $total_price; ?>/-</h3>
                <p>total pending</p>
            </div>
            <div class="box">
                <?php
                $select_order = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
                $num_of_orders = mysqli_num_rows($select_order);
            ?>
            <h3><?php echo $num_of_orders; ?></h3>
            <p>Order placed</p>
        </div>
        <div class="box">
            <?php
                $select_product = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
                $num_of_product = mysqli_num_rows($select_product);
            ?>
            <h3><?php echo $num_of_product; ?></h3>
            <p>product added</p>
        </div>
        <div class="box">
            <?php
                $select_user = mysqli_query($conn, "SELECT * FROM `user`") or die('query failed');
                $num_of_user = mysqli_num_rows($select_user);
            ?>
            <h3><?php echo $num_of_user; ?></h3>
            <p>Total users</p>
        </div>
        <div class="box">
            <?php
                $select_admin = mysqli_query($conn, "SELECT * FROM `admin`") or die('query failed');
                $num_of_admin = mysqli_num_rows($select_admin);
            ?>
            <h3><?php echo $num_of_admin; ?></h3>
        <p>Total admin</p>
        </div>
        <div class="box">
            <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `user`") or die('query failed');
                $num_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?php echo $num_of_users; ?></h3>
        <p>Total registered users</p>
        </div>
        <div class="box">
            <?php
                $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                $num_of_message = mysqli_num_rows($select_message);
            ?>
            <h3><?php echo $num_of_message; ?></h3>
        <p>Total message</p>
        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
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
    
    ///deleting product from database
    if(isset($_GET['delete'])){
        $delete_id = intval($_GET['delete']);
        
        mysqli_query($conn, "DELETE FROM `order` WHERE id='$delete_id'") or die('query failed');
        $message[] = 'Order removed successfully';
        header('location: admin_order.php');
    }
    if(isset($_POST['update_order'])){
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];

        mysqli_query($conn, "UPDATE `order` SET order_status = '$update_payment' WHERE id='$order_id' ") or die('query failed');
    }

    ///deleting product from database
    if(isset($_GET['customize-delete'])){
        $delete_id = intval($_GET['customize-delete']);
        
        mysqli_query($conn, "DELETE FROM `customize` WHERE id='$delete_id'") or die('query failed');
        $message[] = 'Order removed successfully';
        header('location: admin_order.php');
    }

    if(isset($_POST['update_customize-order'])){
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];

        mysqli_query($conn, "UPDATE `customize` SET order_status = '$update_payment' WHERE id='$order_id' ") or die('query failed');
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
    <title>admin pannel</title>
</head>
<body>
    <?php include('admin_header.php'); ?>
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
     <section class="order-container">
        <h1 class="title">Orders</h1>
        <div class="box-container">
            <?php
                $select_order =mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
                if(mysqli_num_rows($select_order)>0){
                    while($fetch_order =mysqli_fetch_assoc($select_order)){
            ?>
            <div class="box">
                <p>User name: <span><?php echo $fetch_order['name']; ?></span></p>
                <p>user id: <span><?php echo $fetch_order['user_id']; ?></span></p>
                <p>placed on: <span><?php echo $fetch_order['placed_on']; ?></span></p>
                <p>number: <span><?php echo $fetch_order['number']; ?></span></p>
                <p>email: <span><?php echo $fetch_order['email']; ?></span></p>
                <p>size: <span><?php echo $fetch_order['size']; ?></span></p>
                <p>total price: <span><?php echo $fetch_order['total_price']; ?></span></p>
                <p>method: <span><?php echo $fetch_order['method']; ?></span></p>
                <p>address: <span><?php echo $fetch_order['address']; ?></span></p>
                <p>total product: <span><?php echo $fetch_order['total_product']; ?></span></p>
                <form method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_order['id']; ?>">
                    <select name="update_payment">
                            <option disabled selected><?php echo $fetch_order['order_status']; ?></option>
                            <option value="pending">Pending</option>
                            <option value="complete">Complete</option>
                    </select>
                    <input type="submit" name="update_order" value="update status" class="btn">
                    <a href="admin_order.php?delete=<?php echo $fetch_order['id'];?>" onclick="return confirm('delete this order');" class="delete">delete</a>
                </form>
            </div>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p> no order placed yet</p>
                        </div>
                    ';
                }
            ?>
        </div>
     </section>
     <section class="order-container">
        <h1 class="title">customize Orders</h1>
        <div class="box-container">
            <?php
                $select_order =mysqli_query($conn, "SELECT * FROM `customize`") or die('query failed');
                if(mysqli_num_rows($select_order)>0){
                    while($fetch_order =mysqli_fetch_assoc($select_order)){
            ?>
            <div class="box order-box">
                <img src="image/customize/<?php echo $fetch_order['image'];?>">
                <p>User name: <span><?php echo $fetch_order['name']; ?></span></p>
                <p>user id: <span><?php echo $fetch_order['user_id']; ?></span></p>
                <p>placed on: <span><?php echo $fetch_order['placed_on']; ?></span></p>
                <p>number: <span><?php echo $fetch_order['number']; ?></span></p>
                <p>email: <span><?php echo $fetch_order['email']; ?></span></p>
                <p>size: <span><?php echo $fetch_order['size']; ?></span></p>
                <p>total price: <span><?php echo $fetch_order['price']; ?></span></p>
                <p>method: <span><?php echo $fetch_order['method']; ?></span></p>
                <p>address: <span><?php echo $fetch_order['address']; ?></span></p>
                <form method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_order['id']; ?>">
                    <select name="update_payment">
                            <option disabled selected><?php echo $fetch_order['order_status']; ?></option>
                            <option value="pending">Pending</option>
                            <option value="complete">Complete</option>
                    </select>
                    <input type="submit" name="update_customize-order" value="update status" class="btn">
                    <a href="admin_order.php?customize-delete=<?php echo $fetch_order['id'];?>" onclick="return confirm('delete this order');" class="delete">delete</a>
                    <br><a href="image/customize/<?php echo $fetch_order['image'];?>" class="btn" download="order_image_<?php echo $fetch_order['id'];?>">Download Image</a>
                </form>
            </div>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p> no order placed yet</p>
                        </div>
                    ';
                }
            ?>
        </div>
     </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
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
        
        mysqli_query($conn, "DELETE FROM `user` WHERE id='$delete_id'") or die('query failed');
        $message[] = 'User removed successfully';
        header('location: admin_user.php');
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
     <section class="message-container">
        <h1 class="title">total users account</h1>
        <div class="box-container">
            <?php
                $select_user =mysqli_query($conn, "SELECT * FROM `user`") or die('query failed');
                if(mysqli_num_rows($select_user)>0){
                    while($fetch_user =mysqli_fetch_assoc($select_user)){
            ?>
            <div class="box">
                <p>User id: <span><?php echo $fetch_user['id']; ?></span></p>
                <p>name: <span><?php echo $fetch_user['name']; ?></span></p>
                <p>email: <span><?php echo $fetch_user['email']; ?></span></p>
                <a href="admin_user.php?delete=<?php echo $fetch_user['id'];?>" onclick="return confirm('delete this user');" class="delete">delete</a>
            </div>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p> no user yet</p>
                        </div>
                    ';
                }
            ?>
        </div>
     </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
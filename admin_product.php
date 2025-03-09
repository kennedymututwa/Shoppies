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
    //adding product to database
    if(isset($_POST['add_product'])){
        $product_name = mysqli_real_escape_string($conn, $_POST['name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['price']);
        $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'image/'.$image;
        
        $select_product_name = mysqli_query($conn, "SELECT * FROM `product` WHERE name = '$product_name'") or die('query failed');
        if(mysqli_num_rows($select_product_name)>0){
            $message[] = 'product name aready exists';
        }else{
            $insert_product = mysqli_query($conn, "INSERT INTO `product`(`name`, `price`, `product_detail`, `image`) VALUES('$product_name', '$product_price', '$product_detail', '$image')") or die('query failed');
            if($insert_product){
               if($image_size > 2000000){
                    $message[] = 'image size is too big';
               }else{
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'product addded successfully';
                }
                }   
            }
        }
    ///deleting product from database
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $select_delete_image = mysqli_query($conn, "SELECT * FROM `product` WHERE id ='$delete_id'") or die('query failed');
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        unlink('image/'.$fetch_delete_image['image']);
    
        mysqli_query($conn, "DELETE FROM `product` WHERE id='$delete_id'") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE pid='$delete_id'") or die('query failed'); 
        // mysqli_query($conn, "DELETE FROM `wishlist` WHERE id='$delete_id'") or die('query failed');
    
        header('location: admin_products.php');
    }
    if(isset($_POST['update_product'])){
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_detail = $_POST['update_detail'];
        $update_image = $_FILES['update_image']['name'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'image/'.$update_image;

        $update_query = mysqli_query($conn, "UPDATE `product` SET `name`='$update_name', `price`='$update_price', `product_detail`='$update_detail', `image`='$update_image' WHERE `id`='$update_id'") or die('query failed');

        if($update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
            header('location:admin_product.php');
        }
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
        <div class="color">
        <section class="add_product form-container">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="input-field">
                    <label>Product name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="input-field">
                    <label>Product price</label>
                    <input type="text" name="price" required>
                </div>
                <div class="input-field">
                    <label>Product detail</label>
                    <textarea name="detail" required></textarea>
                </div>
                <div class="input-field">
                    <label>Product image</label>
                    <input type="file" name="image" accept="image/jpg, image.jpeg, image/png, image/webp" required>
                </div>
                <input type="submit" name="add_product" value="add product" class="btn">
            </form>
        </section>
        </div>
        <section class="show-product">
            <div class="box-container">
                <?php
                    $select_product = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
                    if(mysqli_num_rows($select_product) > 0){
                        while($fetch_product = mysqli_fetch_assoc($select_product)){
                ?>
                <div class="box">
                    <img src="image/<?php echo $fetch_product['image'];?>">
                    <p>price : $<?php echo $fetch_product['price'];?></p>
                    <h4><?php echo $fetch_product['name'];?></h4>
                    <details><?php echo $fetch_product['product_detail'];?></details>
                    <a href="admin_product.php?edit=<?php echo $fetch_product['id']; ?>" class="edit"> edit </a>
                    <a href="admin_product.php?delete=<?php echo $fetch_product['id']; ?>" class="delete" onclick="return confirm('want to delete this product');"> delete </a>
                </div>
                <?php
                            } 
                    }else {
                            echo '
                                <div class="empty">
                                    <p>No product added yet</p>
                                </div>
                            ';
                    }
                ?>
            </div>
        </section>
        <section class="update-container">
            <?php
                if(isset($_GET['edit'])){
                    $edit_id = $_GET['edit'];
                    $edit_query = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` = '$edit_id'") or die('query failed');
                    if(mysqli_num_rows($edit_query)>0){
                        while($fetch_edit = mysqli_fetch_assoc($edit_query)){
            ?>
            <form method="post" enctype="multipart/form-data">
                <img src="image/<?php echo $fetch_edit['image'];?>">
                <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id'];?>">
                <input type="text" name="update_name" value="<?php echo $fetch_edit['name'];?>">
                <input type="number" name="update_price" value="<?php echo $fetch_edit['price'];?>">
                <textarea name="update_detail"><?php echo $fetch_edit['product_detail'];?></textarea>
                <input type="file" name="update_image" accept="image/jpg, image/png, image/jpeg, image/webp">
                <input type="submit" name="update_product" value="update" class="edit">
                <input type="reset" name="" value="cancel" class="option-btn btn" id="close-form">
            </form>
            <?php
                        }
                    }echo "<script> document.querySelector('.update-container').style.display='block'</script>";
                }
            ?>
        </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
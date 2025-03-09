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
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'image/customize/' . $image;
        
        
        $customize_order = mysqli_query($conn, "INSERT INTO `customize`(`user_id`, `name`, `number`, `image`, `email`, `method`, `address`, `placed_on`, `size`) VALUES('$user_id','$name','$number', '$image', '$email', '$method', '$address', '$placed_on', '$size')");
        move_uploaded_file($image_tmp_name, $image_folder);   
        $message[]='order placed successfully';
        header('location:customize.php'); 
         
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>PrintnPlay</title>
</head>
<body> 
    <?php include 'header.php'?>
    <div class="banner">
        <div class="detail">
            <h1>customize</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis veniam asperiores </p>
            <a href="index.php"></a><span>checkout</span>
        </div>  
    </div>
    <div class="line"></div>
    <div class="checkout-form">
        <h2 class="title">Customize your Tee</h2>
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
        <form  method="post" enctype="multipart/form-data">
            <!-- Display uploaded photo -->
            <img id="teePreview" src="" alt="Uploaded photo"><br>
            <div class="input-field">
                    <label for="photo">Choose image</label>
                    <input type="file" name="image" id="image" accept="image/jpg, image.jpeg, image/png, image/webp" required>
            </div>
            
            <input type="button" class="btn2" id="previewButton" value="Preview">
            <!-- Other inputs -->
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
            <div>   
                <label for="sze">Size:</label>
                <select name="size" id="size">
                    <option selected value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    <option value="Extra Large">Extra Large</option>
                </select><br><br>
            </div>
            <h1 class="title">Price : $49</h1>
            <input type="submit" name="order-btn" class="btn" value="order now">
        </form>
    </div>
    <?php include 'footer.php';?>

    <script>
        $(document).ready(function(){
            $('#previewButton').click(function(){
                var input = $('#image')[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#teePreview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
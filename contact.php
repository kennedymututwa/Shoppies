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
    if(isset($_POST['submit-btn'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$message'") or die('query failed');
        if(mysqli_num_rows($select_message)>0){
            echo 'message already exists';
        }else{
            mysqli_query($conn, "INSERT INTO `message`(`user_id`,`name`,`email`,`number`,`message`) VALUES ('$user_id', '$name', '$email', '$number', '$message')") or die('query failed');
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
            <h1>Contact</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis veniam asperiores </p>
            <a href="index.php"></a><span>contact</span>
        </div>  
    </div>
    <div class="line"></div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="image/features/f2.png">
                <div>
                    <h1>Free & Fast Shipping</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/features/f3.png">
                <div>
                    <h1>Money Back & Guarantee</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/features/f6.png">
                <div>
                    <h1>24/7 online support</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="form-container">
        <h1>leave a message</h1>
        <form method="post">
            <div class="input-field">
                <label>your name</label><br>
                <input type="text" name="name">
            </div>
            <div class="input-field">
                <label>your email</label><br>
                <input type="text" name="email">
            </div>
            <div class="input-field">
                <label>number</label><br>
                <input type="text" name="number">
            </div>
            <div class="input-field">
                <label>your message</label><br>
                <textarea name="message"></textarea>
            </div>
            <button type="submit" name="submit-btn">Send message</button>
        </form>
    </div>
    <div clss="line"></div>
    <div clss="line2"></div>
    <div class="address">
        <h1 class="title">Our contact</h1>
        <div class="row">
            <div class="box">
                <i class="bi bi-map-fill"></i>
                <div>
                    <h4>address</h4>
                    <p>b4/98 marigold lane,
                        coral way,<br>New Delhi,
                        Delhi,110765</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-telephone-fill"></i>
                <div>
                    <h4>Phone number</h4>
                    <p>6541984556</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-envelope-fill"></i>
                <div>
                    <h4>Email</h4>
                    <p>admin@pnp.com</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line2"></div>
    <?php include 'footer.php'?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
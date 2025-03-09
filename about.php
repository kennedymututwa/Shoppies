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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <title>PrintnPlay</title>
</head>
<body> 
    <?php include 'header.php'?>
    <div class="banner">
        <div class="detail">
            <h1>About us</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis veniam asperiores </p>
            <a href="index.php"></a><span>about us</span>
        </div>  
    </div>
    <div class="line"></div>
    <div class="about-us">
        <div class="row">
            <div class="box">
                <div class="title">
                    <span>ABOUT OUR ONLINE STORE</span>
                    <h1>Hello with 5 Year of experience</h1>
                </div>
                <p>PNP Print On Demand Tee Store offers top-notch custom-printed apparel. With a wide array of designs and customization options, we cater to diverse styles and preferences. Our commitment to quality ensures vibrant colors and durability in every garment.</p>
            </div>
            <div class="img-box">
                <img src="image/banner/b4.jpg" >
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="features">
        <div class="title">
            <h1>Complete Customer Ideas</h1>
            <span>best features</span>
        </div>
        <div class="row">
            <div class="box">
                <img src="image/features/f6.png">
                <h2>24 X 7</h2>
                <p>Online SUpport 27/7</p>
            </div>
            <div class="box">
                <img src="image/features/f3.png">
                <h2>Money Back Guarantee</h2>
                <p>100% Secure Payment</p>
            </div>
            <div class="box">
                <img src="image/features/f4.png">
                <h2>Special Gift Card</h2>
                <p>Given The Perfect Gift</p>
            </div>
            <div class="box">
                <img src="image/features/f2.png">
                <h2>Wordwide Shipping</h2>
                <p>on order over $199</p>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="line"></div>
    <?php include 'footer.php'?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
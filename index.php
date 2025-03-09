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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <title>PrintnPlay</title>
</head>
<body>
    <?php include 'header.php';?>
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="image/hero4.png">
                <div class="slider-caption">
                    <span>Test our quality</span>
                    <h1>Organic material</h1>
                    <p>Experience the unparalleled quality of our prints crafted with organic materials.<br>Test our quality today and witness the exceptional clarity, color fidelity, and attention to detail that sets us apart.</p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="image/hero4.png">
                <div class="slider-caption">
                    <span>Test our quality</span>
                    <h1>Organic material</h1>
                    <p>Experience the unparalleled quality of our prints crafted with organic materials.<br></p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="image/hero4.png">
                <div class="slider-caption">
                    <span>Test our quality</span>
                    <h1>Organic material</h1>
                    <p></p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
        </div>
        <div class="control">
            <i class="bi bi-chevron-left prev"></i>
            <i class="bi bi-chevron-right next"></i>
        </div>
    </div>
     
    <div class="line2"></div>
    <div class="story">
        <div class="row">
            <div class="box">
                <span>Cuustomize your tee</span>
                <h1>Printing of great cloth since 2020</h1>
                <p>In the heart of town, "Print and Play Tee" thrived, a haven for creativity where Lily turned plain shirts into vibrant tales. From whimsical characters to bold slogans, each shirt bore a piece of its creator's soul, sparking joy and self-expression in all who entered.</p>
                <a href="shop.php" class="btn">Customize now</a>
            </div>
            <div class="box">
                <img src="image/banner/b.png" >
            </div>
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
    <!--------testimonial-------->
    <div class="line"></div>
    <div class="testimonial-fluid">
        <h1 class="title">What Our Customers Say's</h1>
        <div class="testimonial-slider">
            <div class="testimonial-item"> 
                <img src="image/people/1.png">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic & Premium Material</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br> Ut enim ad minim venian, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
            <div class="testimonial-item"> 
                <img src="image/people/2.png">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic & Premium Material</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br> Ut enim ad minim venian, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
            <div class="testimonial-item"> 
                <img src="image/people/3.png">
                <div class="testimonial-caption">
                    <span>Test The Quality</span>
                    <h1>Organic & Premium Material</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>Ut enim ad minim venian, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </div>
        <div class="control">
            <i class="bi bi-chevron-left prev1"></i>
            <i class="bi bi-chevron-right next1"></i>
        </div>
    </div>
    <div class="line"></div>
    <!--------discover section-------->
    <div class="discover"> 
        <div class="detail">
            <h1 class="title">Organic & Premium Material</h1>
            <span>Buy Now And Save 30% off</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="shop.php" class="btn">discover now</a>
        </div>
        <div class ="img-box">
            <img src="image/banner/bd.png">
        </div>
    </div>
    <div class="line"></div>
    <section class="popular-products">
        <h2>POPULAR PRODUCT</h2>
        <div class="control">
            <i class="bi bi-chevron-left left"></i>
            <i class="bi bi-chevron-right right"></i>
        </div>
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
        <div class="popular-product-content">
            <?php
              $select_products = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
              if(mysqli_num_rows($select_products)>0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" class="card">
              <img src="image/<?php echo $fetch_products['image'];?>">
              <div class="price">$<?php echo $fetch_products['price'];?></div>
              <div class="name"><?php echo $fetch_products['name'];?></div>
              <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'];?>">
              <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
              <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
              <!-- <input type="hidden" name="product_quantity" value="1" min="1"> -->
              <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">
              <div class="icon">
                <a href="view_page.php?pid=<?php echo $fetch_products['id'];?>" class="bi bi-eye-fill"></a>
                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                
              </div>
              
            </form>
            <?php
                }
              }else{
                    echo '<p class="empty">No product added yet</p>';
              }
            ?>
        </div>
    </section>
    <div class="line"></div>
    <div class="newsletter">
        <h1 class="title">Join our Newsletter</h1>
        <p>Get 15% off your next order. Be the first to learn about promotions special events, new arrivals and more</p>
        <input type="text" name="" placeholder="your email address">
        <button>subscribe now</button>
    </div>
    <div class="line"></div>
    <div class="line"></div>
    
    <?php include 'footer.php';?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="script2.js"></script>
</body>
</html>
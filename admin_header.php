<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- box icons link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class ="flex">
            <a href="admin_pannel.php" class= "logo"><img src="logo1.png" width ="175rem"></a>
            <nav class="navbar">
                <a href="admin_pannel.php">home</a>
                <a href="admin_product.php">product</a>
                <a href="admin_order.php">order</a>
                <a href="admin_user.php">user</a>
                <a href="admin_message.php">message</a>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['admin_name'];?></span></p>
                <p>Email : <span><?php echo $_SESSION['admin_email']?></span></p>
                <form method="post">
                    <button type="submit" name="logout" class='logout-btn'>logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis veniam asperiores </p>
        </div>  
    </div>
    <div class="line"></div>
</body>
</html>
<?php
include('connection.php');
session_start();

if (isset($_POST['submit-btn'])) {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);

    // Check in user table
    $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);
        // Check if password matches
        if ($password === $row['password']) {
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('Location: index.php');
            exit();
        }
    }

    // Check in admin table
    $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email'") or die('query failed');
    if (mysqli_num_rows($select_admin) > 0) {
        $row = mysqli_fetch_assoc($select_admin);
        // Check if password matches
        if ($password === $row['password']) {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('Location: admin_pannel.php');
            exit();
        }
    }

    $message[] = 'Incorrect email address or password';
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
    <title>Register page</title>
</head>
<body>
    
    <section class="form-container">
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
        <form method="post">
            <h1>Login</h1>
            <div class="input-field">
                <label>your email</label><br>
                <input type="email" name="email" placeholder="enter your email" required>
            </div>
            <div class="input-field">
                <label>your email</label><br>
                <input type="password" name="password" placeholder="enter your password" required>
            </div>
            <input type="submit" name="submit-btn" value="Login" class="btn">
            <p>do not have an account? <a href="register.php">Register now</a></p>
        </form>
    </section>
</body>
</html>
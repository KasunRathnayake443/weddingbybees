<?php
include 'inc/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding by Bees Admin Login</title>
    <link rel="stylesheet" href="css/admin-login.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/alerts.css">
    


</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Wedding by Bees Admin Login</h1>
            <form action="admin.php" method="post">
                <label for="username">Email:</label>
                <input type="text" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <div class="alert2" id="alertBox1">
                    <i class="fa fa-times  fa-2x"></i> 
                    <span class="message-text">Wrong Username or Password</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
                
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script src="js/notifications.js"></script>
</body>
</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
   
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
      
        if ($password == $admin['password']) {
           
            $_SESSION['admin'] = $admin['email'];
            header("Location: admin/dashboard.php"); 
            exit();
        } else {
            echo "<script>
            
            window.location.href='admin.php?notifications1=1';
        </script>";
        }
    } else {
        echo "<script>
            
        window.location.href='admin.php?notifications1=1';
    </script>";
    }
}
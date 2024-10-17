<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';
?>

<?php 
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['admin']);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding by Bees Admin Dashboard</title>
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>
<div class="dashboard-container">

    <?php include 'header.php' ?>
        <div class="main-content">
            <h1>Welcome, <?php echo $admin['name'];?>!</h1>
            <p>This is your admin dashboard. From here, you can manage the website's content and operations.</p>
        </div>
</div>

   
</body>
</html>

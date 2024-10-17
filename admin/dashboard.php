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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="dashboard-container">
        <div class="sidebar">
            <h2>Wedding By Bees</h2>
            <nav>
                <ul>
                    <li><a href="manage_decorations.php">Manage Decorations</a></li>
                    <li><a href="manage_bookings.php">Manage Bookings</a></li>
                    <li><a href="manage_inventory.php">Manage Inventory</a></li>
                    <li><a href="manage_customers.php">Manage Customers</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        
        <div class="main-content">
            <h1>Welcome, <?php echo $_SESSION['admin']; ?>!</h1>
            <p>This is your admin dashboard. From here, you can manage the website's content and operations.</p>
        </div>
    </div>
</body>
</html>

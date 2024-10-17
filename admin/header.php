<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
        <div class="sidebar">
            <h2 style="color:#ffdc30;">Wedding By Bees</h2>
            <nav>
                <ul>
                    <li><a href="dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a></li>
                    <li><a href="manage_bookings.php" class="<?php echo ($current_page == 'manage_bookings.php') ? 'active' : ''; ?>">Manage Bookings</a></li>
                    <li><a href="manage_inventory.php" class="<?php echo ($current_page == 'manage_inventory.php') ? 'active' : ''; ?>">Manage Inventory</a></li>
                    <li><a href="manage_customers.php" class="<?php echo ($current_page == 'manage_customers.php') ? 'active' : ''; ?>">Manage Customers</a></li>
                    <li><a href="logout.php" onclick="return confirmLogout();" class="">Logout</a></li>
                </ul>
                <img src="../images/bees.png" width="250px"> 
            </nav>
        </div>
    
        <script>
        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }
        </script>

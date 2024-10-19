<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
        <div class="sidebar">
            <h2 style="color:#ffdc30;">Wedding By Bees</h2>
            <nav>
                <ul>
                    <li><a href="dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a></li>
                    <li><a href="carousel.php" class="<?php echo ($current_page == 'carousel.php') ? 'active' : ''; ?>">Carousel</a></li>
                    <li><a href="gallery.php" class="<?php echo ($current_page == 'gallery.php') ? 'active' : ''; ?>">Gallery</a></li>
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

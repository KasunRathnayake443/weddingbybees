<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<button class="menu-toggle" onclick="toggleSidebar()">
  <i class="fa fa-bars"></i>
</button>
<div class="sidebar">
    <h2 style="color:#ffdc30;">Wedding By Bees</h2>
    <nav>
        <ul>
            <li><a href="dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a></li>
            <li><a href="carousel.php" class="<?php echo ($current_page == 'carousel.php') ? 'active' : ''; ?>">Carousel</a></li>
            <li><a href="gallery.php" class="<?php echo ($current_page == 'gallery.php') ? 'active' : ''; ?>">Gallery</a></li>
            <li><a href="messages.php" class="<?php echo ($current_page == 'messages.php') ? 'active' : ''; ?>">Messages</a></li>
            <li><a href="bookings.php" class="<?php echo ($current_page == 'bookings.php') ? 'active' : ''; ?>">Bookings</a></li>
            <li><a href="packages.php" class="<?php echo ($current_page == 'packages.php') ? 'active' : ''; ?>">Packages</a></li>
            <li><a href="services.php" class="<?php echo ($current_page == 'services.php') ? 'active' : ''; ?>">Services</a></li>
            <li><a href="admins.php" class="<?php echo ($current_page == 'admins.php') ? 'active' : ''; ?>">Admins</a></li>
            <li class="dropdown">
                <a href="#" class="<?php echo ($current_page == 'products.php' || $current_page == 'orders.php') ? 'active' : ''; ?>" onclick="toggleDropdown('shopDropdown')">
                    Shop
                </a>
                <ul id="shopDropdown" class="dropdown-menu">
                    <li><a href="products.php" class="products-link <?php echo ($current_page == 'products.php') ? 'active' : ''; ?>">Products</a></li>
                    <li><a href="orders.php" class="orders-link <?php echo ($current_page == 'orders.php') ? 'active' : ''; ?>">Orders</a></li>
                    
                </ul>
            </li>
            <li><a href="logout.php" onclick="return confirmLogout();" class="">Logout</a></li>
        </ul>
    </nav>
</div>



<script>
function toggleSidebar() {
  const sidebar = document.querySelector('.sidebar');
  sidebar.classList.toggle('active');
}

function toggleDropdown(dropdownId) {
  const dropdown = document.getElementById(dropdownId);
  dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
}

function confirmLogout() {
  return confirm('Are you sure you want to logout?');
}
</script>




<style>

.sidebar a {
    text-decoration: none;
    color: #fff;
    display: block;
    margin: 10px 0;
    padding: 10px;
    transition: all 0.3s ease;
}


.sidebar a.active {
    background-color: #ffdc30;
    color: #000;
    font-weight: bold;
}


.dropdown-menu {
    display: none;
    margin-left: 20px;
    list-style-type: none;
    padding-left: 0;
}


.products-link {
    color:black !important; 

}

.products-link.active {
    color: black  !important;
    background-color: rgba(72, 239, 128, 0.2);
}


.orders-link {
    color: black  !important; 
  
}

.orders-link.active {
    color: black !important;
    background-color: rgba(255, 152, 0, 0.2);
}


.dropdown-menu li a {
    padding: 8px 15px;
    border-radius: 5px;
    margin: 5px 0;
}
</style>


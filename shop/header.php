<?php
include('inc/config.php');
require_once('inc/session.php');

?>
<link rel="stylesheet" href="../css/style.css">

<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">

    <div class="container-fluid">
    
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" style="color:#FFB81C;" href="shop.php">Wedding By Bees Store</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           `    <li class="nav-item">
                    <a class="nav-link me-2" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2"  data-bs-toggle="modal" data-bs-target="#cartModal" href=""><i class="fas fa-cart-shopping"></i> Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact</a>
                </li>

                <?php if (isset($_SESSION['customer_id'])): ?>
                    <li class="nav-item">
                        <a href="inc/auth.php?logout=true" class="nav-link text-danger" onclick="return confirm('Are you sure you want to log out?')">Logout</a>
                    </li>
                    <li class="nav-item">
                        <?php
                            $sql = "SELECT profile_pic FROM customer WHERE id = {$_SESSION['customer_id']}";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                        ?>
                        <a href="account.php">
                            <img src="<?php echo htmlspecialchars($row['profile_pic']); ?>" alt="Profile" class="profile-pic">
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <button type="button" style="background-color: #ffc107; border-color: white;" class="btn btn-outline-dark shadow-none me-lg-3 btn-login" id="loginBtn">Login</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" style="background-color: #ffc107; border-color: white;" class="btn btn-outline-dark shadow-none btn-register" id="registerBtn">Register</button>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>



<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inc/auth.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inc/auth.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="profileImage" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profileImage" name="profile_image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('loginBtn').addEventListener('click', function() {
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    });

    document.getElementById('registerBtn').addEventListener('click', function() {
        var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
        registerModal.show();
    });

    function toggleDropdown() {
        const dropdown = document.getElementById("profileDropdown");
        dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
    }

    function confirmLogout() {
        return confirm("Are you sure you want to log out?");
    }
</script>

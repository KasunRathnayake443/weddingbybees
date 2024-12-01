<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['customer_id']); 
}

function getLoggedInUser() {
    if (isLoggedIn()) {
        global $conn;
        $customer_id = $_SESSION['customer_id'];
        $sql = "SELECT * FROM customer WHERE id = '$customer_id' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result); 
    }
    return null; 
}

function logout() {
    // Unset all session variables and destroy the session
    session_destroy();
    unset($_SESSION['customer_id']); 
    header("Location: ../shop.php"); 
    exit();
}

function login($userId) {
    $_SESSION['customer_id'] = $userId; 
}
?>

<?php
session_start();
include('inc/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'];

    
    $query = "UPDATE orders SET status = 'Canceled' WHERE id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $_SESSION['success_message'] = "Order successfully canceled.";
    } else {
        $_SESSION['error_message'] = "Order could not be canceled. Please contact support.";
    }

    header("Location: account.php?notifications2=1");
    exit();
}
?>

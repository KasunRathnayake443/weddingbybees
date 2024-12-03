<?php
include('inc/config.php');
include('inc/session.php');

// Check if the order ID is provided in the URL
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    die("Invalid order ID.");
}

$order_id = intval($_GET['order_id']);

// Fetch order details from the database
$query = "SELECT * FROM orders WHERE order_id = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $order = $result->fetch_assoc();
    } else {
        die("Order not found.");
    }

    $stmt->close();
} else {
    die("Database error: Unable to prepare query.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Order Confirmation</h2>
        <div class="card p-4">
            <h4>Thank you for your order!</h4>
            <p>Your order has been placed successfully. Here are the details:</p>

            <div class="mt-3">
                <h5>Order Details</h5>
                <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
                <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
                <p><strong>Total Price:</strong> Rs: <?php echo htmlspecialchars(number_format($order['total_price'], 2)); ?></p>
                <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
                <p><strong>Order Status:</strong> <?php echo htmlspecialchars($order['order_status']); ?></p>
            </div>

            <div class="mt-3">
                <h5>Shipping Details</h5>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($order['shipping_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($order['shipping_email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['shipping_phone']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($order['shipping_address']); ?></p>
            </div>

            <div class="mt-3">
                <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php
require_once('inc/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!isset($data['cart'], $data['shipping'], $data['paymentMethod'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
        exit();
    }

    $cart = $data['cart'];
    $shipping = $data['shipping'];
    $paymentMethod = $data['paymentMethod'];

    $customerId = $_SESSION['customer_id'];

    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert into `orders` table
        $stmt = $conn->prepare("INSERT INTO orders (customer_id, shipping_address, payment_method, total_price) VALUES (?, ?, ?, ?)");
        $shippingAddress = $shipping['address'];
        $totalPrice = array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
        $stmt->bind_param("issd", $customerId, $shippingAddress, $paymentMethod, $totalPrice);
        $stmt->execute();
        $orderId = $conn->insert_id; // Get the last inserted order ID

        // Insert each cart item into `order_items` table
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($cart as $item) {
            $stmt->bind_param("isid", $orderId, $item['name'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        // Commit the transaction
        mysqli_commit($conn);

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

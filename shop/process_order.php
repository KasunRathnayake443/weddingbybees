<?php
header('Content-Type: application/json');
require_once('inc/config.php');

// Fetch the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid data received']);
    exit();
}

// Extract data from the request
$cart = $data['cart'];
$shipping = $data['shipping'];
$billing = isset($data['billing']) ? $data['billing'] : $shipping; // Use shipping details if billing is the same
$paymentMethod = $data['paymentMethod'];
$totalPrice = 0;

// Calculate total price
foreach ($cart as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}

// Current datetime for order_date
$orderDate = date('Y-m-d H:i:s');

// Set default statuses
$orderStatus = 'Pending';  // Example: Pending, Processing, Completed
$paymentStatus = 'Unpaid'; // Example: Unpaid, Paid

// Insert order into the orders table
$sql = "INSERT INTO orders (
            customer_id, order_date, total_price, order_status, payment_status, payment_method, 
            shipping_name, shipping_email, shipping_phone, shipping_address, 
            billing_name, billing_email, billing_phone, billing_address
        ) VALUES (
            '{$_SESSION['customer_id']}', '$orderDate', '$totalPrice', '$orderStatus', '$paymentStatus', '$paymentMethod',
            '{$shipping['name']}', '{$shipping['email']}', '{$shipping['phone']}', '{$shipping['address']}',
            '{$billing['name']}', '{$billing['email']}', '{$billing['phone']}', '{$billing['address']}'
        )";

if (mysqli_query($conn, $sql)) {
    $order_id = mysqli_insert_id($conn);

    // Insert each item into the order_items table
    foreach ($cart as $item) {
        $itemName = $item['name'];
        $itemPrice = $item['price'];
        $itemQuantity = $item['quantity'];

        $sql_item = "INSERT INTO order_items (order_id, product_name, price, quantity) 
                     VALUES ('$order_id', '$itemName', '$itemPrice', '$itemQuantity')";
        mysqli_query($conn, $sql_item);
    }

    echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to place order']);
}
?>

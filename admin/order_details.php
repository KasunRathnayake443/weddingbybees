<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';


$order_id = $_GET['order_id'];
$order_sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($order_sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();


$items_sql = "SELECT * FROM order_items WHERE order_id = ?";
$stmt = $conn->prepare($items_sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];

    $update_sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        $order['status'] = $status; 
        $status_message = "Order status updated successfully!";
    } else {
        $status_message = "Error updating status.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Order Details</title>
</head>
<body>

<div class="dashboard-container">
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h1>Order Details</h1>
        
        <?php if (isset($status_message)) { ?>
            <p class="status-message"><?php echo $status_message; ?></p>
        <?php } ?>

        <div class="order-info">
            <h2>Customer Information</h2>
            <p><strong>Name:</strong> <?php echo $order['shipping_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $order['shipping_email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $order['shipping_phone']; ?></p>
            <p><strong>Address:</strong> <?php echo $order['shipping_address']; ?></p>

            <h2>Order Information</h2>
            <p><strong>Total Price:</strong> Rs. <?php echo number_format($order['total_price'], 2); ?></p>
            <p><strong>Payment Method:</strong> <?php echo ucfirst($order['payment_method']); ?></p>
            <p><strong>Status:</strong> <?php echo ucfirst($order['status']); ?></p>
            <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>

            <h2>Order Items</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items as $item) { ?>
                        <tr>
                            <td><?php echo $item['product_id']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>Rs. <?php echo number_format($item['price'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h2>Update Order Status</h2>
            <form method="POST">
                <label for="status">Status:</label>
                <select name="status">
                    <option value="Pending" <?php echo $order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="Packed by Seller" <?php echo $order['status'] == 'Packed by Seller' ? 'selected' : ''; ?>>Packed by Seller</option>
                    <option value="Handed Over to Delivery Partner" <?php echo $order['status'] == 'Handed Over to Delivery Partner' ? 'selected' : ''; ?>>Handed Over to Delivery Partner</option>
                    <option value="Out for Delivery" <?php echo $order['status'] == 'Out for Delivery' ? 'selected' : ''; ?>>Out for Delivery</option>
                    <option value="Delivered" <?php echo $order['status'] == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                    <option value="Completed" <?php echo $order['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                    <option value="Cancelled" <?php echo $order['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                </select>

                <button type="submit" class="btn btn-success">Update Status</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

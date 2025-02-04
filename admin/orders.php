<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';


$sql = "SELECT id, customer_id, shipping_name, shipping_email, shipping_phone, 
        shipping_address, total_price, payment_method, status, order_date 
        FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);

$orders = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../inc/title.php'; ?>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="dashboard-container">

    <?php include 'header.php'; ?>
    <div class="main-content">

        <div class="order-section">
            <h1>Order Management</h1>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($orders)) {
                        foreach ($orders as $order) {
                            echo "<tr>";
                            echo "<td>" . $order['id'] . "</td>";
                            echo "<td>" . $order['shipping_name'] . "</td>";
                            echo "<td>" . $order['shipping_email'] . "</td>";
                            echo "<td>" . $order['shipping_phone'] . "</td>";
                            echo "<td>Rs. " . number_format($order['total_price'], 2) . "</td>";
                            echo "<td>" . ucfirst($order['payment_method']) . "</td>";
                            echo "<td>" . ucfirst($order['status']) . "</td>";
                            echo "<td>" . $order['order_date'] . "</td>";
                            echo "<td>
                                    <a href='order_details.php?order_id=" . $order['id'] . "' class='btn btn-info'>View Order</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>

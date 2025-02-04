<?php
require_once('inc/config.php');
require_once('inc/session.php');
require_once('inc/links.php');



$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id === 0) {
    echo "Invalid Order!";
    exit;
}


$order_query = $conn->prepare("
    SELECT id, customer_id, shipping_name, shipping_email, shipping_phone, 
           shipping_address, total_price, payment_method, status, order_date
    FROM orders
    WHERE id = ?
");
$order_query->bind_param("i", $order_id);
$order_query->execute();
$order_result = $order_query->get_result();

if ($order_result->num_rows === 0) {
    echo "Order not found!";
    exit;
}

$order = $order_result->fetch_assoc();


$item_query = $conn->prepare("
    SELECT p.name, oi.quantity, oi.price
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
");
$item_query->bind_param("i", $order_id);
$item_query->execute();
$item_result = $item_query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="shortcut icon" href="../images/logo/<?php echo $result_general['logo']?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="order_confirmation.css">

</head>
<body>
<div class="container mt-5">
    <h2>Order Confirmation</h2>
    <p>Thank you for your order! Below are the details:</p>

    <h4>Order Details</h4>
    <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
    <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
    <p><strong>Total Price:</strong> Rs.<?php echo number_format($order['total_price'], 2); ?></p>
    <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
    <p><strong>Status:</strong> <?php echo $order['status']; ?></p>

    <h4>Shipping Information</h4>
    <p><strong>Name:</strong> <?php echo $order['shipping_name']; ?></p>
    <p><strong>Email:</strong> <?php echo $order['shipping_email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $order['shipping_phone']; ?></p>
    <p><strong>Address:</strong> <?php echo $order['shipping_address']; ?></p>

    <h4>Ordered Items</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $item_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>Rs.<?php echo number_format($item['price'], 2); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="shop.php" class="btn btn-primary mt-3">Continue Shopping</a>
</div>
</body>
</html>

<?php
$order_query->close();
$item_query->close();
$conn->close();
?>

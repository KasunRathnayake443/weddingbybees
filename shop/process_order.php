<?php

include 'inc/config.php';
include_once 'inc/session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch order details
    $customer_id = $_SESSION['customer_id'];  
    $order_date = date('Y-m-d H:i:s');     
    $total_price = $_POST['total_price'];     
    $order_status = 'Pending';              
    $payment_method = $_POST['paymentMethod'];

    // Shipping and Billing Details
    $shipping_name = $_POST['shippingName'];
    $shipping_email = $_POST['shippingEmail'];
    $shipping_phone = $_POST['shippingPhone'];
    $shipping_address = $_POST['shippingAddress'];

    $billing_name = $_POST['billingName'];
    $billing_email = $_POST['billingEmail'];
    $billing_phone = $_POST['billingPhone'];
    $billing_address = $_POST['billingAddress'];

    // Decode cart items from the session or POST data
    $cart = json_decode($_POST['cart'], true);

    // Insert into orders table
    $query = "INSERT INTO orders 
        (customer_id, order_date, total_price, order_status, payment_status, payment_method, 
        shipping_name, shipping_email, shipping_phone, shipping_address,
        billing_name, billing_email, billing_phone, billing_address)
        VALUES ('$customer_id', '$order_date', '$total_price', '$order_status', 'Pending', '$payment_method',
                '$shipping_name', '$shipping_email', '$shipping_phone', '$shipping_address',
                '$billing_name', '$billing_email', '$billing_phone', '$billing_address')";

    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);

        // Insert items into order_items table
        foreach ($cart as $item) {
            $product_id = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $total_item_price = $quantity * $price;

            $order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                VALUES ('$order_id', '$product_id', '$quantity', '$total_item_price')";

            mysqli_query($conn, $order_item_query);
        }

        echo "<script>
            alert('Your order has been placed successfully!');
            window.location.href = 'order_confirmation.php';
        </script>";
    } else {
        echo "<script>
            alert('Something went wrong, please try again!');
            window.location.href = 'checkout.php';
        </script>";
    }
} else {
    echo "<script>
        window.location.href = 'shop.php';
    </script>";
}

?>

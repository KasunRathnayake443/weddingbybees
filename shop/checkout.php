<?php
require_once('inc/config.php');
require_once('inc/session.php');
require_once('inc/links.php');

if (!isset($_SESSION['customer_id'])) {
    echo "<script>
        window.location.href = 'shop.php?notifications2=1';
    </script>";
    exit();
}

$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * FROM customer WHERE id = $customer_id";
$result = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($result);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = $_POST['paymentMethod'];
    $shippingName = $_POST['shippingName'];
    $shippingEmail = $_POST['shippingEmail'];
    $shippingPhone = $_POST['shippingPhone'];
    $shippingAddress = $_POST['shippingAddress'];

 
    $cart = json_decode($_POST['cart'], true);

  
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    
    $orderSql = "INSERT INTO orders (customer_id, shipping_name, shipping_email, shipping_phone, shipping_address, total_price, payment_method, status) 
                 VALUES ($customer_id, '$shippingName', '$shippingEmail', '$shippingPhone', '$shippingAddress', $totalPrice, '$paymentMethod', 'Pending')";
    mysqli_query($conn, $orderSql);
    $orderId = mysqli_insert_id($conn); 

    
    foreach ($cart as $item) {
        $productId = $item['id'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $itemSql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                    VALUES ($orderId, $productId, $quantity, $price)";
        mysqli_query($conn, $itemSql);
    }

   
    echo "<script>sessionStorage.removeItem('cart');</script>";

   
    if ($paymentMethod === 'Cash on Delivery') {
        header("Location: order_confirmation.php?order_id=$orderId");
        exit();
    } elseif ($paymentMethod === 'Card') {
        header("Location: payment.php?order_id=$orderId");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Wedding by Bees</title>
    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../images/logo/<?php echo $result_general['logo']?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container my-5">
        <h2 class="text-center">Checkout</h2>
        <div class="card p-4">
            <div class="row">
                <div class="col-md-6">
                    <h4>Billing Details</h4>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($customer['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($customer['address']); ?></p>
                </div>
                <div class="col-md-6">
                    <h4>Shipping Details</h4>
                    <form id="shippingForm">
                        <div class="mb-3">
                            <label for="shippingName" class="form-label">Name</label>
                            <input type="text" id="shippingName" name="shippingName" class="form-control" value="<?php echo htmlspecialchars($customer['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="shippingEmail" class="form-label">Email</label>
                            <input type="email" id="shippingEmail" name="shippingEmail" class="form-control" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="shippingPhone" class="form-label">Phone</label>
                            <input type="text" id="shippingPhone" name="shippingPhone" class="form-control" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="shippingAddress" class="form-label">Address</label>
                            <textarea id="shippingAddress" name="shippingAddress" class="form-control" required><?php echo htmlspecialchars($customer['address']); ?></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                <h4>Payment Method</h4>
                <form id="paymentForm">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cashOnDelivery" value="Cash on Delivery" checked>
                        <label class="form-check-label" for="cashOnDelivery">Cash on Delivery</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cardPayment" value="Card">
                        <label class="form-check-label" for="cardPayment">Card</label>
                    </div>
                </form>
            </div>

            <div class="mt-4">
                <h4>Order Summary</h4>
                <div id="cartItems"></div>
                <p class="fw-bold">Total: Rs: <span id="totalPrice">0.00</span></p>
            </div>

            <button id="placeOrderButton" class="btn btn-success w-100">Place Order</button>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const cart = JSON.parse(sessionStorage.getItem('cart') || '[]');
        const cartItemsContainer = document.getElementById('cartItems');
        const totalPriceContainer = document.getElementById('totalPrice');
        const placeOrderButton = document.getElementById('placeOrderButton');

        function renderCart() {
            cartItemsContainer.innerHTML = '';
            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
                totalPriceContainer.textContent = '0.00';
            } else {
                let total = 0;
                cart.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    cartItemsContainer.innerHTML += `
                        <div class="cart-item d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <p class="m-0">${item.name} - Rs: ${item.price} x ${item.quantity} = Rs: ${itemTotal.toFixed(2)}</p>
                            </div>
                            <button class="btn btn-danger btn-sm remove-item" data-index="${index}">Remove</button>
                        </div>
                    `;
                });
                totalPriceContainer.textContent = total.toFixed(2);
            }
        }

        renderCart();

        cartItemsContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-item')) {
                const itemIndex = event.target.getAttribute('data-index');
                cart.splice(itemIndex, 1);
                sessionStorage.setItem('cart', JSON.stringify(cart));
                renderCart();
            }
        });

        placeOrderButton.addEventListener('click', function () {
            const shippingForm = document.getElementById('shippingForm');
            const paymentForm = document.getElementById('paymentForm');
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

            const formData = new FormData();
            formData.append('shippingName', document.getElementById('shippingName').value);
            formData.append('shippingEmail', document.getElementById('shippingEmail').value);
            formData.append('shippingPhone', document.getElementById('shippingPhone').value);
            formData.append('shippingAddress', document.getElementById('shippingAddress').value);
            formData.append('paymentMethod', paymentMethod);
            formData.append('cart', JSON.stringify(cart));

            fetch('checkout.php', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
            });
        });
    });
    </script>
</body>
</html>
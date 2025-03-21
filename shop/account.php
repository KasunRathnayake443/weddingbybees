<?php
session_start();
include('inc/config.php');
include('inc/links.php');

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customerId = $_SESSION['customer_id'];


$query = "SELECT id, name, email, phone, address, profile_pic FROM customer WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customerId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No customer found!";
    exit();
}

$customer = $result->fetch_assoc();

// Fetch user orders
$orderQuery = "SELECT id, order_date, status FROM orders WHERE customer_id = ? ORDER BY order_date DESC";
$orderStmt = $conn->prepare($orderQuery);
$orderStmt->bind_param("i", $customerId);
$orderStmt->execute();
$orderResult = $orderStmt->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $profilePic = '../images/profile_pics/' . basename($_FILES['profile_pic']['name']);
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profilePic);
    } else {
        $profilePic = $customer['profile_pic'];
    }

    $updateQuery = "UPDATE customer SET name = ?, email = ?, phone = ?, address = ?, profile_pic = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssssi", $name, $email, $phone, $address, $profilePic, $customerId);

    if ($updateStmt->execute()) {
        echo "Details updated successfully!";
        header("Location: account.php?notifications1=1");
        exit();
    } else {
        echo "Error updating details.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding By Bees-Shop</title>
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../images/logo/<?php echo $result_general['logo']?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/alerts.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="shop.css">
</head>
<body>

<?php require('header.php'); ?>
<?php require('cart.php'); ?>

<div class="account-page">
    <div class="account-container">
        <div class="account-header">
            <h2>My Account</h2>
        </div>
        <div class="account-body p-4">
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form action="account.php" method="POST" enctype="multipart/form-data">
                <div class="profile-image-wrapper">
                    <?php if ($customer['profile_pic']): ?>
                        <img src="<?php echo htmlspecialchars($customer['profile_pic']); ?>" alt="Profile Picture" class="account-profile-pic">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/120" alt="Profile Picture" class="account-profile-pic">
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="account-form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($customer['name']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="account-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="account-form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="profile_pic" class="account-form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="account-form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required><?php echo htmlspecialchars($customer['address']); ?></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="account-btn">Update Details</button>
                </div>
            </form>
    
            
            <div class="orders-section mt-5">
    <?php
    $queryOrders = "SELECT * FROM orders WHERE customer_id = ? ORDER BY FIELD(status, 'Cancelled'), order_date DESC";
    $stmtOrders = $conn->prepare($queryOrders);
    $stmtOrders->bind_param("i", $customerId);
    $stmtOrders->execute();
    $ordersResult = $stmtOrders->get_result();
    ?>

    <h2 class="mt-4">My Orders</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $ordersResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                    <td>Rs.<?php echo number_format($order['total_price'], 2); ?></td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['id']; ?>">View Details</button>

                        <!-- Order Details Modal -->
                        <div class="modal fade" id="orderModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="orderModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Order Details (Order #<?php echo $order['id']; ?>)</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Shipping Name:</strong> <?php echo htmlspecialchars($order['shipping_name']); ?></p>
                                        <p><strong>Email:</strong> <?php echo htmlspecialchars($order['shipping_email']); ?></p>
                                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['shipping_phone']); ?></p>
                                        <p><strong>Address:</strong> <?php echo htmlspecialchars($order['shipping_address']); ?></p>
                                        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
                                        <p><strong>Total Price:</strong> Rs.<?php echo number_format($order['total_price'], 2); ?></p>
                                        <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>

                                        <h6>Order Items:</h6>
                                        <ul>
                                            <?php
                                            $orderItemsQuery = "SELECT product_id, quantity, price FROM order_items WHERE order_id = ?";
                                            $itemsStmt = $conn->prepare($orderItemsQuery);
                                            $itemsStmt->bind_param("i", $order['id']);
                                            $itemsStmt->execute();
                                            $itemsResult = $itemsStmt->get_result();

                                            while ($item = $itemsResult->fetch_assoc()):
                                            ?>
                                            <?php $productQuery = "SELECT name FROM products WHERE id = ?"; ?>
                                            <?php $productStmt = $conn->prepare($productQuery); ?>
                                            <?php $productStmt->bind_param("i", $item['product_id']); ?>
                                            <?php $productStmt->execute(); ?>
                                            <?php $productResult = $productStmt->get_result(); ?>
                                            <?php $product = $productResult->fetch_assoc(); ?>
                                            <li><?php echo $product['name']; ?> (x<?php echo $item['quantity']; ?>) - Rs.<?php echo number_format($item['price'], 2); ?></li>
                                                
                                            <?php endwhile; ?>
                                        </ul>
                                    </div>
                                                                        <div class="modal-footer">
                                        <?php if ($order['status'] === 'Pending'): ?>
                                            <form method="POST" action="cancel_order.php">
                                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                                <button type="submit" class="btn btn-danger">Cancel Order</button>
                                            </form>
                                        <?php elseif (in_array($order['status'], ['Cancelled', 'Completed', 'Delivered'])): ?>
                                            
                                        <?php else: ?>
                                            <p class="text-warning">For cancellation, contact Wedding by Bees.</p>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php require('footer.php'); ?>

                <div class="success2" id="alertBox1">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Profile Updated Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div> 


</body>
</html>

<script src="../js/notifications.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cartItems');
    const cartTotalContainer = document.getElementById('cartTotal');

   
    if (!sessionStorage.getItem('cart')) {
        sessionStorage.setItem('cart', JSON.stringify([]));
    }


    function renderCart() {
        const cart = JSON.parse(sessionStorage.getItem('cart'));
        cartItemsContainer.innerHTML = '';
        let total = 0;

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Your cart is empty</p>';
            cartTotalContainer.innerHTML = 'Total: Rs 0.00';
        } else {
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                cartItemsContainer.innerHTML += `
                    <div class="cart-item mb-2 d-flex justify-content-between align-items-center">
                        <div>
                            <p>${item.name} - Rs: ${item.price} x 
                            <input type="number" class="form-control w-auto d-inline" 
                                   value="${item.quantity}" min="1" data-id="${item.id}" 
                                   data-price="${item.price}"> 
                            = Rs: ${itemTotal.toFixed(2)}</p>
                        </div>
                        <button class="btn btn-danger remove-item-btn" data-id="${item.id}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            });

            cartTotalContainer.innerHTML = 'Total: Rs ' + total.toFixed(2);
        }
    }


    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            const productName = this.dataset.name;
            const productPrice = parseFloat(this.dataset.price);

          
            const cart = JSON.parse(sessionStorage.getItem('cart'));

        
            const existingItem = cart.find(item => item.id === productId);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: 1
                });
            }

            
            sessionStorage.setItem('cart', JSON.stringify(cart));

    
            renderCart();

        
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        });
    });

  
    cartItemsContainer.addEventListener('input', function(event) {
        if (event.target && event.target.type === 'number') {
            const productId = event.target.dataset.id;
            const newQuantity = parseInt(event.target.value, 10);
            const productPrice = parseFloat(event.target.dataset.price);

          
            const cart = JSON.parse(sessionStorage.getItem('cart'));

        
            const item = cart.find(item => item.id === productId);
            if (item) {
                item.quantity = newQuantity > 0 ? newQuantity : 1; 
            }

         
            sessionStorage.setItem('cart', JSON.stringify(cart));

         
            renderCart();
        }
    });

 
    cartItemsContainer.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-item-btn')) {
            const productId = event.target.dataset.id;

        
            const cart = JSON.parse(sessionStorage.getItem('cart'));

          
            const updatedCart = cart.filter(item => item.id !== productId);

          
            sessionStorage.setItem('cart', JSON.stringify(updatedCart));

            
            renderCart();
        }
    });

   
    renderCart();
});

</script>

<?php


session_start();
include('inc/config.php');
include('inc/links.php');

$selected_category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

$categories_query = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_query);



if ($selected_category_id > 0) {
    $products_query = "SELECT * FROM products WHERE category = $selected_category_id AND stock > 0";
} else {
    $products_query = "SELECT * FROM products WHERE stock > 0";
}
$products_result = mysqli_query($conn, $products_query);
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




</head>
<body>

<?php require('header.php'); ?>
<?php require('cart.php'); ?>

<div class="container my-5">
    <h1 class="text-center mb-4" style="font-size:30px;" >Our Products</h1>
    
    <div class="container my-4">
    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <h5>Filter by Category</h5>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="shop.php" class="text-decoration-none">All Categories</a>
                </li>
                <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
                    <li class="list-group-item">
                        <a href="shop.php?category_id=<?php echo $category['id']; ?>" 
                           class="text-decoration-none <?php echo $selected_category_id == $category['id'] ? 'fw-bold' : ''; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <!-- Products Section -->
        <div class="col-md-9">
    <div class="row">
        <?php while ($product = mysqli_fetch_assoc($products_result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card-container">
                    <div class="card h-100 d-flex flex-column flip-card">
                        <img src="../images/products/<?php echo htmlspecialchars($product['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="card-text fw-bold">Rs: <?php echo number_format($product['price'], 2); ?></p>
                            <div class="mt-auto">
                                <?php if ($product['stock'] > 0): ?>
                                    <button class="btn btn-primary w-100 add-to-cart-btn" 
                                            data-id="<?php echo $product['id']; ?>" 
                                            data-name="<?php echo htmlspecialchars($product['name']); ?>" 
                                            data-price="<?php echo $product['price']; ?>">
                                        Add to Cart
                                    </button>
                                <?php else: ?>
                                    <span class="badge bg-danger w-100">Out of Stock</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
    </div>
</div>
</div>

<style>
    .card-container {
        perspective: 1000px;
    }

    .flip-card {
        transform: rotateY(180deg);
        transition: transform 0.8s ease-in-out;
    }

    .flip-card.show {
        transform: rotateY(0deg);
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => {
            document.querySelectorAll('.flip-card').forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('show');
                }, index * 200); 
            });
        }, 200);
    });
</script>

<div class="modal" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cartItems">
                <!-- Cart Items will be dynamically added here -->
            </div>
            <div id="cartTotal" class="modal-footer">
                <span class="fw-bold">Total: Rs: <span id="totalPrice">0.00</span></span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="checkoutBtn">Go to Checkout</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Continue Shopping</button>
            </div>
        </div>
    </div>
</div>




<?php require('footer.php'); ?>


                <div class="nothing2" id="alertBox2">
                    <i class="fa fa-exclamation-triangle "></i> 
                    <span class="message-text">You must log in first to proceed to checkout.</span>                            
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

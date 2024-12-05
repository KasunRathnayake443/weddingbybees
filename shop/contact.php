<?php
session_start();
include('inc/config.php');
include('inc/links.php');


$message_sent = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $subject = $conn->real_escape_string($_POST["subject"]);
    $message = $conn->real_escape_string($_POST["message"]);

    $sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    if ($conn->query($sql) === TRUE) {
        $message_sent = true;
        header("Location: contact.php?notifications1=1");
    } else {
        $error_message = "Error: " . $conn->error;
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



</head>
<body>

<?php require('header.php'); ?>
<?php require('cart.php'); ?>

<div class="contact-page">
    <div class="contact-container">
        <div class="contact-header">
            <h2>Contact Us</h2>
        </div>

        <?php if ($message_sent): ?>
            <div class="alert alert-success">
                Thank you for your message! We'll get back to you soon.
            </div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form action="contact.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="contact-btn">Send Message</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



<?php require('footer.php'); ?>


                <div class="success2" id="alertBox1">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Message Sent Successfully</span>                            
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

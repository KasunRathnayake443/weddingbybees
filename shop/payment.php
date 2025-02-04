<?php
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Page</title>
  <link rel="stylesheet" href="payment.css">
</head>
<body>
  <div class="container">
    <h2>Payment Details</h2>
    <form id="paymentForm">
      <label for="cardName">Cardholder Name:</label>
      <input type="text" id="cardName" name="cardName" placeholder="Enter Cardholder Name" required>

      <label for="cardNumber">Card Number:</label>
      <input type="text" id="cardNumber" name="cardNumber" placeholder="Enter 16-digit Card Number" required pattern="\d{16}" title="Must be 16 digits">

      <label for="expiryDate">Expiry Date:</label>
      <input type="month" id="expiryDate" name="expiryDate" required>

      <label for="cvv">CVV:</label>
      <input type="text" id="cvv" name="cvv" placeholder="3-digit CVV" required pattern="\d{3}" title="Must be 3 digits">

      <button type="submit" class="btn">Pay Now</button>

      <div id="loadingAnimation" class="loading">
        <div class="spinner"></div>
        <p>Processing Payment...</p>
      </div>
    </form>
  </div>

  <script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
      event.preventDefault(); 
     
      document.getElementById('loadingAnimation').style.display = 'block';

      
      setTimeout(function() {
        window.location.href = 'order_confirmation.php? order_id=<?php echo $order_id; ?>';
      }, 3000);
    });
  </script>
</body>
</html>

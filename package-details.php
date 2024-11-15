<?php

include 'inc/config.php';




$sql_general_settings = "SELECT * FROM general_settings WHERE id = 1";
$result_general_settings = $conn->query($sql_general_settings);
$general_settings = $result_general_settings->fetch_assoc();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "SELECT * FROM package_images WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

 
    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
    } else {
        echo "Package not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     
    <title><?php echo $general_settings['website_name']?></title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    
    <link rel="shortcut icon" href="images/logo/<?php echo $general_settings['logo']?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/pogo-slider.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/alerts.css">

   <style>
   .container {
    width: 80%;
    margin: 0 auto;
    text-align: center;
}

.package-details {
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #f9f9f9;
    max-width: 600px;
    margin: 20px auto;
}

.package-image {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
}

h1, h2 {
    color: #333;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    color: #fff;
    text-decoration: none;
    background-color: #007bff;
    border-radius: 5px;
}

.btn-secondary {
    background-color: #6c757d;
}


.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
    padding-top: 50px;
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    border-radius: 10px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.modal-content h2 {
    margin-top: 0;
    font-size: 1.8rem;
    color: #333;
    text-align: center;
}

.modal-content label {
    display: block;
    margin: 10px 0 5px;
    font-size: 1rem;
    color: #555;
}

.modal-content input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

.modal-content .btn {
    width: 100%;
    text-align: center;
    padding: 12px;
    font-size: 1rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.modal-content .btn:hover {
    background-color: #0056b3;
}

.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-btn:hover {
    color: black;
}

   </style>

</head>
<body  data-spy="scroll" data-target="#navbar-wd" data-offset="98" style="background-image: url('images/background/.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">


	
    <div id="preloader">
		<div class="preloader pulse">
			<img src="images/bee.png" aria-hidden="true" width="50px">
		</div>
    </div>
    
	
	
	<header class="top-header">
		<nav class="navbar header-nav navbar-expand-lg">
            <div class="container">
			
				<a class="navbar-brand" href="index.php"><img src="images/logo/<?php echo $general_settings['logo']?>" height="60px" alt="image"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
					<span></span>
					<span></span>
					<span></span>
				</button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link active" href="index.php#home">Home</a></li>
                        <li><a class="nav-link" href="index.php#about">About Us</a></li>
                        <li><a class="nav-link" href="index.php#packages">Packages</a></li>
                        <li><a class="nav-link" href="index.php#gallery">Gallery</a></li>
                        <li><a class="nav-link" href="index.php#services">Services</a></li>
						<li><a class="nav-link" href="index.php#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
	</header>




	
	<div class="container">
    <h1>Package Details</h1>

    <div  id="packages" class="package-details">
        <img src="images/packages/<?php echo htmlspecialchars($package['image']); ?>" alt="Package Image" class="package-image">
        <h2><?php echo htmlspecialchars($package['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($package['description'])); ?></p>
        <p><strong>Price:</strong> Rs. <?php echo htmlspecialchars($package['price']); ?></p>

        <a href="#" class="btn" id="bookNowBtn">Book Now</a>
        <a href="index.php" class="btn btn-secondary">Back to Home Page</a>
    </div>
</div>

<!-- Booking Modal -->
<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Book Package</h2>
        <form id="bookingForm" action="process-booking.php" method="POST">
            <input type="hidden" name="package_name" value="<?php echo htmlspecialchars($package['title']); ?>">
            <input type="hidden" name="package_price" value="<?php echo htmlspecialchars($package['price']); ?>">

            <label for="customer_name">Your Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="wedding_date">Wedding Date:</label>
            <input type="date" id="wedding_date" name="wedding_date" required>

            <label for="venue">Venue:</label>
            <input type="text" id="venue" name="venue" required>

            <button type="submit" class="btn">Confirm Booking</button>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('bookingModal');
    const btn = document.getElementById('bookNowBtn');
    const closeBtn = document.querySelector('.close-btn');

    btn.onclick = function() {
        modal.style.display = 'block';
    };

    closeBtn.onclick = function() {
        modal.style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
</script>



	

	
	

	


	
	
	
	<footer class="footer-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="footer-company-name">All Rights Reserved. &copy; 2024 <a href="#"><?php echo $general_settings['website_name']?></a> Design By : <a href="#"><?php echo $general_settings['auther']?></a></p>
				</div>
			</div>
		</div>
	</footer>

				




	<script src="js/notifications.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
 
	<script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.pogo-slider.min.js"></script> 
	<script src="js/slider-index.js"></script>
	<script src="js/smoothscroll.js"></script>
	
    <script src="js/custom.js"></script>




</body>
</html>



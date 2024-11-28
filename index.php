<?php

include 'inc/config.php';


$carouselImages = [];
$sqlImages = "SELECT * FROM carousel";
$resultImages = $conn->query($sqlImages);
if ($resultImages->num_rows > 0) {
    while($row = $resultImages->fetch_assoc()) {
        $carouselImages[] = $row; 
    }
}

$carouselText = [];
$sqlText = "SELECT * FROM carousel_text LIMIT 1"; 
$resultText = $conn->query($sqlText);
if ($resultText->num_rows > 0) {
    $carouselText = $resultText->fetch_assoc();
}


$sql_general_settings = "SELECT * FROM general_settings WHERE id = 1";
$result_general_settings = $conn->query($sql_general_settings);
$general_settings = $result_general_settings->fetch_assoc();

$package_images = "SELECT * FROM package_images";
$result_package_images = $conn->query($package_images);

$gallery_images = "SELECT * FROM gallery";
$result_gallery_images = $conn->query($gallery_images);

$sql = "SELECT * FROM services";
$result = $conn->query($sql);
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   

</head>
<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98" style="background-image: url('images/background/.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">


	
    <div id="preloader">
		<div class="preloader pulse">
			<img src="images/bee.png" aria-hidden="true" width="50px">
		</div>
    </div>
    
	
	
	<header class="top-header">
    <nav class="navbar header-nav navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo/<?php echo $general_settings['logo']?>" height="60px" alt="image">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                <ul class="navbar-nav">
                    <li><a class="nav-link active" href="#home">Home</a></li>
                    <li><a class="nav-link" href="#about">About Us</a></li>
                    <li><a class="nav-link" href="#packages">Packages</a></li>
                    <li><a class="nav-link" href="#gallery">Gallery</a></li>
                    <li><a class="nav-link" href="#services">Services</a></li>
                    <li><a class="nav-link" href="#contact">Contact</a></li>
                    <li><a class="nav-link shop-link" href="#shop"><i class="fas fa-shopping-cart"></i> Shop</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>





	<div class="ulockd-home-slider">
		<div class="container-fluid">
			<div class="row">
				<div class="pogoSlider" id="js-main-slider">
				
						<?php
						
						foreach ($carouselImages as $key => $image) {
						?>
							<div class="pogoSlider-slide" data-transition="fade" data-duration="1500" style="background-image:url(<?php echo 'images/carousel/' . $image['image']; ?>);">
								<div class="lbox-caption">
									<div class="lbox-details">
										<h1 style="color:yellow;"><?php echo $carouselText['text1']; ?></h1> 
										<h2><?php echo $carouselText['text2']; ?></h2> 
										<p><strong> <?php echo $carouselText['text3']; ?> </strong></p>
										<a href="#contact" class="btn ">Contact</a>
									</div>
								</div>
							</div>
						<?php
						}
						?>
   
				</div>
			</div>
		</div>
	</div>
	
	


	<div id="about" class="about-box">
		<div class="about-a1">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="title-box">
							<h2><?php echo $general_settings['website_name']?></h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="row align-items-center about-main-info">
							<div class="col-lg-8 col-md-6 col-sm-12">
								<h2> About <span>Us</span></h2>
								<p><?php echo $general_settings['about_us_text']?> </p>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="about-img">
									<img class="img-fluid rounded" src="images/about/<?php echo $general_settings['about_us_image1']?>" alt="" >
								</div>
							</div>
						</div>
						<div class="row align-items-center about-main-info">
							<div class="col-lg-4 col-md-6 col-sm-12">
								<div class="about-img">
									<img class="img-fluid rounded" src="images/about/<?php echo $general_settings['about_us_image2']?>" alt="" >
								</div>
							</div>
							<div class="col-lg-8 col-md-6 col-sm-12">
								<h2>Our Work in <span>Focus</span></h2>
								<p><?php echo $general_settings['about_us_text_2']?> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	


	

	
	<div id="packages" class="package-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">
						<h2>Our Packages</h2>
						<p><?php echo $general_settings['packages_text']?> </p>
					</div>
				</div>
			</div>
			<div class="row">
			<?php foreach ($result_package_images as $key => $image) { ?>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="single-package">
						<div class="package-img">
							<img class="img-fluid" src="images/packages/<?php echo $image['image']; ?>" alt="Package Image" />
						</div>
						<div class="package-info">
							<h4><?php echo $image['title']; ?></h4> 
							<a href="package-details.php?id=<?php echo $image['id']; ?>" class="btn btn-primary">See More</a> 
						</div>
					</div>
				</div>
			<?php } ?>

			</div>
		</div>
	</div>
	
	
	
	
	<div id="gallery" class="gallery-box">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">
						<h2>Gallery</h2>
						<p><?php echo $general_settings['gallery_text']?> </p>
					</div>
				</div>
			</div>
			<div class="row">
				<ul class="popup-gallery clearfix">
				<?php foreach ($result_gallery_images as $key => $image) { ?>
					<li>
						<a href="images/gallery/<?php echo $image['image']; ?>">
							<img class="img-fluid" src="images/gallery/<?php echo $image['image']; ?>" alt="single image">
							<span class="overlay"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>



	<div id="services" class="events-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="title-box">
						<h2>Services</h2>
						<p>"Your wedding day is one of the most important days of your life, and we are honored to be a part of it. Our team at <?php echo $general_settings['website_name']?> is passionate about bringing your vision to life. Browse through our services to find the perfect elements that will make your celebration uniquely yours, from stunning decorations to exquisite catering." </p>
					</div>
				</div>
			</div>
			<div class="row">
			<div class="row" >
			<?php while($row = $result->fetch_assoc()) { ?>
					<div class="col-lg-4 col-md-6 col-sm-12" >
						<div class="event-inner">
							<div class="event-img">
								<img class="img-fluid" src="images/services/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" />
							</div>
							<h2><?php echo htmlspecialchars($row['name']); ?></h2>
							<p><?php echo htmlspecialchars($row['description']); ?></p>
						
						</div>
					</div>
				<?php } ?>
			</div>
			</div>
		</div>
	</div>
	
	<div id="contact" class="contact-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-box">
                    <h2>Contact Us</h2>
                  
                </div>
            </div>
        </div>
        <div class="row">
          
            <div class="col-lg-6 col-sm-12 col-xs-12">
                <div class="contact-block">
                    <form id="contactForm" action="index.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>                                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" placeholder="Your Email" id="email" class="form-control" name="email" required data-error="Please enter your email">
                                    <div class="help-block with-errors"></div>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Subject" id="subject" class="form-control" name="subject" required data-error="Please enter your subject">
                                    <div class="help-block with-errors"></div>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <textarea class="form-control" id="message" placeholder="Your Message" name="message" rows="8" data-error="Write your message" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn btn-common" id="submit" type="submit">Send Message</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div> 
                                    <div class="clearfix"></div> 
                                </div>
                            </div>
                        </div>            
                    </form>
                </div>
            </div>
          
            <div class="col-lg-6 col-sm-12 col-xs-12">
                <div class="contact-info-box">
                    <h3>Get in Touch</h3>
                    <ul class="social-icons">
                        <li><i class="fa fa-facebook"></i> Facebook: <a href="<?php echo $general_settings['facebook_url']?>">facebook.com/WeddingByBees</a></li>
                        <li><i class="fa fa-instagram"></i> Instagram: <a href="<?php echo $general_settings['instagram_url']?>">instagram.com/WeddingByBees</a></li>
                        <li><i class="fa fa-phone"></i> <?php echo $general_settings['phone']?></li>
                        <li><i class="fa fa-map-marker"></i><?php echo $general_settings['address']?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


	
	
	
	<footer class="footer-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="footer-company-name">All Rights Reserved. &copy; 2024 <a href="#"><?php echo $general_settings['website_name']?></a> Design By : <a href="#"><?php echo $general_settings['auther']?></a></p>
				</div>
			</div>
		</div>
	</footer>

				<div class="success2" id="alertBox1">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Message sent successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>

				<div class="success2" id="alertBox2">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Booking Successfull. Our team will contact you for further clarifications</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>


	<script src="js/notifications.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
 
	<script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.pogo-slider.min.js"></script> 
	<script src="js/slider-index.js"></script>
	<script src="js/smoothscroll.js"></script>
	<script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>



<?php
 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

   
    if (!empty($name) && !empty($email) && !empty($message)) {
      
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            
            echo "<script> document.location='index.php?notifications1=1';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
?>

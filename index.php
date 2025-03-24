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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">



   

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
					<li><a class="nav-link shop-link" style="background: #ffc107; color: #ffffff; font-weight: bold; border-radius: 5px;" href="shop/shop.php"><i class="fas fa-cart-shopping"></i> Shop</a></li>

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
                    <p><?php echo $general_settings['packages_text']?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($result_package_images as $key => $image) { ?>
                <div class="col-lg-4 col-md-6 col-sm-12 package-card" data-aos="fade-up">
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
<style>
    
.package-card {
    perspective: 1000px; 
}

.single-package {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    position: relative;
    transform-style: preserve-3d;
    z-index: 1;
}


.single-package:hover {
    transform: translateY(-10px) rotateX(5deg); 
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}


.package-img {
    overflow: hidden;
    border-radius: 10px 10px 0 0;
}

.package-img img {
    transition: transform 0.5s ease;
    width: 100%;
}

.single-package:hover .package-img img {
    transform: scale(1.1);
}


.single-package::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    z-index: 0;
}
.single-package:hover::before {
    opacity: 1;
}


.package-info h4, .package-info a {
    transition: color 0.3s ease-in-out, background 0.3s ease-in-out;
}

.single-package:hover h4 {
    color: #ff5722; 
}

.single-package:hover a {
    background: #ff5722;
    border-color: #ff5722;
}

.package-info a {
    position: relative;
    z-index: 2; 
}
</style>

<script>
    AOS.init({
        duration: 1000, 
        once: true
    });
</script>


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
                    <li class="gallery-item">
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


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const galleryItems = document.querySelectorAll(".popup-gallery li");

        if (galleryItems.length === 0) return;

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("fade-in-left");
                } else {
                    entry.target.classList.remove("fade-in-left");
                }
            });
        }, { threshold: 0.2 });

        galleryItems.forEach(item => observer.observe(item));
    });
</script>


<style>
    .popup-gallery li {
        display: block;
        opacity: 0;
        transform: translateY(50px); 
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        will-change: opacity, transform;
    }

    .popup-gallery li.fade-in-left {
        opacity: 1;
        transform: translateY(0);
    }
</style>







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
            <?php while($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up"> 
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
            duration: 1000, 
            once: true
        });
    });
</script>


<style>

.event-inner {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    position: relative;
}

.event-inner:hover {
    transform: translateY(-10px) scale(1.05); 
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
}


.event-img {
    overflow: hidden;
    border-radius: 10px 10px 0 0;
}

.event-img img {
    transition: transform 0.5s ease;
}

.event-inner:hover .event-img img {
    transform: scale(1.1);
}


.event-inner::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.event-inner:hover::before {
    opacity: 1;
}


.event-inner h2, .event-inner p {
    transition: color 0.3s ease-in-out;
}

.event-inner:hover h2 {
    color: #e91e63;
}

.event-inner:hover p {
    color: #444; 
}

</style>

	


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

	
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000, 
        once: true 
    });
</script>
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

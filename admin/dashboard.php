<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';
?>

<?php 
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['admin']);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../inc/title.php'?>
      <link rel="stylesheet" href="../css/dashboard.css">
   
</head>
<body>
<div class="dashboard-container" >

    <?php include 'header.php' ?>
        <div class="main-content">         
           
<?php
$sql = "SELECT * FROM general_settings WHERE id = 1";  
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
    $settings = $result->fetch_assoc();
} else {

    $settings = [
        'website_name' => '',
        'facebook_url' => '',
        'instagram_url' => '',
        'phone' => '',
        'address' => '',
        'logo' => ''
    ];
    echo "No settings found. Please add some.";
}
?>

<div class="general-settings">
    <h1>General Settings</h1>
    <form action="dashboard.php" method="post" enctype="multipart/form-data">
        <label for="website_name">Website Name:</label>
        <input type="text" name="website_name" value="<?php echo htmlspecialchars($settings['website_name']); ?>" required>

        <label for="auther_name">Website Auther Name:</label>
        <input type="text" name="auther_name" value="<?php echo htmlspecialchars($settings['auther']); ?>" required>

        <label for="facebook_url">Facebook URL:</label>
        <input type="url" name="facebook_url" value="<?php echo htmlspecialchars($settings['facebook_url']); ?>">

        <label for="instagram_url">Instagram URL:</label>
        <input type="url" name="instagram_url" value="<?php echo htmlspecialchars($settings['instagram_url']); ?>">

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($settings['phone']); ?>">

        <label for="address">Address:</label>
        <textarea name="address"><?php echo htmlspecialchars($settings['address']); ?></textarea>

        <label for="logo">Logo:</label>
        <input type="file" name="logo">
        <input type="hidden" name="current_logo" value="<?php echo $settings['logo']; ?>">
        <img src="../images/logo/<?php echo $settings['logo']; ?>" alt="Logo" width="100">

 
        <label for="about_us_text">About Us Text 1:</label>
        <textarea name="about_us_text" required><?php echo $settings['about_us_text']; ?></textarea>

        <label for="about_us_text">About Us Text 2:</label>
        <textarea name="about_us_text_2" required><?php echo $settings['about_us_text_2']; ?></textarea>

        <label for="about_us_image1">About Us Image 1:</label>
        <input type="file" name="about_us_image1">
        <input type="hidden" name="current_about_us_image1" value="<?php echo $settings['about_us_image1']; ?>">
        <img src="../images/about/<?php echo $settings['about_us_image1']; ?>" alt="About Us Image 1" width="100">

        <label for="about_us_image2">About Us Image 2:</label>
        <input type="file" name="about_us_image2">
        <input type="hidden" name="current_about_us_image2" value="<?php echo $settings['about_us_image2']; ?>">
        <img src="../images/about/<?php echo $settings['about_us_image2']; ?>" alt="About Us Image 2" width="100">


        <button type="submit">Save Settings</button>
    </form>
</div>


</div>

</div>

                <div class="success2" id="alertBox1">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">General Settings Updated Successfully </span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>

<script src="../js/notifications.js"></script>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $website_name = $_POST['website_name'];
    $auther_name = $_POST['auther_name'];
    $facebook_url = $_POST['facebook_url'];
    $instagram_url = $_POST['instagram_url'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $website_name = $_POST['website_name'];
    $facebook_url = $_POST['facebook_url'];
    $instagram_url = $_POST['instagram_url'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $about_us_text = $_POST['about_us_text'];
    $about_us_text_2 = $_POST['about_us_text_2'];

  
    $logo = $_POST['current_logo'];
    if (!empty($_FILES['logo']['name'])) {
        $logo_dir = '../images/logo/';
        $logo_file = basename($_FILES['logo']['name']);
        if (!file_exists($logo_dir)) {
            mkdir($logo_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo_dir . $logo_file)) {
            $logo = $logo_file;
        }
    }

   
    $about_us_image1 = $_POST['current_about_us_image1'];
    if (!empty($_FILES['about_us_image1']['name'])) {
        $about_us_dir = '../images/about/';
        $about_us_image1_file = basename($_FILES['about_us_image1']['name']);
        if (!file_exists($about_us_dir)) {
            mkdir($about_us_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES['about_us_image1']['tmp_name'], $about_us_dir . $about_us_image1_file)) {
            $about_us_image1 = $about_us_image1_file;
        }
    }

    $about_us_image2 = $_POST['current_about_us_image2'];
    if (!empty($_FILES['about_us_image2']['name'])) {
        $about_us_image2_file = basename($_FILES['about_us_image2']['name']);
        if (move_uploaded_file($_FILES['about_us_image2']['tmp_name'], $about_us_dir . $about_us_image2_file)) {
            $about_us_image2 = $about_us_image2_file;
        }
    }

   
    $sql = "UPDATE general_settings SET website_name = ?, facebook_url = ?, instagram_url = ?, phone = ?, address = ?, logo = ?, about_us_text = ?, about_us_text_2 =? , about_us_image1 = ?, about_us_image2 = ?, auther=? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssss', $website_name, $facebook_url, $instagram_url, $phone, $address, $logo, $about_us_text,$about_us_text_2 ,$about_us_image1, $about_us_image2, $auther_name);

    if ($stmt->execute()) {
        echo "<script> document.location='dashboard.php?notifications1=1';</script>";
    } else {
        echo "Error updating settings.";
    }
}
?>
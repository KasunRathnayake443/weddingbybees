<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';



$sql = "SELECT * FROM package_images";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM general_settings WHERE id = 1";
$result2 = $conn->query($sql2);
$settings2= $result2->fetch_assoc();


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

<div class="dashboard-container">
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h1 class="page-title">Packages</h1>

        <!-- Carousel Section -->
        <div class="carousel-wrapper">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="carousel-card">
                    <img src="../images/packages/<?php echo $row['image']; ?>" alt="Package Image" class="carousel-image">
                    <h2 class="package-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                    <p class="package-description"><?php echo htmlspecialchars($row['description']); ?></p>
                    <p class="package-price">Price: Rs. <?php echo number_format($row['price'], 2); ?></p>
                    <form action="packages.php" method="post" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this package?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <!-- Add New Package Form -->
        <h2 class="form-title">Add a New Package</h2>
        <form action="packages.php" method="POST" enctype="multipart/form-data" class="add-package-form">
            <div class="form-group">
                <label for="new_image" class="form-label">Upload New Image:</label>
                <input type="file" name="new_image" id="new_image" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" id="title" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-input" required></textarea>
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Price:</label>
                <input type="number" step="0.01" name="price" id="price" class="form-input" required>
            </div>
            <button type="submit" name="submit" class="submit-btn">Upload</button>
        </form>

        <!-- Update Packages Text Form -->
        <h2 class="form-title">Update Packages Text</h2>
        <form action="packages.php" method="POST" enctype="multipart/form-data" class="update-text-form">
            <div class="form-group">
                <label for="packages_text" class="form-label">Packages Text:</label>
                <textarea name="packages_text" id="packages_text" class="form-input" required><?php echo htmlspecialchars($settings2['packages_text']); ?></textarea>
            </div>
            <button type="submit" name="update" class="submit-btn">Update Text</button>
        </form>
    </div>
</div>




                <div class="success2" id="alertBox1">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Image Uploaded Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>

                <div class="alert2" id="alertBox2">
                    <i class="fa fa-trash  fa-2x"></i> 
                    <span class="message-text">Image Deleted Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
                <div class="success2" id="alertBox3">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Text Updated Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>




<script src="../js/notifications.js"></script>

</body>
</html>

<?php

if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === 0) {
    $image_name = $_FILES['new_image']['name'];
    $image_tmp_name = $_FILES['new_image']['tmp_name'];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($image_ext, $allowed_ext)) {
        $upload_dir = '../images/packages/';
        $new_image_name = uniqid('', true) . '.' . $image_ext;
        $upload_path = $upload_dir . $new_image_name;

        if (move_uploaded_file($image_tmp_name, $upload_path)) {
            $description = $_POST['description'];
            $price = $_POST['price'];

            $sql = "INSERT INTO package_images (image, description, price,title) VALUES (?, ?, ?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssds", $new_image_name, $description, $price, $_POST['title']);   
            $stmt->execute();

            echo "<script> document.location='packages.php?notifications1=1';</script>";
            exit();
        } else {
            echo "Error uploading the image.";
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}
 
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

       
        $sql = "DELETE FROM package_images WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        echo "<script> document.location='packages.php?notifications2=1';</script>";
    } else {
        
    }
}

?>

<?php
if (isset($_POST['update'])) {
    $text1 = $_POST['packages_text'];
 

   
    $sql = "UPDATE general_settings SET packages_text = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $text1);
    $stmt->execute();

    echo "<script> document.location='packages.php?notifications3=1';</script>";
    exit();
}
?>


<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';



$sql = "SELECT * FROM gallery";
$result = $conn->query($sql);
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
        <h1>Gallery Management</h1>

        <div class="carousel-wrapper">
            <?php while($row = $result->fetch_assoc()) { ?>
                <div class="carousel-image">
                    <img src="../images/gallery/<?php echo $row['image']; ?>" alt="Carousel Image" />
                    <form style="background-color: transparent; border-color: transparent;" action="gallery.php" method="post" onsubmit="return confirm('Are you sure you want to delete this image?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" style="background-color:red;" class="delete">Delete</button>
                    </form>
                </div>
            <?php } ?>
        </div>
        <form action="gallery.php" method="POST" enctype="multipart/form-data">
            <label for="new_image">Upload New Image:</label>
            <input type="file" name="new_image" id="new_image" required>
            <button type="submit" name="submit">Upload</button>
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
              




<script src="../js/notifications.js"></script>

</body>
</html>

<?php

if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === 0) {
    $image_name = $_FILES['new_image']['name'];
    $image_tmp_name = $_FILES['new_image']['tmp_name'];
    $image_size = $_FILES['new_image']['size'];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($image_ext, $allowed_ext)) {
        $upload_dir = '../images/gallery/';
        $new_image_name = uniqid('', true) . '.' . $image_ext;
        $upload_path = $upload_dir . $new_image_name;

        if (move_uploaded_file($image_tmp_name, $upload_path)) {
          
            $sql = "INSERT INTO gallery (image) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $new_image_name);
            $stmt->execute();

            echo "<script> document.location='gallery.php?notifications1=1';</script>";
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

       
        $sql = "DELETE FROM gallery WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        echo "<script> document.location='gallery.php?notifications2=1';</script>";
    } else {
        
    }
}

?>



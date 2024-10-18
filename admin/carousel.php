<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';


$sql = "SELECT * FROM carousel";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding by Bees Carousel Management</title>
    <link rel="stylesheet" href="../css/carousel.css">
    
</head>
<body>

<div class="dashboard-container">
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h1>Carousel Management</h1>

        <div class="carousel-wrapper">
            <?php while($row = $result->fetch_assoc()) { ?>
                <div class="carousel-image">
                    <img src="../images/carousel/<?php echo $row['image']; ?>" alt="Carousel Image" />
                    <form action="carousel.php" method="post" onsubmit="return confirm('Are you sure you want to delete this image?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" style="background-color:red;" class="delete">Delete</button>
                    </form>
                </div>
            <?php } ?>
        </div>
        <form action="carousel.php" method="POST" enctype="multipart/form-data">
            <label for="new_image">Upload New Image:</label>
            <input type="file" name="new_image" id="new_image" required>
            <button type="submit" name="submit">Upload</button>
        </form>

        <?php

$sql = "SELECT * FROM carousel_text LIMIT 1";
$result = $conn->query($sql);
$texts = $result->fetch_assoc(); 


if (!$texts) {
    $default_insert = "INSERT INTO carousel_text (text1, text2, text3) VALUES ('', '', '')";
    $conn->query($default_insert);
    $result = $conn->query($sql);
    $texts = $result->fetch_assoc();
}
?>


        <form action="carousel.php" method="POST">
            <label for="text1">Text 1:</label>
            <input type="text" id="text1" name="text1" value="<?php echo $texts['text1']; ?>" required>
            
            <label for="text2">Text 2:</label>
            <input type="text" id="text2" name="text2" value="<?php echo $texts['text2']; ?>" required>
            
            <label for="text3">Text 3:</label>
            <input type="text" id="text3" name="text3" value="<?php echo $texts['text3']; ?>" required>
            
            <button type="submit" name="update">Update Texts</button>
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
    $image_size = $_FILES['new_image']['size'];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($image_ext, $allowed_ext)) {
        $upload_dir = '../images/carousel/';
        $new_image_name = uniqid('', true) . '.' . $image_ext;
        $upload_path = $upload_dir . $new_image_name;

        if (move_uploaded_file($image_tmp_name, $upload_path)) {
          
            $sql = "INSERT INTO carousel (image) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $new_image_name);
            $stmt->execute();

            echo "<script> document.location='carousel.php';</script>";
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

       
        $sql = "DELETE FROM carousel WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        echo "<script> document.location='carousel.php';</script>";
    } else {
        
    }
}

?>

<?php
if (isset($_POST['update'])) {
    $text1 = $_POST['text1'];
    $text2 = $_POST['text2'];
    $text3 = $_POST['text3'];

   
    $sql = "UPDATE carousel_text SET text1 = ?, text2 = ?, text3 = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $text1, $text2, $text3);
    $stmt->execute();

    echo "<script> document.location='carousel.php';</script>";
    exit();
}
?>


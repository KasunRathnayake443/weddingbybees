<?php
include '../inc/session.php';
include '../inc/config.php';
include '../inc/links.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$sql_categories = "SELECT * FROM categories";
$categories_result = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../inc/title.php'; ?>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <?php include 'header.php'; ?>

    <div class="main-content">
        <h1>Products</h1>

        <div class="carousel-wrapper" style="padding-bottom: 450px;">
            <?php while($row = $result->fetch_assoc()) { ?>
                <div class="carousel-image">
                    <img src="../images/products/<?php echo $row['image_url']; ?>" alt="Product Image" />
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p>Price: Rs. <?php echo number_format($row['price'], 2); ?></p>
                    <p>Category: <?php echo htmlspecialchars($row['category']); ?></p>
                    <p>Quantity: <?php echo htmlspecialchars($row['stock']); ?></p>
                    <form style="background-color: transparent; border-color: transparent;" action="products.php" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" style="background-color:red;" class="delete">Delete</button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <form action="products.php" method="POST" enctype="multipart/form-data">
            <label for="new_image">Upload New Image:</label>
            <input type="file" name="new_image" id="new_image" required>

            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" required>
            
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" id="price" required>

            <label for="category">Category:</label>
                <select name="category" id="category" required>
                    <option value="" disabled selected>Select a category</option>
                     <?php while($category = $categories_result->fetch_assoc()) { ?>
                      <option value="<?php echo $category['name']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                     <?php } ?>
                </select>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required>

            <button type="submit" name="submit">Upload</button>
        </form>
    </div>
</div>




                <div class="success2" id="alertBox1">
                    <i class="fa fa-check  fa-2x"></i> 
                    <span class="message-text">Product Uploaded Successfully</span>                            
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>

                <div class="alert2" id="alertBox2">
                    <i class="fa fa-trash  fa-2x"></i> 
                    <span class="message-text">Product Deleted Successfully</span>                            
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
        $upload_dir = '../images/products/';
        $new_image_name = uniqid('', true) . '.' . $image_ext;
        $upload_path = $upload_dir . $new_image_name;

        if (move_uploaded_file($image_tmp_name, $upload_path)) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $stock = $_POST['quantity'];

            $sql = "INSERT INTO products (name, description, price, image_url, category, stock) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsdi", $name, $description, $price, $new_image_name, $category, $stock);
            $stmt->execute();

            echo "<script> document.location='products.php?notifications1=1';</script>";
            exit();
        } else {
            echo "Error uploading the image.";
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script> document.location='products.php?notifications2=1';</script>";
}
?>

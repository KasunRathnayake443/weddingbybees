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
        <h1 class="page-title">Products</h1>

        <div class="product-grid">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="product-card">
                    <img src="../images/products/<?php echo $row['image_url']; ?>" alt="Product Image" class="product-image" />
                    <div class="product-details">
                        <h2 class="product-name"><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p class="product-description"><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="product-price">Price: Rs. <?php echo number_format($row['price'], 2); ?></p>
                        <p class="product-category">Category: <?php echo htmlspecialchars($row['category']); ?></p>
                        <p class="product-stock">Stock: <?php echo htmlspecialchars($row['stock']); ?></p>
                    </div>
                    <form action="products.php" method="post" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            <?php } ?>
        </div>

        <h2 class="form-title">Add a New Product</h2>
        <?php
        $categories_query = "SELECT * FROM categories";
        $categories_result = mysqli_query($conn, $categories_query);
        ?>
        <form action="products.php" method="POST" enctype="multipart/form-data" class="add-product-form">
            <div class="form-group">
                <label for="new_image" class="form-label">Upload New Image:</label>
                <input type="file" name="new_image" id="new_image" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="name" class="form-label">Product Name:</label>
                <input type="text" name="name" id="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-input" required></textarea>
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Price:</label>
                <input type="number" step="0.01" name="price" id="price" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="product_category" class="form-label">Category:</label>
                <select id="product_category" name="product_category" class="form-input" required>
                    <option value="" disabled selected>Select a Category</option>
                    <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="form-input" required>
            </div>
            <button type="submit" name="submit" class="submit-btn">Upload</button>
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



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_description = mysqli_real_escape_string($conn, $_POST['description']);
    $product_price = floatval($_POST['price']);
    $product_stock = intval($_POST['quantity']);
    $product_category = intval($_POST['product_category']);
    
   
    $image_name = basename($_FILES['new_image']['name']);
    $image_tmp_name = $_FILES['new_image']['tmp_name'];
    $upload_dir = '../images/products/';
    $image_path = $upload_dir . $image_name;

 
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($image_tmp_name, $image_path)) {
       
        $insert_query = "
            INSERT INTO products (name, description, price, stock, category, image_url) 
            VALUES ('$product_name', '$product_description', $product_price, $product_stock, $product_category, '$image_name')
        ";
        
        if (mysqli_query($conn, $insert_query)) {
            echo "<script>
                 
                    document.location = 'products.php?notifications1=1';
                  </script>";
        } else {
            echo "<div class='alert alert-danger'>Database Error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Failed to upload image.</div>";
    }
}


?>


<?php



// if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === 0) {
//     $image_name = $_FILES['new_image']['name'];
//     $image_tmp_name = $_FILES['new_image']['tmp_name'];
//     $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
//     $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

//     if (in_array($image_ext, $allowed_ext)) {
//         $upload_dir = '../images/products/';
//         $new_image_name = uniqid('', true) . '.' . $image_ext;
//         $upload_path = $upload_dir . $new_image_name;

//         if (move_uploaded_file($image_tmp_name, $upload_path)) {
//             $name = $_POST['name'];
//             $description = $_POST['description'];
//             $price = $_POST['price'];
//             $category = $_POST['category'];
//             $stock = $_POST['quantity'];

//             $sql = "INSERT INTO products (name, description, price, image_url, category, stock) VALUES (?, ?, ?, ?, ?, ?)";
//             $stmt = $conn->prepare($sql);
//             $stmt->bind_param("ssdsdi", $name, $description, $price, $new_image_name, $category, $stock);
//             $stmt->execute();

//             echo "<script> document.location='products.php?notifications1=1';</script>";
//             exit();
//         } else {
//             echo "Error uploading the image.";
//         }
//     } else {
//         echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
//     }
// }



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script> document.location='products.php?notifications2=1';</script>";
}
?>

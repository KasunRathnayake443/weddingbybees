<?php
include('inc/config.php');
include('inc/links.php');


// Get the selected category ID from the URL
// Get the selected category ID from the URL
$selected_category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Fetch all categories
$categories_query = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_query);

// Fetch products based on the selected category
if ($selected_category_id > 0) {
    $products_query = "SELECT * FROM products WHERE category = $selected_category_id AND stock > 0";
} else {
    $products_query = "SELECT * FROM products WHERE stock > 0";
}
$products_result = mysqli_query($conn, $products_query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding By Bees-Shop</title>
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../images/logo/<?php echo $result_general['logo']?>" type="image/x-icon">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</head>
<body>

<?php require('header.php'); ?>

<div class="container my-5">
    <h1 class="text-center mb-4" >Our Products</h1>
    
    <div class="container my-4">
    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <h5>Filter by Category</h5>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="shop.php" class="text-decoration-none">All Categories</a>
                </li>
                <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
                    <li class="list-group-item">
                        <a href="shop.php?category_id=<?php echo $category['id']; ?>" 
                           class="text-decoration-none <?php echo $selected_category_id == $category['id'] ? 'fw-bold' : ''; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <!-- Products Section -->
            <div class="col-md-9">
                <div class="row">
                    <?php while ($product = mysqli_fetch_assoc($products_result)): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 d-flex flex-column">
                                <img src="../images/products/<?php echo htmlspecialchars($product['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                    <p class="card-text fw-bold">Rs: <?php echo number_format($product['price'], 2); ?></p>
                                    <div class="mt-auto">
                                        <?php if ($product['stock'] > 0): ?>
                                            <a href="add_to_cart.php?product_id=<?php echo $product['id']; ?>" class="btn btn-primary w-100">Add to Cart</a>
                                        <?php else: ?>
                                            <span class="badge bg-danger w-100">Out of Stock</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

    </div>
</div>


</body>
</html>


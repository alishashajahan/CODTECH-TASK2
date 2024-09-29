<?php
// products.php
include 'db.php'; // Include the database connection

// Initialize search variable
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Check if a product ID is provided for deletion
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    // Prepare the delete statement
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    if ($stmt->execute([$_GET['delete_id']])) {
        echo "<script>alert('Product deleted successfully.');</script>";
    } else {
        echo "<script>alert('Failed to delete product. Please try again.');</script>";
    }
}

// Check if a product ID is provided for fetching details
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Fetch the specific product based on the ID from the URL
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the product data

    // Check if the product was found
    if (!$product) {
        die("Product not found!");
    }
} else {
    // Prepare the SQL query with search functionality
    $sql = "SELECT * FROM products";
    if ($search) {
        $search = $pdo->quote('%' . $search . '%'); // Use PDO's quote to avoid SQL injection
        $sql .= " WHERE name LIKE $search OR description LIKE $search"; // Assuming you want to search by name and description
    }
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title><?php echo isset($product) ? htmlspecialchars($product['name']) : 'All Products'; ?></title>
    <style>
        .proceed-btn {
            background-color: #ff007f; /* Pink/Red background */
            color: white;
            border: none;
        }
    </style>
</head>
<body>
<header class="text-center mb-4">
    <h1><?php echo isset($product) ? htmlspecialchars($product['name']) : 'Our Products'; ?></h1>
    <form method="GET" class="form-inline justify-content-center">
        <input type="text" name="search" class="form-control" placeholder="Search products" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-primary ml-2">Search</button>
    </form>
</header>

<div class="container">
    <div class="row">
        <?php if (isset($product)): ?>
            <!-- Display details for the specific product -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h2>
                        <h5 class="card-text">Description</h5>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
                        <p><strong>Seller:</strong> <?php echo htmlspecialchars($product['seller']); ?></p>
                        <p><strong>Ratings:</strong> <?php echo str_repeat('★', $product['ratings']) . str_repeat('☆', 5 - $product['ratings']); ?></p>
                        
                        <!-- Proceed button to banking details page -->
                        <a href="bank.php?id=<?php echo $product['id']; ?>" class="btn proceed-btn">Proceed</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Display all products -->
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
                            <p><strong>Seller:</strong> <?php echo htmlspecialchars($product['seller']); ?></p>
                            <p><strong>Ratings:</strong> <?php echo str_repeat('★', $product['ratings']) . str_repeat('☆', 5 - $product['ratings']); ?></p>
                            <a href="products.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                            <a href="products.php?delete_id=<?php echo $product['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<a href="index.php" class="btn btn-secondary mt-4">Back to SHAJON</a>
<footer class="text-center mt-4">
    <p>&copy; SHAJON. All Rights Reserved.</p>
</footer>
</body>
</html>

<?php
// sell.php
include 'db.php'; // Include the database connection

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Initialize variables
$name = '';
$description = '';
$price = '';
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);

    // Validate inputs
    if (empty($name) || empty($price)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!is_numeric($price) || $price < 0) {
        $error_message = 'Please enter a valid price.';
    } else {
        // Handle image upload if an image is provided
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $fileType = $_FILES['image']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Allowed file extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Directory in which the uploaded file will be moved
                $uploadFileDir = 'uploads/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }
                // Generate a unique name to prevent overwriting
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path)) 
                {
                    $image = $newFileName;
                }
                else 
                {
                    $error_message = 'There was an error moving the uploaded file.';
                }
            }
            else
            {
                $error_message = 'Upload failed. Allowed file types: ' . implode(', ', $allowedfileExtensions);
            }
        } else {
            // No image uploaded; set image to null or a default image
            $image = null;
        }

        // If no errors, insert the product into the database
        if (empty($error_message)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO products (name, description, price, seller, image) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$name, $description, $price, $_SESSION['username'], $image]);
                $success_message = 'Product added successfully!';
                
                // Clear form fields after successful submission
                $name = '';
                $description = '';
                $price = '';
            } catch (PDOException $e) {
                $error_message = 'Database error: ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sell a Product - SHAJON</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .proceed-btn {
            background-color: #ff007f; /* Pink/Red background */
            color: white;
            border: none;
        }
        .navbar-nav.ml-auto .nav-item .nav-link {
            color: white !important;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">SHAJON</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="sell.php">Sell a Product <span class="sr-only">(current)</span></a>
          </li>
        </ul>
    
        <!-- Search Bar -->
        <form method="GET" class="form-inline my-2 my-lg-0 mr-3">
          <input type="text" name="search" class="form-control mr-2" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    
        <!-- Login/Logout Option -->
        <ul class="navbar-nav ml-auto">
          <?php if (isset($_SESSION['username'])): ?>
              <li class="nav-item">
                  <a class="nav-link" href="#">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logout</a>
              </li>
          <?php else: ?>
              <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="register.php">Register</a>
              </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
    
    <!-- Marquee Text -->
    <div class="marquee" style="background-color: pink; padding: 10px;">
        <marquee behavior="scroll" direction="left">Free shipping on all orders above Rs.199</marquee>
    </div>
    
    <!-- Sell Product Form -->
    <div class="container">
        <h2 class="mt-5">Sell a Product</h2>
    
        <?php if ($success_message): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>
    
        <?php if ($error_message): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
    
        <form method="POST" action="sell.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name <span style="color: red;">*</span>:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
    
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlspecialchars($description); ?></textarea>
            </div>
    
            <div class="form-group">
                <label for="price">Price (Rs.) <span style="color: red;">*</span>:</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" required>
            </div>
    
            <div class="form-group">
                <label for="image">Product Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
    
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
    
    <!-- Include JavaScript files if necessary -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

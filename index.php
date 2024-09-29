<?php
// index.php
include 'db.php'; // Include the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SHAJON</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .marquee {
            background: #f8d7da; /* Light red background for visibility */
            color: #721c24; /* Dark red text color */
            padding: 10px 0; /* Vertical padding */
            font-weight: bold; /* Bold text */
            text-align: center; /* Center the text */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">SHAJON</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="categories.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sell.php">Start Selling</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="contactDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Contact Us
        </a>
        <div class="dropdown-menu" aria-labelledby="contactDropdown">
          <a class="dropdown-item" href="mailto:primary@example.com">alishashajahan1@gmail.com</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="mailto:alternative@example.com">shajahan51@gmail.com</a>
        </div>
      </li>
   
      <li class="nav-item">
        <a class="nav-link" href="about.php">ABOUT</a>
      </li>
    </ul>

    <!-- Search Bar -->
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <!-- Login Option -->
    <ul class="navbar-nav ml-2"> <!-- Adjusted margin for closer alignment -->
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Marquee Text -->
<div class="marquee" style="background-color: pink; padding: 10px;">
    <marquee behavior="scroll" direction="left">Free shipping on all orders above Rs.199</marquee>
</div>


<div class="container">
    <h1>Welcome to SHAJON - SHOES AND BAGS</h1>
    <p>Explore our products by clicking on the "Products" link in the navigation bar.</p>
</div>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHAJON-SHOES AND BAGS</title>
    <style>
        .marquee {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .read-more {
            color: blue;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="marquee">
    <strong style="color: red; font-size: 24px;">SHAJON-SHOES AND BAGS</strong> 
    <br>
    <span style="font-family: 'Times New Roman';">
        SHAJON-SHOES AND BAGS is your one-stop online shop for customized bags, branded shoes, stylish chappals for both ladies and gentlemen, as well as helmets. 
    </span>
    <br>
    <span class="read-more" onclick="toggleDescription()">read more</span>
    <div class="description" style="display: none; font-family: 'Times New Roman';">
        At SHAJON, we understand that style and comfort go hand in hand. Our collection also includes high-quality socks, umbrellas, and raincoats, ensuring that you are prepared for any weather while looking your best. 
        Our commitment to quality and customer satisfaction sets us apart, allowing you to express your unique style through our products. 

        Explore our wide range of options that cater to all your needs, from everyday essentials to special occasions. We aim to provide personalized service to help you find exactly what you're looking for, whether it's a fashionable pair of shoes or a chic bag.

        Join our community of satisfied customers and discover why SHAJON is the preferred choice for stylish footwear and accessories. Stay updated with our latest offerings and promotions, and enjoy an exceptional shopping experience that combines quality, variety, and convenience.

        <br><br>
        <a href="about.php" style="font-family: 'Times New Roman'; color: blue; text-decoration: underline;">More about SHAJON-SHOES AND BAGS</a>
    </div>
</div>

<script>
    function toggleDescription() {
        const description = document.querySelector('.description');
        if (description.style.display === 'none') {
            description.style.display = 'block';
        } else {
            description.style.display = 'none';
        }
    }
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shajon Shoes and Bags</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif; /* Font style for the body */
        }
        .offer-section {
            background-color: rgba(255, 0, 0, 0.8); /* Red background with transparency */
            padding: 50px; /* Space inside the section */
            color: white; /* Text color */
            text-align: center; /* Center the text */
            border-radius: 10px; /* Rounded corners */
            margin: 20px auto; /* Center the box */
            max-width: 800px; /* Max width for the box */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Shadow for the box */
        }
        .offer-heading {
            font-size: 36px; /* Main heading size */
            font-weight: bold; /* Bold text */
        }
        .offer-dates,
        .offer-discount {
            font-size: 24px; /* Subheading size */
            margin: 10px 0; /* Space between headings */
        }
        .offer-description {
            font-size: 18px; /* Description size */
            margin-top: 20px; /* Space above description */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="offer-section">
        <h1 class="offer-heading">Shajon Big Offer Navarathri Sale</h1>
        <h3 class="offer-dates">From 26th Sept to 12th Oct</h3>
        <h3 class="offer-discount">Upto 50% Off</h3>
        <p class="offer-description">
            Don’t miss out on this incredible opportunity to grab your favorite shoes and bags at unbeatable prices. Celebrate Navarathri with style and elegance. Shop now and enjoy amazing discounts!
        </p>
    </div>
</div>


<!-- Footer Section -->
<footer class="footer bg-dark text-white py-1"> <!-- Reduced padding for smaller height -->
    <div class="container">
        <div class="row align-items-center"> <!-- Center items vertically -->
            <!-- Left Section -->
            <div class="col-md-4">
                <p class="text-white mb-0">&copy; 2024 SHAJON-SHOES AND BAGS. All Rights Reserved.</p>
            </div>
            
            <!-- Center Section -->
            <div class="col-md-4 text-center">
                <!-- You can add center content here if needed -->
            </div>
            
            <!-- Right Section -->
            <div class="col-md-4 text-right">
                <a href="faq.php" class="text-white mx-2">| CUSTOMER SERVICE |</a>
                <a href="disclaimer.php" class="text-white mx-2">| Disclaimer |</a>
            </div>
        </div>
    </div>
</footer>

<!-- Optional CSS for footer customization -->
<style>
    .footer {
        position: relative;
        bottom: 0;
        width: 100%;
        background-color: #343a40; /* Dark background color to match bg-dark class */
        padding: 0.100rem 0; /* Reduced padding for smaller height */
    }
    .footer p {
        margin: 0;
        color: #ffffff; /* Ensures the text is white */
        font-size: 0.9rem; /* Optional: Adjust font size for compactness */
    }
    .footer a {
        text-decoration: none;
        color: #ffffff; /* Ensures the link text is white */
    }
</style>


<!-- Include JavaScript files if necessary -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

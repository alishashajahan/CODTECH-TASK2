<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shajon CUSTOMER SERVICE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif; /* Font style for the body */
        }
        .faq-section {
            padding: 50px; /* Space inside the section */
            background-color: #f8f9fa; /* Light background color */
            margin: 20px auto; /* Center the box */
            max-width: 800px; /* Max width for the box */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Shadow for the box */
        }
        .faq-heading {
            text-align: center; /* Center the heading */
            font-size: 32px; /* Main heading size */
            margin-bottom: 20px; /* Space below the heading */
        }
        .faq-item {
            margin-bottom: 15px; /* Space between FAQ items */
        }
        .faq-question {
            font-weight: bold; /* Bold for questions */
            font-size: 18px; /* Question font size */
        }
        .faq-answer {
            font-size: 16px; /* Answer font size */
            margin-left: 20px; /* Indentation for answers */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="faq-section">
        <h1 class="faq-heading">Frequently Asked Questions</h1>

        <div class="faq-item">
            <div class="faq-question">1. What is Shajon?</div>
            <div class="faq-answer">Shajon is your go-to online marketplace for a wide range of shoes and bags, offering great quality and amazing discounts!</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">2. How do I place an order?</div>
            <div class="faq-answer">To place an order, simply browse our collection, select your desired items, and follow the checkout process.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">3. What payment methods are accepted?</div>
            <div class="faq-answer">We accept various payment methods, including credit/debit cards, PayPal, and other secure payment options.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">4. Can I return an item?</div>
            <div class="faq-answer">Yes, you can return any unused item within 30 days of receipt for a full refund or exchange.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">5. How can I contact customer support?</div>
            <div class="faq-answer">You can reach our customer support team via the contact form on our website or by emailing support@shajon.com.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">6. Do you offer international shipping?</div>
            <div class="faq-answer">Yes, we offer international shipping! Check our shipping policy for more details on delivery times and costs.</div>
        </div>

    </div>
</div>

<!-- Include JavaScript files if necessary -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

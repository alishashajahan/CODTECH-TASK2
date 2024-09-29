<?php
// bank_details.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Handle banking details submission
    $accountHolder = $_POST['account_holder'];
    $accountNumber = $_POST['account_number'];
    $bankName = $_POST['bank_name'];

    // Here you would normally handle the storage of the banking details,
    // such as inserting them into a database.
    // For demonstration, we'll just show a success message.
    echo "<div class='alert alert-success'>Banking details submitted successfully!</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Bank Details</title>
</head>
<body>
<div class="container">
    <h4>Enter Your Banking Details</h4>
    <form method="POST" action="">
        <div class="form-group">
            <label for="account_holder">Account Holder Name:</label>
            <input type="text" class="form-control" id="account_holder" name="account_holder" required>
        </div>
        <div class="form-group">
            <label for="account_number">Account Number:</label>
            <input type="text" class="form-control" id="account_number" name="account_number" required>
        </div>
        <div class="form-group">
            <label for="bank_name">Bank Name:</label>
            <input type="text" class="form-control" id="bank_name" name="bank_name" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="products.php" class="btn btn-secondary mt-4">Back to Products</a>
</div>
</body>
</html>

<?php
// login.php
session_start();
include 'db.php'; // Include the database connection

// Initialize variables
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Check if the user is already logged in, if yes then redirect to welcome page or dashboard
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: dashboard.php"); // Replace with your dashboard or home page
    exit;
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, email, password FROM newuser WHERE email = :email";
        
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':email', $param_email);
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if email exists, if yes then verify password
                if ($stmt->rowCount() == 1) {                    
                    // Bind result variables
                    $stmt->bindColumn('id', $id);
                    $stmt->bindColumn('username', $username);
                    $stmt->bindColumn('password', $hashed_password);
                    $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, start a new session
                        
                        // Regenerate session ID to prevent session fixation attacks
                        session_regenerate_id();
                        
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
                        
                        // Redirect user to dashboard or home page
                        header("Location: dashboard.php"); // Replace with your desired page
                        exit();
                    } else {
                        // Password is not valid
                        $login_err = "Invalid email or password.";
                    }
                } else {
                    // Email doesn't exist
                    $login_err = "Invalid email or password.";
                }
            } else {
                $login_err = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->closeCursor();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - SHAJON</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>User Login</h2>
    <p>Please fill in your credentials to login.</p>
    
    <?php 
    // Display success message from registration
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }

    if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }        
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
        <!-- Email -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>    

        <!-- Password -->
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>

        <!-- Link to Registration Page -->
        <p>Don't have an account? <a href="registration.php">Register here</a>.</p>
    </form>
</div>    

</body>
</html>

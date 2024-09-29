<?php
session_start();
include 'db.php'; // Include the database connection

// Initialize variables
$username = $email = $password = "";
$username_err = $email_err = $password_err = $register_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM newuser WHERE email = :email";
        
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':email', $param_email);
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $email_err = "This email is already registered.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                $register_err = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->closeCursor();
        }
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Check input errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO newuser (username, email, password) VALUES (:username, :email, :password)";
         
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username);
            $stmt->bindParam(':email', $param_email);
            $stmt->bindParam(':password', $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_BCRYPT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page with success message
                $_SESSION['success_message'] = "Registration successful. Please login.";
                header("Location: login.php");
                exit();
            } else {
                $register_err = "Something went wrong. Please try again later.";
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
    <title>Register - SHAJON</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>New User Registration</h2>
    <p>Please fill this form to create an account.</p>
    
    <?php 
    if(!empty($register_err)){
        echo '<div class="alert alert-danger">' . $register_err . '</div>';
    }        
    ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
        <!-- Username -->
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($username); ?>">
            <span class="invalid-feedback"><?php echo $username_err;?></span>
        </div>    

        <!-- Email -->
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>">
            <span class="invalid-feedback"><?php echo $email_err;?></span>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label>Password (minimum 6 characters)</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_err;?></span>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Register">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>

        <!-- Link to Login Page -->
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>    

</body>
</html>

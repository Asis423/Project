<html>
<head>
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="signup_page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- This is Sign Up page  -->
    <div class="signup-section">
        <div class="form-box">
            <form action="" method="POST">
                <h2>Sign Up</h2>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-user-circle'></i>
                    </span>
                    <input type="text" name="username" required>
                    <label for="">Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-envelope'></i>
                    </span>
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-mobile'></i>
                    </span>
                    <input type="tel" name="mobile_number" required>
                    <label for="">Mobile No.</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" name="confirm_password" required>
                    <label for="">Confirm Password</label>
                </div>
                <button class="btn">Signup</button>
                <div class="create-account">
                    <p>Already have an Account? <a href="login_page.php" class="signup-link">Sign In</a> </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


<?php
require_once "connection/connection.php";

// Process the signup form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $mobileNumber = $_POST["mobile_number"];

    $errors = array();

    // Perform additional validation checks for email
    if (empty($email)) {
        $errors[] = "Email field is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Perform additional validation checks for username
    if (strlen($username) < 4 || strlen($username) > 20) {
        $errors[] = "Username should be between 3 and 20 characters";
        // You can redirect the user back to the signup form or handle the error accordingly
        // exit;
    }

    // Perform additional validation checks for mobile number
    if (!preg_match('/^\d{10}$/', $mobileNumber)) {
        $errors[] = "Invalid mobile number";
        // You can redirect the user back to the signup form or handle the error accordingly
        // exit;
    }

    if (!preg_match('/^[a-zA-Z ]+$/', $username)) {
        $errors[] = "Username can only contain letters";
        // You can redirect the user back to the signup form or handle the error accordingly
        // exit;
    }

    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $errors[] = "Invalid email address";
    //     // You can redirect the user back to the signup form or handle the error accordingly
    //     exit;
    // }

    // Perform additional validation checks for password
    if (empty($password)) {
        $errors[] = "Password field is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password should be at least 8 characters long";
    }
    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errors[] = "Password must contain at least one letter";
    }
    if (!preg_match("/[0-9]/", $_POST["password"])) {
        $errors[] = "Password must contain at least one number";
    }
    
     // Perform additional validation checks for confirm password
     if (empty($confirmPassword)) {
        $errors[] = "Confirm Password field is required";
    } elseif ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }

    // If there are any errors, handle them accordingly
    if (!empty($errors)) {
        // Use JavaScript to show the errors in an alert
        echo '<script>';
        echo 'var errorMessage = "' . implode('\n', $errors) . '";';
        echo 'alert(errorMessage);';
        echo '</script>';

    } else {
        // Insert the user data into the database
        $sql = "INSERT INTO users (email, password, username, mobile_number)
                VALUES ('$email', '$password', '$username', '$mobileNumber')";

        if ($conn->query($sql) === true) {
            // Redirect to login_page.php when signup is successful
            header("Location: login_page.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // Clear the errors array after displaying the alert
    unset($errors);
}

// Close the database connection
$conn->close();
?>

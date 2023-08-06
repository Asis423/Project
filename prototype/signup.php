<?php
require_once "connection.php";

// Process the signup form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $mobileNumber = $_POST["mobile_number"];

    // Perform additional validation checks for email
    if (empty($email)) {
        $errors[] = "Email field is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Perform additional validation checks for username
    if (strlen($username) < 4 || strlen($username) > 20) {
        echo "Username should be between 3 and 20 characters";
        // You can redirect the user back to the signup form or handle the error accordingly
        exit;
    }

    // Perform additional validation checks for mobile number
    if (!preg_match('/^\d{10}$/', $mobileNumber)) {
        echo "Invalid mobile number";
        // You can redirect the user back to the signup form or handle the error accordingly
        exit;
    }

    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     echo "Invalid email address";
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
    if (isset($errors) && !empty($errors)) {
        // You can display the errors to the user or handle them however you like
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit;
    }

    // Insert the user data into the database
    $sql = "INSERT INTO users (email, password, username, mobile_number)
            VALUES ('$email', '$password', '$username', '$mobileNumber')";

    if ($conn->query($sql) === true) {
        // Redirect to user.php when signup is successful
        header("Location: ../login_page.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


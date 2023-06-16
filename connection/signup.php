<?php

require_once "connection.php";

// Process the signup form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];
    $mobileNumber = $_POST["mobile_number"];

    // Perform additional validation checks for email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        // You can redirect the user back to the signup form or handle the error accordingly
        exit;
    }

    // Perform additional validation checks for password
    if (strlen($password) < 6) {
        echo "Password should be at least 6 characters long";
        // You can redirect the user back to the signup form or handle the error accordingly
        exit;
    }

    // Perform additional validation checks for username
    if (strlen($username) < 3 || strlen($username) > 20) {
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

    // Insert the user data into the database
    $sql = "INSERT INTO users (email, password, username, mobile_number)
            VALUES ('$email', '$password', '$username', '$mobileNumber')";

    if ($conn->query($sql) === true) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>

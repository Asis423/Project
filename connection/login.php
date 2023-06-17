<?php

session_start(); // Start the session

require_once "connection.php";

// Login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate email and password
    $errors = [];

    if (empty($email)) {
        $errors[] = "Email field is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password field is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password should be at least 8 characters long";
    }

    if (empty($errors)) {
        // Perform login process
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User is authenticated
            $_SESSION["email"] = $email; // Store user email in session variable

            // Fetch additional user information from the database
            $sql = "SELECT name, age FROM users WHERE email = '$email'";
            $userInfo = $conn->query($sql)->fetch_assoc();

            if ($userInfo) {
                $name = $userInfo["name"];
                $age = $userInfo["age"];

                // Display the fetched information
                echo "Login successful!<br>";
                echo "Name: " . $name . "<br>";
                echo "Age: " . $age . "<br>";
            } else {
                echo "Failed to fetch user information";
            }

            // Redirect to the dashboard page
            // header("Location: dashboard.php");
            exit;
        } else {
            // Invalid credentials
            echo "Invalid email or password";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

$conn->close();
?>

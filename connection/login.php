<?php
session_start(); // Start the session

require_once "connection.php";

// Login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

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
    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errors[] = "Password must contain at least one letter";
    }
    if (!preg_match("/[0-9]/", $_POST["password"])) {
        $errors[] = "Password must contain at least one number";
    }

    if (empty($errors)) {
        // Perform login process
        if ($role == "admin") {
            $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Admin is authenticated
                $_SESSION["email"] = $email; // Store admin email in session variable

                // Redirect to the admin dashboard page
                header("Location: ../admin/admin_dash.php");
                exit();
            } else {
                $errors[] = "Invalid admin credentials";
            }
        } elseif ($role == "user") {
            $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // User is authenticated
                $_SESSION["email"] = $email; // Store user email in session variable

                // Redirect to the user dashboard page
                header("Location: ../users/user_index.php");
                exit();
            } else {
                $errors[] = "Invalid user credentials";
            }
        }
    }

    if (!empty($errors)) {
        // Display validation errors and alert message
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo '<script>alert("Invalid email or password");</script>';
    }
}

$conn->close();
?>

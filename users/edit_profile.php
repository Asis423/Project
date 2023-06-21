<?php
    session_start(); // Start the session

    // Check if user is not logged in, redirect to login page
    if (!isset($_SESSION['email'])) {
        header("Location: ../login_page.php");
        exit();
    }

    // Include the file containing the database connection code
    include "../connection/connection.php";

    // Retrieve information for the logged-in user
    $userEmail = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email = '$userEmail'";
    $result = mysqli_query($conn, $query);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        $userRow = mysqli_fetch_assoc($result);
        $userId = $userRow['id'];
        $username = $userRow['username'];
        $mobileNumber = $userRow['mobile_number'];
        $userEmail = $userRow['email'];
        $password = $userRow['password'];

        // Process form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newUsername = $_POST['username'];
            $newMobileNumber = $_POST['mobile_number'];
            $newPassword = $_POST['password'];

            // Perform server-side validation
            if (empty($newUsername) || empty($newPassword) || empty($newMobileNumber)) {
                $errorMessage = "Please fill in all the required fields.";
            }
            if (!empty($newMobileNumber) && !preg_match('/^\d{10}$/', $newMobileNumber)) {
                $errorMessage = "Please enter a valid mobile number.<br>";

            } else {
                // Update the user information in the database
                $updateQuery = "UPDATE users SET username = '$newUsername', password = '$newPassword', mobile_number='$newMobileNumber'";
                
                // Only update the mobile_number if it's not empty
                // if (!empty($newMobileNumber)) {
                //     $updateQuery .= ", mobile_number = '$newMobileNumber'";
                // }
                
                // $updateQuery .= " WHERE email = '$userEmail'";
                
                $result = mysqli_query($conn, $updateQuery);

                // Check if the update query was successful
                if ($result) {
                    // Display an alert message using JavaScript
                    echo '<script>alert("User information updated successfully!");';
                    // Redirect the user to users_dash.php after they click "OK"
                    echo 'window.location.href = "users_dash.php";</script>';
                } else {
                    // Display an error message or handle the error
                    echo '<script>alert("Error updating user information!");';
                    // Redirect the user back to the same submission form after they click "OK"
                    echo 'window.location.href = "edit_profile.php";</script>';
                }
            }
        }
    } else {
        echo "<tr><td colspan='6'>No user information found.</td></tr>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
    <!-- Add your CSS styling here -->
    <style>
        /* CSS styling for the form */
        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 4px;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Your Information</h2>

    <!-- HTML form to edit the row's information -->
    <form method="POST" action="">
        <?php if (isset($errorMessage)) {
            echo '<p style="color: red;">' . $errorMessage . '</p>';
        } ?>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>" readonly>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
        
        <label for="mobile_number">Mobile Number:</label>
        <input type="text" id="mobile_number" name="mobile_number" value="<?php echo htmlspecialchars($mobileNumber); ?>">
        
        <input type="submit" value="Update">
    </form>
</body>
</html>

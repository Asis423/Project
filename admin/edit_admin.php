<?php
// edit_admin.php
// Include the connection.php file
require_once '../connection/connection.php';

// Retrieve the ID parameter from the URL
$id = $_GET['id'];

// Fetch the row's information from the database based on the ID
$query = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated information from the form fields
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $newPassword = $_POST['password'];
    $newMobileNumber = $_POST['mobile_number'];

    // Validate the password field
    if (empty($newPassword)) {
        echo '<script>alert("Password field cannot be empty.");</script>';
    } else {
        // Update the corresponding row in the database
        $updateQuery = "UPDATE users SET username = '$newUsername', email = '$newEmail', password = '$newPassword', mobile_number = '$newMobileNumber' WHERE id = '$id'";
        mysqli_query($conn, $updateQuery);

        // Show confirmation prompt to the admin
        echo '<script>
            var confirmed = confirm("Are you sure you want to update the admin information?");
            if (confirmed) {
                var confirmedSubmit = confirm("Admin information updated successfully. Do you want to proceed to dashboard?");
                if (confirmedSubmit) {
                    // document.getElementById("editForm").submit();
                    window.location.href = "admin_dash.php";
                }
            } else {
                // Redirect back to the admin dash page or any other desired location
                window.location.href = "edit_admin.php";
            }
        </script>';
    }
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
            width: 300px;
            margin: 20px auto;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Edit Admin Information</h2>

    <!-- HTML form to edit the row's information -->
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" required>

        <label for="mobile_number">Password:</label>
        <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $row['mobile_number']; ?>" required>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>

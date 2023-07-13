<?php
// edit_gallery.php
require_once '../connection/connection.php';

// Retrieve the ID parameter from the URL
$id = $_GET['id'];

// Fetch the row's information from the database based on the ID
$query = "SELECT * FROM gallery WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Initialization of the variables
$bikeName = $row['bike_name'];
$bikePrice = $row['bike_price'];
$bikeCode = $row['code'];
$bikeImage = $row['bike_image_url'];

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated information from the form fields
    $bikeName = $_POST['bike_name'];
    $bikePrice = $_POST['bike_price'];
    $bikeCode = $_POST['code'];

    // Validate the bike price
    if ($bikePrice < 0) {
        echo '<script>alert("Bike price cannot be negative.");</script>';
    } else {
        // Validate the image field
        if (empty($_FILES['bike_image']['name'])) {
            echo '<script>alert("Image field cannot be empty.");</script>';
        } else {
            // Process the uploaded image
            $targetDirectory = "../img/";  // Specify the directory to upload the images
            $targetFile = $targetDirectory . basename($_FILES['bike_image']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if the uploaded file is an image
            $check = getimagesize($_FILES['bike_image']['tmp_name']);
            if ($check !== false) {
                // Move the uploaded image to the target directory
                if (move_uploaded_file($_FILES['bike_image']['tmp_name'], $targetFile)) {
                    // Update the corresponding row in the database
                    $updateQuery = "UPDATE gallery SET bike_name = '$bikeName', bike_price = '$bikePrice', code = '$bikeCode', bike_image_url = '$targetFile' WHERE id = '$id'";
                    mysqli_query($conn, $updateQuery);

                    // Show confirmation prompt to the admin
                    echo '<script>
                        var confirmed = confirm("Are you sure you want to update the bike information?");
                        if (confirmed) {
                            var confirmedSubmit = confirm("Bike information updated successfully!!!");
                            if (confirmedSubmit) {
                                window.location.href = "gallery.php";
                            }
                        } else {
                            // Redirect back to the edit page or any other desired location
                            window.location.href = "edit_gallery.php?id='.$id.'";
                        }
                    </script>';
                } else {
                    echo "Failed to upload the image.";
                }
            } else {
                echo "Invalid image file.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bike</title>
    <style>
        .edit-bike {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f2f2f2;
        border-radius: 4px;
        }

        .edit-bike h2 {
        text-align: center;
        margin-bottom: 20px;
        }

        .form-group {
        margin-bottom: 20px;
        }

        .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }

        .button-update {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
        }

        .button-update:hover {
        background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="edit-bike">
        <h2>Edit Bike</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- <input type="hidden" name="id" value="<?php echo $id; ?>"> -->
            <div class="form-group">
                <label for="bike_name">Bike Name:</label>
                <input type="text" id="bike_name" name="bike_name" value="<?php echo $bikeName; ?>" required>
            </div>
            <div class="form-group">
                <label for="bike_price">Bike Price:</label>
                <input type="number" name="bike_price" value="<?php echo $bikePrice; ?>" required>
            </div>
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" value="<?php echo $bikeCode; ?>" required>
            </div>
            <div class="form-group">
                <label for="bike_image">Bike Image:</label>
                <input type="file" id="bike_image" name="bike_image" accept="image/*">
            </div>
            <div class="form-group">
                <img src="<?php echo $bikeImage; ?>" alt="Bike Image" style="max-width: 200px; margin-bottom: 10px;">
            </div>
            <div class="form-group">
                <button type="submit" name="update" class="button-update">Update</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
    // edit_specs.php
    require_once '../connection/connection.php';

    // Retrieve the code parameter from the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the row's information from the database based on the code
        $query = "SELECT * FROM specifications WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Check if a row is found
        if ($row) {
            // Initialization of the variables
            $bikeName = $row['bike_name'];
            $bikeImage = $row['background_image_url'];
            $bikeEngine = $row['engine'];
            $bikeMileage = $row['mileage'];
            $bikePeakPower = $row['peak_power'];
            $bikeTorque = $row['torque'];
            $bikeBrakes = $row['brakes'];
            $bikeTires = $row['tires'];
            $bikeBodyType = $row['body_type'];
            $bikePrice = $row['price'];
            $bikeCode = $row['code'];

            // Process the form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve the updated information from the form fields
                $bikeName = $_POST['bike_name'];
                $bikeEngine = $_POST['engine'];
                $bikeMileage = $_POST['mileage'];
                $bikePeakPower = $_POST['peak_power'];
                $bikeTorque = $_POST['torque'];
                $bikeBrakes = $_POST['brakes'];
                $bikeTires = $_POST['tires'];
                $bikeBodyType = $_POST['body_type'];
                $bikePrice = $_POST['price'];
                $bikeCode = $_POST['code'];

                // Validate the bike price
                if ($bikePrice <= 0 || $bikePrice > 99999999) {
                    echo '<script>alert("Bike price must be between 0 & 9999999.99.");</script>';
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
                                $updateQuery = "UPDATE specifications SET bike_name = '$bikeName', engine = '$bikeEngine', mileage = '$bikeMileage', peak_power = '$bikePeakPower', torque = '$bikeTorque', brakes = '$bikeBrakes', tires = '$bikeTires', body_type = '$bikeBodyType', price = '$bikePrice', code = '$bikeCode', background_image_url = '$targetFile' WHERE id = '$id'";
                                mysqli_query($conn, $updateQuery);

                                // Show confirmation prompt to the admin
                                echo '<script>
                                    var confirmed = confirm("Are you sure you want to update the specifications?");
                                    if (confirmed) {
                                        var confirmedSubmit = confirm("Specifications updated successfully!!!");
                                        if (confirmedSubmit) {
                                            window.location.href = "specifications.php";
                                        }
                                    } else {
                                        // Redirect back to the edit page or any other desired location
                                        window.location.href = "edit_specs.php?code=' . $bikeCode . '";
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
        } else {
            echo "No row found for the specified bike code.";
        }
    } else {
        echo "Missing bike code parameter.";
    }
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Specs</title>
    <style>
        .edit-specs {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 4px;
        }

        .edit-specs h2 {
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
        .form-group input[type="number"],
        .form-group input[type="file"] {
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
    <div class="edit-specs">
        <h2>Edit Specifications</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="code">Bike Code:</label>
                <input type="number" id="code" name="code" value="<?php echo $bikeCode; ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="bike_name">Bike Name:</label>
                <input type="text" id="bike_name" name="bike_name" value="<?php echo $bikeName; ?>" required>
            </div>
            <div class="form-group">
                <label for="engine">Engine:</label>
                <input type="text" id="engine" name="engine" value="<?php echo $bikeEngine; ?>" required>
            </div>
            <div class="form-group">
                <label for="mileage">Mileage:</label>
                <input type="text" id="mileage" name="mileage" value="<?php echo $bikeMileage; ?>" required>
            </div>
            <div class="form-group">
                <label for="peak_power">Peak Power:</label>
                <input type="text" id="peak_power" name="peak_power" value="<?php echo $bikePeakPower; ?>" required>
            </div>
            <div class="form-group">
                <label for="torque">Torque:</label>
                <input type="text" id="torque" name="torque" value="<?php echo $bikeTorque; ?>" required>
            </div>
            <div class="form-group">
                <label for="brakes">Brakes:</label>
                <input type="text" id="brakes" name="brakes" value="<?php echo $bikeBrakes; ?>" required>
            </div>
            <div class="form-group">
                <label for="tires">Tires:</label>
                <input type="text" id="tires" name="tires" value="<?php echo $bikeTires; ?>" required>
            </div>
            <div class="form-group">
                <label for="body_type">Body Type:</label>
                <input type="text" id="body_type" name="body_type" value="<?php echo $bikeBodyType; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="<?php echo $bikePrice; ?>" required>
            </div>
            <div class="form-group">
                <label for="bike_image">Upload Image:</label>
                <input type="file" id="bike_image" name="bike_image">
            </div>
            <div class="form-group">
                <img src="<?php echo $bikeImage; ?>" alt="Bike Image" style="max-width: 200px; margin-bottom: 10px;">
            </div>
            <div class="form-group">
                <input type="submit" class="button-update" value="Update Specifications">
            </div>
        </form>
    </div>
</body>
</html>

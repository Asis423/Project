<?php
// create_specs.php
require_once '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the information from the form fields
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

    // Insert the new specification record into the specifications table
    // $insertQuery = "INSERT INTO specifications (code, bike_name, engine, mileage, peak_power, torque, brakes, tires, body_type, price) 
    //                 VALUES ('$bikeCode', '$bikeName', '$bikeEngine', '$bikeMileage', '$bikePeakPower', '$bikeTorque', '$bikeBrakes', '$bikeTires', '$bikeBodyType', '$bikePrice')";
    // mysqli_query($conn, $insertQuery);

    // Process the uploaded image
    $targetDirectory = "../img/";  // Specify the directory to upload the images
    $targetFile = $targetDirectory . basename($_FILES['bike_image']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES['bike_image']['tmp_name']);
    if ($check !== false) {
        // Move the uploaded image to the target directory
        if (move_uploaded_file($_FILES['bike_image']['tmp_name'], $targetFile)) {
            // Insert the corresponding row in the database
            $insertQuery = "INSERT INTO specifications (code, bike_name, engine, mileage, peak_power, torque, brakes, tires, body_type, price, background_image_url) 
            VALUES ('$bikeCode', '$bikeName', '$bikeEngine', '$bikeMileage', '$bikePeakPower', '$bikeTorque', '$bikeBrakes', '$bikeTires', '$bikeBodyType', '$bikePrice', '$targetFile')";
            mysqli_query($conn, $insertQuery);

            // Redirect back to the gallery page or any other desired location
            header('Location: specifications.php');
            exit;
        } else {
            echo "Failed to upload the image.";
        }
    } else {
    echo "Invalid image file.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Specs</title>
    <style>
        .create-specs {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 4px;
        }

        .create-specs h2 {
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

        .button-create {
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

        .button-create:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="create-specs">
        <h2>Create Specifications</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bike_name">Bike Code:</label>
                <input type="number" id="code" placeholder="Enter Bike Code Here" name="code" required>
            </div>
            <div class="form-group">
                <label for="bike_name">Bike Name:</label>
                <input type="text" id="bike_name" placeholder="Enter Bike Name Here" name="bike_name" required>
            </div>
            <div class="form-group">
                <label for="engine">Engine:</label>
                <input type="text" id="engine" placeholder="Enter Engine Details Here" name="engine" required>
            </div>
            <div class="form-group">
                <label for="mileage">Mileage:</label>
                <input type="text" id="mileage" placeholder="Enter Mileage Details Here" name="mileage" required>
            </div>
            <div class="form-group">
                <label for="peak_power">Peak Power:</label>
                <input type="text" id="peak_power" placeholder="Enter Peak Power Details Here" name="peak_power" required>
            </div>
            <div class="form-group">
                <label for="torque">Torque:</label>
                <input type="text" id="torque" placeholder="Enter Torque Details Here" name="torque" required>
            </div>
            <div class="form-group">
                <label for="brakes">Brakes:</label>
                <input type="text" id="brakes" placeholder="Enter Brakes Details Here" name="brakes" required>
            </div>
            <div class="form-group">
                <label for="tires">Tires:</label>
                <input type="text" id="tires" placeholder="Enter Tires Details Here" name="tires" required>
            </div>
            <div class="form-group">
                <label for="body_type">Body Type:</label>
                <input type="text" id="body_type" placeholder="Enter Body Type Here" name="body_type" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" placeholder="Enter Price Here" step="0.01" inputmode="decimal" name="price" required>
            </div>
            <div class="form-group">
                <label for="bike_image">Background Image:</label>
                <input type="file" id="bike_image" name="bike_image" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button-create">Create</button>
            </div>
        </form>
    </div>
</body>
</html>

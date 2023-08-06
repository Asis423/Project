<?php
    // create_bike.php
    require_once '../connection/connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the information from the form fields
        $bikeName = $_POST['bike_name'];
        $bikePrice = $_POST['bike_price'];
        $code = $_POST['code'];

        // Process the uploaded image
        $targetDirectory = "../img/";  // Specify the directory to upload the images
        $targetFile = $targetDirectory . basename($_FILES['bike_image']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        // Check if the uploaded file is an image
        $check = getimagesize($_FILES['bike_image']['tmp_name']);
        if ($check !== false) {
            // Move the uploaded image to the target directory
            if (move_uploaded_file($_FILES['bike_image']['tmp_name'], $targetFile)) {
                // Insert the new bike record into the gallery table
                $insertQuery = "INSERT INTO gallery (bike_name, bike_image_url, bike_price, code) VALUES ('$bikeName', '$targetFile', '$bikePrice', '$code')";
                mysqli_query($conn, $insertQuery);

                // Redirect back to the gallery page or any other desired location
                header('Location: gallery.php');
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
    <title>Create Bike</title>
    <style>
        .create-bike {
  max-width: 500px;
  margin: 20px auto;
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 4px;
}

.create-bike h2 {
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
    <div class="create-bike">
        <h2>Create Bike</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="bike_name">Bike Name:</label>
                <input type="text" id="bike_name" placeholder="Enter Bike Name Here" name="bike_name" required>
            </div>
            <div class="form-group">
                <label for="bike_price">Bike Price:</label>
                <input type="number" name="bike_price" placeholder="Enter Bike Price Here" step="0.01" inputmode="decimal" required>
            </div>
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" placeholder="Enter Bike Code here" name="code" required>
            </div>
            <div class="form-group">
                <label for="bike_image">Bike Image:</label>
                <input type="file" id="bike_image" name="bike_image" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button-create">Create</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
  // Make a database connection and query to retrieve bike information
  require_once '../connection/connection.php';

  $query = "SELECT * FROM gallery";
  $result = $conn->query($query);

  // Prepare the data array to store bike information
  $bikeData = [];

  // Fetch the bike data and store it in the data array
  if ($result && $result->num_rows > 0) {
    while ($bike = $result->fetch_assoc()) {
      $bikeData[] = array(
        'id' => $bike['id'],
        'bike_name' => $bike['bike_name'],
        'background_image_url' => $bike['background_image_url'],
        'logo_image_url' => $bike['logo_image_url'],
        'engine' => $bike['engine'],
        'mileage' => $bike['mileage'],
        'displacement' => $bike['displacement'],
        'peak_power' => $bike['peak_power'],
        'torque' => $bike['torque'],
        'brakes' => $bike['brakes'],
        'tires' => $bike['tires'],
        'fuel_capacity' => $bike['fuel_capacity'],
        'cylinders' => $bike['cylinders'],
        'body_type' => $bike['body_type'],
        'price' => $bike['price'],
        'code' => $bike['code'],
      );
    }
  } else {
    $bikeData[] = "No bike data available";
  }

  // Close the database connection
  $conn->close();

  // Return the bike data as JSON
  header('Content-Type: application/json');
  echo json_encode($bikeData);
?>

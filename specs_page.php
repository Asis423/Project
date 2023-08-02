<?php
  require_once 'connection/connection.php';

  // Start the session
  session_start();

  // Retrieve the bike code from the query parameter
  $bikeCode = $_GET['code'];

  // Fetch the specifications for the given bike code from the database
  // Modify the following code based on your database structure and query method

  // Prepare and execute the query to fetch the specifications based on the bike code
  $sql = "SELECT * FROM specifications WHERE code = '$bikeCode'";
  $result = $conn->query($sql);

  // Check if any rows are returned from the query
  if ($result->num_rows > 0) {
    // Fetch the specifications data
    $row = $result->fetch_assoc();
    $bikeName = $row['bike_name'];
    $bgImgUrl = $row['background_image_url'];
    $bikeEngine = $row['engine'];
    $bikeMileage = $row['mileage'];
    $bikePeakPower = $row['peak_power'];
    $bikeTorque = $row['torque'];
    $bikeBrakes = $row['brakes'];
    $bikeTires = $row['tires'];
    $bikeBodyType = $row['body_type'];
    $bikePrice = $row['price'];
    $bikeQty = $row['qty'];
  } else {
    // If no rows are returned, display an error message or handle the case accordingly
    echo "No specifications found for the given bike code.";
  }

  // Check if the user is logged in
  $loggedIn = isset($_SESSION['email']);

  // Check if the user is an admin
  $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

  // Close the database connection
  $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="specs_page.css">
  <style>
      body {
        display: flex;
        background-image: url("img/<?php echo $bgImgUrl; ?>");
        background-size: cover;
        background-position: center;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100vw;
      }
  </style>
</head>
<body>
  <div class="logo">
    <img src="img/logo.png" alt="Logo">
  </div>
  <h1><?php echo $bikeName; ?></h1>
  <div class="container">
      <h2>Specifications</h2>
      <div class="specs">
      
      <table>
        <tr>
          <th>Engine</th>
          <td><?php echo $bikeEngine; ?></td>
        </tr>
        <tr>
          <th>Mileage</th>
          <td><?php echo $bikeMileage; ?></td>
        </tr>
        <tr>
          <th>Peak Power</th>
          <td><?php echo $bikePeakPower; ?></td>
        </tr>
        <tr>
          <th>Torque</th>
          <td><?php echo $bikeTorque; ?></td>
        </tr>
        <tr>
          <th>Brakes</th>
          <td><?php echo $bikeBrakes; ?></td>
        </tr>
        <tr>
          <th>Tires</th>
          <td><?php echo $bikeTires; ?></td>
        </tr>
        <tr>
          <th>Body Type</th>
          <td><?php echo $bikeBodyType; ?></td>
        </tr>
        <tr>
          <th>Quantity</th>
          <td><?php echo $bikeQty; ?></td>
        </tr>
      </table>
    </div>
    <div class="price">
        <span>Price: Rs. <?php echo $bikePrice; ?> Lakh* /-</span>
    </div>
  </div>
  <?php if ($loggedIn && !$isAdmin) { ?>
    <!-- Button to book the bike for logged-in non-admin users -->
    <div class="book-btn">
      <a href="booking_page.php?code=<?php echo $bikeCode; ?>">Book Now</a>
    </div>
  <?php } elseif ($loggedIn && $isAdmin) { ?>
    <!-- Button to redirect to admin bookings page for admin users -->
    <div class="book-btn">
      <a href="admin/bookings.php">Admin Bookings</a>
    </div>
  <?php } else { ?>
    <!-- Button to redirect to login page for non-logged-in users -->
    <div class="book-btn">
      <a href="login_page.php">Book Now</a>
    </div>
  <?php } ?>
</body>
</html>

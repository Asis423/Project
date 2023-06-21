<?php
  // Make an AJAX request to fetch bike data from the database

  $curl = curl_init();
  $url = 'localhost/Project/gallery_fetch.php';
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($curl);
  curl_close($curl);
  $bikeData = json_decode($response, true);

  // Check if bike data is available
  if (!empty($bikeData)) {
    foreach ($bikeData as $bike) {
      $bikeName = $bike['bike_name'];
      $bikeImg = $bike['background_image_url'];
      $bikePrice = $bike['price'];
      $bikeCode = $bike['code'];

      // Fetch specifications for each bike based on the code
      $specsCurl = curl_init();
      $specsUrl = 'localhost/Project/booking/specifications.php?code=' . $bikeCode;
      curl_setopt($specsCurl, CURLOPT_URL, $specsUrl);
      curl_setopt($specsCurl, CURLOPT_RETURNTRANSFER, true);
      $specsResponse = curl_exec($specsCurl);
      curl_close($specsCurl);
      $specsData = json_decode($specsResponse, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bike.css">
</head>
<body>
  <div class="bg-container">
    <img src="../img/<?php echo $bikeImg; ?>" alt="Background Image">
  </div>
  <div class="logo">
    <img src="../img/logo.png" alt="logo">
  </div>
  <h1><?php echo $bikeName; ?></h1>
  <div class="container">
      <h2>Specifications</h2>
      <div class="specs">
      
      <table>
        <?php foreach ($specsData as $spec) { ?>
          <tr>
            <th><?php echo $spec['spec_name']; ?></th>
            <td><?php echo $spec['spec_value']; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <div class="price">
        <span><?php echo $bikePrice; ?></span>
    </div>
  </div>
  <div class="book-btn">
    <a href="../signup_page.php">Book Now</a>
  </div>
</body>
</html>

<?php
    }
  } else {
    echo '<p>No bike data available</p>';
  }
?>

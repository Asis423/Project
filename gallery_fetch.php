<?php
// Include the connection.php file
require_once 'connection/connection.php';

// Query to retrieve bike information
$query = "SELECT * FROM gallery";
$result = $conn->query($query);

// Prepare the data array to store bike information
$data = [];

// Fetch the bike data and store it in the data array
if ($result && $result->num_rows > 0) {
    while ($bike = $result->fetch_assoc()) {
        $data[] = $bike;
    }
} else {
    echo '<p>No bike data available</p>';
}

// Close the database connection
$conn->close();

// Return the bike data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

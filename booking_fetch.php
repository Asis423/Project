<?php
// Perform the booking insertion
include "connection/connection.php";

// Retrieve the JSON payload from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);

// Extract the insert query from the payload
$insertQuery = $data['query'];

if (mysqli_query($conn, $insertQuery)) {
    // Booking insertion successful
    $bookingId = mysqli_insert_id($conn);
    echo $bookingId;
} else {
    // Booking insertion failed
    http_response_code(500); // Set appropriate HTTP response code for error
    echo "Error";
}
?>

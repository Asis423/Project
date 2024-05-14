<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
} else {
    include "connection/connection.php";

    // Check if the bike_code is provided in the URL
    if (isset($_GET['code'])) {
        $bikeCode = $_GET['code'];

        // Retrieve user ID from the session
        $userEmail = $_SESSION['email'];
        $queryUser = "SELECT id FROM users WHERE email = '$userEmail'";
        $resultUser = mysqli_query($conn, $queryUser);
        $rowUser = mysqli_fetch_assoc($resultUser);
        $userId = $rowUser['id'];

        // Retrieve bike name and price from the specifications table
        $querySpecs = "SELECT bike_name, price FROM specifications WHERE code = '$bikeCode'";
        $resultSpecs = mysqli_query($conn, $querySpecs);
        $rowSpecs = mysqli_fetch_assoc($resultSpecs);
        $bikeName = $rowSpecs['bike_name'];
        $bikePrice = $rowSpecs['price'];

         // Set the time zone to Kathmandu (Nepal Standard Time)
        date_default_timezone_set('Asia/Kathmandu');
        
        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s');

        // Calculate the start date and end date
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime('+10 days'));

        // Set the status as a string 'pending'
        $status = 'pending';

        // Create the insert query
        $insertQuery = "INSERT INTO bookings (bike_code, user_id, bike_name, price, start_date, end_date, status, time)
                        VALUES ('$bikeCode', '$userId', '$bikeName', '$bikePrice', '$startDate', '$endDate', '$status', '$currentDateTime')";

        // Perform the insertion operation
        if (mysqli_query($conn, $insertQuery)) {
            $bookingId = mysqli_insert_id($conn); // Retrieve the auto-generated id
            // Redirect to the user's bookings page after successful booking
            header("Location: users/my_booking.php?id=$bookingId");
            exit();
        } else {
            // Handle the case when the booking insertion fails
            echo '<script>alert(\'Booking failed. Please try again.\');</script>';
            header("Location: specs_page.php?code=$bikeCode");
            exit();
        }
    } else {
        // Handle the case when bike_code is not provided
        // Redirect to an error page or display an error message
    }
}
?>

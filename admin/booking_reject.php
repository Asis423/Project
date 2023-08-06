<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login_page.php");
    exit();
} else {
    include "../connection/connection.php";

    if (isset($_GET['id'])) {
        $bookingId = $_GET['id'];

        // Update the status to 'approved' in the bookings table
        $updateQuery = "UPDATE bookings SET status = 'rejected' WHERE id = '$bookingId'";
        if (mysqli_query($conn, $updateQuery)) {
            // Redirect back to the bookings page after successful approval
            header("Location: booking.php");
            exit();
        } else {
            // Handle the case when the update fails
            echo '<script>alert(\'Booking rejection failed. Please try again.\');</script>';
            header("Location: booking.php");
            exit();
        }
    } else {
        // Handle the case when booking ID is not provided
        // Redirect to an error page or display an error message
        header("Location: booking.php");
        exit();
    }
}
?>

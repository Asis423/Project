<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login_page.php");
    exit();
} else {
    include "../connection/connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $bookingId = $_GET['id'];

        // Delete the booking from the bookings table
        $deleteQuery = "DELETE FROM bookings WHERE id = '$bookingId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            // Show success message
            echo "<script>
                var message = 'Booking deleted successfully';
                alert(message);
                // Redirect back to the My Bookings page or any other desired location
                window.location.href = 'my_booking.php';
            </script>";
        } else {
            // Display error message
            echo "<script>
                var message = 'Failed to delete the booking';
                alert(message);
                // Redirect back to the My Bookings page or any other desired location
                window.location.href = 'my_booking.php';
            </script>";
        }

        // Prevent further execution of the script
        exit;
    }
}
?>

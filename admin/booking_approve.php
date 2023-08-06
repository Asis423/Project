<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login_page.php");
    exit();
} else {
    include "../connection/connection.php";

    if (isset($_GET['id'])) {
        $bookingId = $_GET['id'];

        // Check if the booking is already approved
        $checkApprovalQuery = "SELECT status FROM bookings WHERE id = '$bookingId' AND status = 'approved'";
        $resultApproval = mysqli_query($conn, $checkApprovalQuery);

        if (mysqli_num_rows($resultApproval) === 0) {
            // Update the status to 'approved' in the bookings table
            $updateQuery = "UPDATE bookings SET status = 'approved' WHERE id = '$bookingId'";
            if (mysqli_query($conn, $updateQuery)) {
                // Retrieve the bike code associated with the booking
                $bikeCodeQuery = "SELECT bike_code FROM bookings WHERE id = '$bookingId'";
                $resultBikeCode = mysqli_query($conn, $bikeCodeQuery);
                $rowBikeCode = mysqli_fetch_assoc($resultBikeCode);
                $bikeCode = $rowBikeCode['bike_code'];
            
                // Decrement the quantity of the bike in the specifications table, only if quantity is greater than 0
                $decrementQuery = "UPDATE specifications SET qty = GREATEST(qty - 1, 0) WHERE code = '$bikeCode'";
                mysqli_query($conn, $decrementQuery);
            
                // Check the updated quantity of the bike
                $checkQtyQuery = "SELECT qty FROM specifications WHERE code = '$bikeCode'";
                $resultQty = mysqli_query($conn, $checkQtyQuery);
                $rowQty = mysqli_fetch_assoc($resultQty);
                $quantity = $rowQty['qty'];
            
                if ($quantity === 0) {
                    // If the quantity becomes zero, update the booking status to 'Out of Stock'
                    $updateBookingStatusQuery = "UPDATE bookings SET status = 'No Stock' WHERE id = '$bookingId'";
                    mysqli_query($conn, $updateBookingStatusQuery);
                }

                // Redirect back to the bookings page after successful approval
                header("Location: booking.php");
                exit();
            } else {
                // Handle the case when the update fails
                echo '<script>alert(\'Booking approval failed. Please try again.\');</script>';
                header("Location: booking.php");
                exit();
            }
        } else {
            // If the booking is already approved, display a message or redirect accordingly
            echo '<script>alert(\'This booking is already approved.\');</script>';
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

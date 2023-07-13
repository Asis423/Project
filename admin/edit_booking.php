<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login_page.php");
    exit();
} else {
    include "../connection/connection.php";

    if (isset($_GET['id'])) {
        $bookingId = $_GET['id'];

        // Fetch the booking details from the database
        $query = "SELECT * FROM bookings WHERE id = '$bookingId'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Check if the booking exists
        if ($row) {
            // Handle the form submission for updating the booking
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve the updated values from the form
                $userId = $_POST['user_id'];
                $bikeCode = $_POST['bike_code'];
                $bikeName = $_POST['bike_name'];
                $bikePrice = $_POST['price'];
                $bookingTime = $_POST['time'];
                $bookStartDate = $_POST['start_date'];
                $bookEndDate = $_POST['end_date'];
                $bookingStatus = $_POST['status'];

                // Update the booking in the database
                $query = "UPDATE bookings SET 
                            user_id = '$userId',
                            bike_code = '$bikeCode',
                            bike_name = '$bikeName',
                            price = '$bikePrice',
                            time = '$bookingTime',
                            start_date = '$bookStartDate',
                            end_date = '$bookEndDate',
                            status = '$bookingStatus'
                            WHERE id = '$bookingId'";

                $result = mysqli_query($conn, $query);

                // Show confirmation prompt to the admin
                echo '<script>
                var confirmed = confirm("Are you sure you want to update the booking?");
                if (confirmed) {
                    var confirmedSubmit = confirm("Booking updated successfully!");
                    if (confirmedSubmit) {
                        window.location.href = "bookings.php";
                    }
                } else {
                    // Redirect back to the edit page or any other desired location
                    window.location.href = "edit_booking.php?id=' . $bookingId . '";
                }
            </script>';
        }
    } else {
        echo "No booking found for the specified ID.";
    }
    } else {
    echo "Missing booking ID parameter.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <!-- Add your CSS styling here -->
</head>
<body>
    <h2>Edit Booking</h2>

    <form method="POST">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" value="<?php echo $row['user_id']; ?>" required>
        <!-- Add other fields for bike_code, bike_name, price, time, start_date, end_date, status -->

        <button type="submit">Update</button>
    </form>
</body>
</html>

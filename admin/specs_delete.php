<?php
// delete_gallery.php
require_once '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the bike code for displaying in the success message
    $getCodeQuery = "SELECT code FROM specifications WHERE id = $id";
    $result = mysqli_query($conn, $getCodeQuery);
    $row = mysqli_fetch_assoc($result);
    $bikeCode = $row['code'];

    // Delete the row from the specifications table
    $deleteQuery = "DELETE FROM specifications WHERE id = $id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        // Show success message
        echo "<script>
            var message = 'The bike of code \'$bikeCode\' has been deleted successfully';
            alert(message);
            // Redirect back to the specifications page or any other desired location after 5 seconds
            setTimeout(function() {
                window.location.href = 'specifications.php';
            }, 2000);
        </script>";
    } else {
        // Display error message
        echo "<script>
            var message = 'Failed to delete the bike';
            alert(message);
            // Redirect to specifications.php
            window.location.href = 'specifications.php';
        </script>";
    }

    // Prevent further execution of the script
    exit;
}
?>

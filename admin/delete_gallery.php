<?php
// delete_gallery.php
require_once '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the bike code for displaying in the success message
    $getCodeQuery = "SELECT code FROM gallery WHERE id = $id";
    $result = mysqli_query($conn, $getCodeQuery);
    $row = mysqli_fetch_assoc($result);
    $bikeCode = $row['code'];

    // Display confirmation alert
    echo "<script>
        if (confirm('Are you sure you want to delete this bike?')) {
            // User confirmed, proceed with deletion
            // Delete the row from the gallery table
            var deleteQuery = 'DELETE FROM gallery WHERE id = $id';
            fetch(deleteQuery)
                .then(response => response.json())
                .then(data => {
                    // Show success message
                    var message = `The bike of code '${bikeCode}' has been deleted successfully`;
                    alert(message);
                    // Redirect back to the gallery page or any other desired location after 5 seconds
                    setTimeout(function() {
                        window.location.href = 'gallery.php';
                    }, 3000);
                })
                .catch(error => console.log(error));
        } else {
            // User canceled, redirect to gallery.php
            window.location.href = 'gallery.php';
        }
    </script>";

    // Prevent further execution of the script
    exit;
}
?>

<?php
// Start session and include necessary files
session_start();
include "../connection/connection.php";
include 'setting.php';

// Check if the eSewa response contains success status
if ($_GET['status'] === 'success') {
    // Retrieve transaction details from the eSewa response
    $transaction_uuid = $_GET['transaction_id']; // Assuming eSewa provides a transaction ID in the URL
    $amount = $_GET['amount']; // Assuming eSewa provides the transaction amount in the URL
    // Add any other relevant transaction details you want to store in the database

    // Prepare INSERT query to insert transaction details into the database
    $query = "INSERT INTO transactions (transaction_uuid, amount) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $transaction_uuid, $amount);

    // Execute the query
    if ($stmt->execute()) {
        // Transaction details successfully inserted into the database
        echo "Transaction details inserted successfully.";
    } else {
        // Error occurred while inserting transaction details
        echo "Error: " . $conn->error;
    }
} else {
    // Transaction was not successful, handle accordingly (e.g., display an error message)
    echo "Transaction was not successful.";
}
?>

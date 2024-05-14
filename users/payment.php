<?php
// Start session and include necessary files
session_start();
include "../connection/connection.php";
include '../esewa/setting.php';

// Check if the eSewa response contains the necessary parameters
if (isset($_POST['response_body_base64'])) {
    // Decode the response body from Base64
    $response_body_base64 = $_POST['response_body_base64']; // Assuming you receive the Base64-encoded response body from eSewa
    $response_body_json = base64_decode($response_body_base64);
    $response_data = json_decode($response_body_json, true);

    // Verify the signature
    $received_signature = $response_data['signature']; // Signature received from eSewa
    // Generate the signature using the same method used for the request's signature
    $generated_signature = calculateSignature($response_data['total_amount'], $response_data['transaction_uuid'], $response_data['product_code'], $secretKey);
    // Compare the received signature with the generated signature
    if ($received_signature === $generated_signature) {
        // Signatures match, proceed with processing the response
        $status = $response_data['status'];
        $transaction_code = $response_data['transaction_code'];
        $total_amount = $response_data['total_amount'];
        // Extract any other relevant information from the response

        // Process the response based on the status and other information
        if ($status === 'COMPLETE') {
            // Transaction was successful, perform necessary actions (e.g., update database)
            // Insert transaction details into the database, etc.
            $transaction_uuid = $response_data['transaction_uuid']; // Assuming eSewa provides a transaction UUID in the response
            // Prepare INSERT query to insert transaction details into the database
            $query = "INSERT INTO transactions (transaction_uuid, transaction_code, total_amount) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $transaction_uuid, $transaction_code, $total_amount);

            // Execute the query
            if ($stmt->execute()) {
                // Transaction details successfully inserted into the database
                echo "Transaction details inserted successfully.";
            } else {
                // Error occurred while inserting transaction details
                echo "Error: " . $conn->error;
            }
        } else {
            // Transaction was not successful, handle accordingly
            echo "Transaction was not successful.";
        }
    } else {
        // Signatures do not match, handle accordingly (e.g., reject the response)
        echo "Signature verification failed. Response may be tampered with.";
    }
} else {
    // Required parameters are missing in the eSewa response, handle accordingly
    echo "Error: Required parameters missing in the eSewa response.";
}
?>

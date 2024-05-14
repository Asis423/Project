<?php

session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ../login_page.php");
        exit();
    } else {
    include "../connection/connection.php";
    
    include 'setting.php';

    // Retrieve the logged-in user's email
    $userEmail = $_SESSION['email'];

    // Fetch specifications from the database
    $bikeCode = $_GET['code'];
    $sql = "SELECT * FROM specifications WHERE code = '$bikeCode'"; // Modify the query based on your requirements
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $spec = $result->fetch_assoc();

        // Parameters for the transaction
        $amount = $spec['price']; // Fetching the price from specifications
        $tax_amount = "25" - $amount; // Sample tax amount, you can fetch this from the specifications if needed
        $total_amount = $amount + $tax_amount; // Calculating total amount
        $transaction_uuid = uuidv4();
        $product_code = "EPAYTEST";
        $product_service_charge = "0";
        $product_delivery_charge = "0";
        $success_url = "http://localhost/project/users/my_booking.php"; // Redirect URL after successful payment
        $failure_url = "http://localhost/project/users/user_index.php"; // Redirect URL after failed or pending transaction

        // Generate HMAC signature
        $signature = calculateSignature($total_amount, $transaction_uuid, $product_code, $secretKey);
    } else {
        echo "Error: No specifications found for the provided bike code.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSewa Payment</title>
</head>
<body>
    <form id = "payment-form" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>" required>
        <input type="hidden" id="tax_amount" name="tax_amount" value="<?php echo $tax_amount; ?>" required>
        <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $total_amount; ?>" required>
        <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>" required>
        <input type="hidden" id="product_code" name="product_code" value="<?php echo $product_code; ?>" required>
        <input type="hidden" id="product_service_charge" name="product_service_charge" value="<?php echo $product_service_charge; ?>" required>
        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="<?php echo $product_delivery_charge; ?>" required>
        <input type="hidden" id="success_url" name="success_url" value="<?php echo $success_url; ?>" required>
        <input type="hidden" id="failure_url" name="failure_url" value="<?php echo $failure_url; ?>" required>
        <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
        <input type="hidden" id="signature" name="signature" value="<?php echo $signature; ?>" required>
        <!-- <input value="Submit" type="submit"> -->
    </form>
    <script>
        // Automatically submit the form when the page loads
        window.onload = function() {
            document.getElementById('payment-form').submit();
        };
    </script>
</body>
</html>

<?php
    session_start();

    // Check if session is not set, redirect to homepage
    if (!isset($_SESSION['email'])) {
        header("Location: ../index.php");
        exit();
    }

    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to homepage
    header("Location: ../index.php");
    exit();
?>


<!-- <script>
    // Logout button click event
    document.querySelector(".logout").addEventListener("click", function(e) {
        e.preventDefault();
        // Redirect to home page
        window.location.href = "../index.php";
    });
</script> -->
<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ../login_page.php");
        exit();
    } else {
        include "../connection/connection.php";
        
        // Query to get the tuser booking count
        // $query = "SELECT COUNT(*) as my_booking FROM booking";
        // $result = mysqli_query($conn, $query);
        // $row = mysqli_fetch_assoc($result);
        // $bookingCount = $row['my_booking'];

        // Count the number of bikes on gallery
        $query = "SELECT COUNT(*) AS bike_count FROM gallery";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $bikeCount = $row['bike_count'];
    }

    // Check if user is not logged in, redirect to login page
    if (!isset($_SESSION['email'])) {
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard</title>
    <link rel="stylesheet" href="users_dash.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
</head>
<body>
    <div class="dashboard">
        <section id="sidebar">
            <div class="icon1">
                <img src="users_img/users.png" alt="Logo1">
            </div>
            <ul class="side-menu top">
                <li>
                    <a href="user_index.php">
                        <i class='bx bxs-home'></i>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li>
                    <a href="users_dash.php">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="my_booking.php">
                        <i class='bx bxs-calendar-alt'></i>
                        <span class="text">My Bookings</span>
                    </a>
                </li>
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="../connection/logout.php" class="logout" onclick="return confirm('Are you sure you want to log out?')">
                        <i class='bx bxs-log-out-circle'></i>
                        <span class="text">Logout</span>
                    </a>
                </li>
            </ul>
        </section>

        <section class="main">
            <section class="right-upper">
                <div class="right_about">
                    <div>
                        <p><?php echo $_SESSION['email']; ?></p>
                    </div>
                    <div class="profile">
                        <img src="users_img/user-logo.png" alt="Avatar" class="avatar">
                    </div>
                    <!-- <div class="notification_icon">
                        <button class="notification_btn" title="Notification">
                            <a href="#"><span class="material-symbols-outlined">notifications</span></a>
                        </button>
                    </div> -->
                </div>
            </section>
            <section class="right-lower">
                <ul class="box-info">
                    <li>
                        <i class='bx bx-calendar bx-icon'></i>
                        <span class="text">
                            <!-- <h3><?php echo $bookingCount; ?></h3> -->
                            <p>My<br>Bookings</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-wallet bx-icon'></i>
                        <span class="text">
                            <h3><?php echo $bikeCount; ?></h3>
                            <p>Total<br>Bikes</p>
                        </span>
                    </li>
                </ul>
                <section class="admin-table">
                    <h2>My Information</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Action</th>
                                <!-- <th>Action</th> -->
                                <!-- Add more columns as per your admin table structure -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Retrieve information for the logged-in user
                                $userEmail = $_SESSION['email'];
                                $query = "SELECT * FROM users WHERE email = '$userEmail'";
                                $result = mysqli_query($conn, $query);

                                // Check if the query returned any rows
                                if (mysqli_num_rows($result) > 0) {
                                    $userRow = mysqli_fetch_assoc($result);
                                    $userId = $userRow['id'];
                                    $username = $userRow['username'];
                                    $mobileNumber = $userRow['mobile_number'];
                                    $userEmail = $userRow['email'];
                                    $password = $userRow['password'];

                                    // Mask the password
                                    $maskedPassword = substr($password, 0, 2) . str_repeat("*", strlen($password) - 2);

                                    // Add the user information to the table
                                    echo "<tr>";
                                    echo "<td>" . $userId . "</td>";
                                    echo "<td>" . $username . "</td>";
                                    echo "<td>" . $mobileNumber . "</td>";
                                    echo "<td>" . $userEmail . "</td>";
                                    echo "<td>" . $maskedPassword . "</td>";
                                    // Add more columns as per your admin table structure

                                    // Add buttons for CRUD operations
                                    echo "<td><a href='edit_profile.php?id=" . $userId . "'><button class='button-edit'>Change</button></a></td>";
                                    echo "</tr>";
                                } else {
                                    echo "<tr><td colspan='5'>No user information found.</td></tr>";
                                }
                            ?>
                    </table>
                </section>
            </section>
        </section>
    </div>
</body>
</html>


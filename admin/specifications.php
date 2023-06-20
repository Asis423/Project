<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../connection/login.php");
    exit();
} else {
    include "../connection/connection.php";

    // Count the number of users
    $query = "SELECT COUNT(*) AS user_count FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $userCount = $row['user_count'];

    // Count the number of admins
    $query = "SELECT COUNT(*) AS admin_count FROM admin";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $adminCount = $row['admin_count'];

    // Query to get the total booking count
    // $query = "SELECT COUNT(*) as total_booking FROM booking";
    // $result = mysqli_query($conn, $query);
    // $row = mysqli_fetch_assoc($result);
    // $bookingCount = $row['total_booking'];

    // Count the number of bikes
    $query = "SELECT COUNT(*) AS bike_count FROM gallery";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $bikeCount = $row['bike_count'];
}

// Check if the user is not logged in, redirect to the login page
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
    <title>Specifications</title>
    <link rel="stylesheet" href="specifications.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
</head>
<body>
    <div class="dashboard">
        <section id="sidebar">
            <div class="icon1">
                <img src="admin_img/admin.png" alt="Logo1">
            </div>
            <ul class="side-menu top">
                <li>
                    <a href="admin_dash.php">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <i class='bx bx-user'></i>
                        <span class="text">Customer</span>
                    </a>
                </li>
                <li>
                    <a href="gallery.php">
                        <i class='bx bxs-folder '></i>
                        <span class="text">Gallery</span>
                    </a>
                </li>
                <li>
                    <a href="specifications.php">
                        <i class='bx bxs-folder '></i>
                        <span class="text">Specifications</span>
                    </a>
                </li>
                <li>
                    <a href="booking.php">
                        <i class='bx bxs-calendar-alt'></i>
                        <span class="text">Booking</span>
                    </a>
                </li>
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="#">
                        <i class='bx bxs-cog'></i>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="logout">
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
                        <img src="admin_img/admin_avatar.png" alt="Avatar" class="avatar">
                    </div>
                    <div class="notification_icon">
                        <button class="notification_btn" title="Notification">
                            <a href="#"><span class="material-symbols-outlined">notifications</span></a>
                        </button>
                    </div>
                </div>
            </section>
            <section class="right-lower">
                <ul class="box-info">
                    <li>
                        <i class='bx bx-user user-icon'></i>
                        <span class="text">
                            <h3><?php echo $userCount; ?></h3>
                            <p>No. of Users</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-user-circle admin-icon'></i>
                        <span class="text">
                            <h3><?php echo $adminCount; ?></h3>
                            <p>No. of Admins</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-calendar booking-icon'></i>
                        <span class="text">
                            <!-- <h3><?php echo $bookingCount; ?></h3> -->
                            <p>Total Booking</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-wallet booking-icon'></i>
                        <span class="text">
                            <h3><?php echo $bikeCount; ?></h3>
                            <p>Total Bikes</p>
                        </span>
                    </li>
                </ul>

                <section class="admin-table">
                    <h2>Specifications of Bikes</h2>
                    <table class="table">
                        <tr>
                            <th>Bike Name</th>
                            <th>Background Image URL</th>
                            <th>Engine</th>
                            <th>Mileage</th>
                            <th>Brakes</th>
                            <th>Tires</th>
                            <th>Body Type</th>
                            <th>Price</th>
                            <th>Code</th>
                            <th colspan="2">Action</th>
                        </tr>
                        <?php
                        // Fetch specifications data from the database
                        $query = "SELECT * FROM specifications";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $bikeName = $row['bike_name'];
                            $backgroundImageUrl = $row['background_image_url'];
                            $engine = $row['engine'];
                            $mileage = $row['mileage'];
                            $brakes = $row['brakes'];
                            $tires = $row['tires'];
                            $bodyType = $row['body_type'];
                            $price = $row['price'];
                            $code = $row['code'];

                            echo "<tr>";
                            echo "<td>$bikeName</td>";
                            echo "<td>$backgroundImageUrl</td>";
                            echo "<td>$engine</td>";
                            echo "<td>$mileage</td>";
                            echo "<td>$brakes</td>";
                            echo "<td>$tires</td>";
                            echo "<td>$bodyType</td>";
                            echo "<td>$price</td>";
                            echo "<td>$code</td>";

                            // Add buttons for CRUD operations
                            echo "<td><a href='edit_specs.php?id=" . $row['id'] . "'><button class='button-edit'>Edit</button></a></td>";
                            echo "<td><a href='delete_specs.php?id=" . $row['id'] . "'><button class='button-delete'>Delete</button></a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Add the Create button -->
                <div class="create-button">
                    <button onclick="location.href='create_specs.php'" class="button-create">Create</button>
                </div>

            </section>
        </section>
    </section>
</div>
</body>
</html>
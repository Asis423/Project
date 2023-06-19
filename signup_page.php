<html>
<head>
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="signup_page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- This is Sign Up page  -->
    <div class="signup-section">
        <div class="form-box">
            <form action="connection/signup.php" method="POST">
                <h2>Sign Up</h2>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-user-circle'></i>
                    </span>
                    <input type="text" name="username" required>
                    <label for="">Username</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-envelope'></i>
                    </span>
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-mobile'></i>
                    </span>
                    <input type="tel" name="mobile_number" required>
                    <label for="">Mobile No.</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" name="password" required>
                    <label for="">Confirm Password</label>
                </div>
                <button class="btn">Signup</button>
                <div class="create-account">
                    <p>Already have an Account? <a href="login_page.php" class="signup-link">Sign In</a> </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
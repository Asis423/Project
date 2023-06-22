<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="login_page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <!-- This is the login page -->
    <div class="login-section">
        <div class="form-box">
            <form action="connection/login.php" method="POST">
                <h2>Login</h2>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-envelope'></i>
                    </span>
                    <input type="email" name="email" required>
                    <label for="">Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <i class='bx bxs-lock-alt'></i>
                    </span>
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <div class="role-selection">
                    <label for="role">Select Role:</label>
                    <select name="role" id="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="remember-password">
                    <label for=""><input type="checkbox" name="" id="">Remember Me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button class="btn">Login</button>
                <div class="create-account">
                    <p>Don't have an Account? <a href="signup_page.php" class="login-link">Register</a> </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

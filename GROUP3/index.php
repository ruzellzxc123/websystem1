<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glassmorphism Login</title>
    <link rel="stylesheet" href="style.css">
    <link href='style.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Welcome</h2>
            <p class="subtitle">Sign in to your account</p>
            
            <form id="loginForm">
                <div class="input-group">
                    <input type="email" id="email" placeholder="Email Address" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" placeholder="Password" required>
                    <i class='bx bx-show eye-icon'></i>
                </div>

                <div class="options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit" class="sign-in-btn">Sign In</button>
            </form>
            <p class="footer-text">Don't have an account? <a href="#">Sign up</a></p>
        </div>
    </div>
    <script src="JS/script.js"></script>
</body>
</html>
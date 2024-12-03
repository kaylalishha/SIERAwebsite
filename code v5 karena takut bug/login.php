<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIERA</title>
    <link href='login.css' rel='stylesheet'>
</head>
<body>
    <div class="login-container">
        <div class="login-image">
            <!-- Video background -->
            <video autoplay loop muted playsinline>
                <source src="Assets/Onboarding-video.mp4" type="video/mp4">
            </video>
        </div>
        <div class="login-form">
            <div class="login-card">
                <img src="Assets/patribera-logo.png" alt="SIERA Logo" class="logo">
                <h2><span class="welcome">Login To Your</span> <span class="highlight">ACCOUNT</span></h2>
                

                <?php
                    if (isset($_GET['error'])) {
                        echo "<p style='color:red;'>" . htmlspecialchars($_GET['error']) . "</p>";
                    }
                ?>
                <form id="login-form" method="post" action="login_verification.php">
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <div class="remember">
                        <input type="checkbox" id="remember-me" name="remember">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

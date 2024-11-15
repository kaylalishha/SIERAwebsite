<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    
</head>
<body>
    <!-- Navbar with logo -->
    <div class="navbar">
        <img src="Assets/patribera-logo.png" alt="Logo" class="logo">
    </div>

    <!-- Main content (Login form) -->
    <div class="login-container">
        <!-- Tampilkan pesan kesalahan jika ada -->
        <?php
            if (isset($_GET['error'])) {
                echo "<p style='color:red;'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
        ?>
        <h2>Log In to your <span class="highlight">Account!</span></h2>
        <form id="login-form" method="post" action="login_verification.php">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <div class="remember">
                <input type="checkbox" id="remember">
                <label for="remember">Remember username</label>
            </div>
            <button class="login-btn" type="submit">Login!</button>
        </form>
        
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="Assets/patribera-logo.png" alt="Logo">
                <div class="footer-info">
                    <h1>SIERA</h1>
                    <p>Sistem Informasi PATRIBERA</p>
                </div>
            </div>
            <div class="footer-links">
                <div class="footer-pages">
                    <h3>Pages</h3>
                    <ul>
                        <li>Home</li>
                        <li>Cari Pengguna</li>
                        <li>Tugas</li>
                        <li>Profile</li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><img src="Assets/call.png" alt="Phone"> 081234567899 (chat only)</li>
                        <li><img src="Assets/mesages.png" alt="Email"> PATRIBERAUPNVJ@gmail.com</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright © Kelompok 7. Made at FIK UPNVJ for Praktikum Pemrograman Web</p>
        </div>
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIERA</title>
    <style>
        /* General styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Arial', sans-serif;
            background-color: #6BB478;
        }

        /* Login container */
        .login-container {
            display: flex;
            height: 100%;
        }

        /* Left side (video) */
        .login-image {
            flex: 1.5;
            background-color: black;
            position: relative;
            overflow: hidden;
        }

        .login-image video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            object-fit: cover;
        }

        /* Right side (login form) */
        .login-form {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-card {
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }

        .login-card .logo {
            display: block;
            margin: 0 auto 20px; /* Centered and spacing */
            width: 100px; /* Adjust size as needed */
            height: auto;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #6BB478;
        }

        .login-card p {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .login-card .welcome {
            color: black;
            font-weight: bold;
        }

        .login-card .account {
            color: #333;
            font-weight: normal;
        }

        .login-card form {
            display: flex;
            flex-direction: column;
        }

        .login-card input {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-card button {
            background-color: #6BB478;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-card button:hover {
            background-color: #57a166;
        }

        .login-card .remember {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .login-card .remember input {
            margin-right: 5px;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-image {
                flex: 1;
                height: 300px;
            }

            .login-form {
                padding: 20px;
            }

            .login-card {
                max-width: 100%;
            }
        }

        .highlight {
            color: #6BB478; /* Ubah warna teks */
            font-weight: bold; /* Tebalkan teks */
            background-color: #eaf6ea; /* Tambahkan background highlight */
            padding: 0 5px; /* Memberikan ruang antara teks dan background */
            border-radius: 5px; /* Memberikan sudut melengkung */
        }

        /* Style for aligning checkbox and label */
        .remember {
            display: flex;
            align-items: center; /* Vertically align the checkbox and label */
            gap: 10px; /* Space between checkbox and text */
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #555;
            margin-bottom: 20px; /* Add space below the checkbox section */
        }

        .remember input[type="checkbox"] {
            width: 20px; /* Standard checkbox size */
            height: 20px;
            margin: 0; /* Remove default margin */
        }

        .remember label {
            cursor: pointer; /* Make it clickable */
        }
    </style>
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

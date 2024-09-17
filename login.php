<?php
session_start();
require 'dbc.php'; // Include the database connection

$error = ""; // Initialize the error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = htmlspecialchars($_POST['username']);
    $pass = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($pass, $hashed_password)) {
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);

            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user;
            $_SESSION['user_id'] = $id; // Store the user ID in the session

            // Redirect to previous page if stored, otherwise default to index.php
            if (isset($_SESSION['redirect_url'])) {
                $redirect_url = $_SESSION['redirect_url'];
                unset($_SESSION['redirect_url']); // Clear the stored URL
                header("Location: $redirect_url");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
}

$conn->close();

// Store the current page URL in session
if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Happy Store</title>

<link rel="shortcut icon" href="./assets/images/logo/mobileicon.ico" type="image/x-icon">
<link rel="stylesheet" href="./assets/css/style-prefix.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>

<div class="modal" data-modal>
    <div class="modal-content">
        <div class="newsletter-img">
            <img src="./assets/images/newsletter.png" alt="subscribe newsletter" width="400" height="400">
        </div>
        <div class="newsletter">
            <form action="login.php" method="POST">
                <div class="newsletter-header">
                    <h3 class="newsletter-title">Log in to Happy Store.</h3>
                    <p class="newsletter-desc">
                        Log in to <b>Happy Store</b> to get the latest products and discount updates.
                    </p>
                </div>
                <input type="text" name="username" class="email-field" placeholder="username" required autocomplete="username">
                <input type="password" name="password" class="email-field" placeholder="password" required autocomplete="current-password">
                <button type="submit" class="btn-newsletter">Login</button>
                <div>
                    <p>Don't have an account yet?</p>
                    <button class="btn-newsletter" type="button" onclick="window.location.href='signup.php'">Sign Up</button>
                </div>
                <?php
                if (!empty($error)) {
                    echo "<p style='color: red;'>$error</p>";
                }
                ?>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>

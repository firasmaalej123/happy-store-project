<?php
session_start();
require 'dbc.php'; // Include the database connection

$error = ""; // Initialize the error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = htmlspecialchars($_POST['username']);
    $pass = $_POST['password'];
    $tel_number = $_POST['tel_number'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $zip_code = $_POST['zip_code'];

    // Hash the password
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, password, tel_number, country, address, zipcode) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $user, $hashed_password, $tel_number, $country, $address, $zip_code);

    if ($stmt->execute()) {
        // Registration successful
      

        // Redirect to a protected page, for example:
        header("Location: login.php");
        exit();
    } else {
        $error = "Error registering user";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Happy Store - Sign Up</title>

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
            <form action="signup.php" method="POST">
                <div class="newsletter-header">
                    <h3 class="newsletter-title">Sign Up for Happy Store.</h3>
                    <p class="newsletter-desc">
                        Join <b>Happy Store</b> to access exclusive offers and updates.
                    </p>
                </div>
                <input type="text" name="username" class="email-field" placeholder="Username" required autocomplete="username">
                <input type="password" name="password" class="email-field" placeholder="Password" required autocomplete="new-password">
                <input type="tel" name="tel_number" class="email-field" placeholder="Telephone Number" required>
                <select name="country" class="email-field" required>
                    <option value="" disabled selected>Select Governorate</option>
                    <option value="Tunis">Tunis</option>
<option value="Ariana">Ariana</option>
<option value="Ben Arous">Ben Arous</option>
<option value="Manouba">Manouba</option>
<option value="Nabeul">Nabeul</option>
<option value="Zaghouan">Zaghouan</option>
<option value="Bizerte">Bizerte</option>
<option value="Béja">Béja</option>
<option value="Jendouba">Jendouba</option>
<option value="Kef">Kef</option>
<option value="Siliana">Siliana</option>
<option value="Kairouan">Kairouan</option>
<option value="Kasserine">Kasserine</option>
<option value="Sidi Bouzid">Sidi Bouzid</option>
<option value="Sousse">Sousse</option>
<option value="Monastir">Monastir</option>
<option value="Mahdia">Mahdia</option>
<option value="Sfax">Sfax</option>
<option value="Gafsa">Gafsa</option>
<option value="Tozeur">Tozeur</option>
<option value="Kebili">Kebili</option>
<option value="Gabès">Gabès</option>
<option value="Medenine">Medenine</option>
<option value="Tataouine">Tataouine</option>

                    <!-- Add other countries as needed -->
                </select>
                <input type="text" name="address" class="email-field" placeholder="Address" required>
                <input type="text" name="zip_code" class="email-field" placeholder="Zip Code" required>
                <button type="submit" class="btn-newsletter">Sign Up</button>
                <div>
                    <p>Already have an account?</p>
                    <button class="btn-newsletter" type="button" onclick="window.location.href='login.php'">Log In</button>
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

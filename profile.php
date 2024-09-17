<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
require 'dbc.php';

// Function to update user profile
function updateProfile($conn, $user) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $tel_number = $_POST['tel_number'];
        $country = $_POST['country'];
        $address = $_POST['address'];
        $zip_code = $_POST['zip_code'];

        // Update user profile information in the database
        $stmt = $conn->prepare("UPDATE users SET tel_number = ?, country = ?, address = ?, zipcode = ? WHERE username = ?");
        $stmt->bind_param("sssss", $tel_number, $country, $address, $zip_code, $user);

        if ($stmt->execute()) {
            // Redirect back to profile page after successful update
            header("Location: profile.php");
            exit();
        } else {
            // Handle update failure
            echo "Error updating profile: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Initialize variables
$user = $_SESSION['username'];
$tel_number = '';
$country = '';
$address = '';
$zip_code = '';

// Retrieve user profile information
$stmt = $conn->prepare("SELECT tel_number, country, address, zipcode FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($tel_number, $country, $address, $zip_code);
$stmt->fetch();
$stmt->close();

// Process form submission and update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    updateProfile($conn, $user);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile - Happy Store</title>

<link rel="shortcut icon" href="./assets/images/logo/mobileicon.ico" type="image/x-icon">
<link rel="stylesheet" href="./assets/css/style-prefix.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff; /* White background */
        margin: 0;
        padding: 0;
    }
    header {
        background-color: #f4cccc; /* Rose bébé background */
        color: #333; /* Dark text color */
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .logo img {
        height: 40px;
    }
    .user {
        text-align: right;
    }
    .user a {
        color: #333;
        text-decoration: none;
        margin-left: 10px;
        background-color: #333;
        color: #fff;
        padding: 8px 16px;
        border-radius: 4px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .user a:hover {
        background-color: #555;
    }
    main {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff; /* White background */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    .profile-info {
        margin-bottom: 20px;
    }
    .profile-info p {
        font-size: 16px;
        margin-bottom: 10px;
    }
    .modify-form {
        border-top: 1px solid #ddd;
        padding-top: 20px;
    }
    .modify-form form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .modify-form form label {
        flex-basis: 100%;
        font-weight: bold;
    }
    .modify-form form input,
    .modify-form form select {
        width: calc(50% - 5px);
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .modify-form form button {
        width: 100%;
        background-color: #f4cccc; /* Rose bébé button */
        color: #333; /* Dark text color */
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .modify-form form button:hover {
        background-color: #f99; /* Lighter rose bébé on hover */
    }
    .history button {
        width: 100%;
        background-color: #f4cccc; /* Rose bébé button */
        color: #333; /* Dark text color */
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .history button:hover  {
        background-color: #f99; /* Lighter rose bébé on hover */
    }

</style>

</head>
<body>

<header>
    <div class="logo">
        <img src="./assets/images/logo/logo.svg" alt="Happy Store Logo">
    </div>
    <div class="user">
        <a href="index.php" class="action-btn">Home</a>
        <a href="logout.php" class="action-btn">Logout</a>
    </div>
</header>

<main>
    

    <div class="modify-form">
        <h2><?php echo $_SESSION['username']; ?> Profile</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        
            <label for="tel_number">Telephone Number:</label>
            <input type="tel" id="tel_number" name="tel_number" value="<?php echo htmlspecialchars($tel_number); ?>" required>

            <label for="country">Country:</label>
            <select id="country" name="country" required>
    <?php
    // Define an array of Tunisian governorates
    $governorates = [
        'Tunis', 'Ariana', 'Ben Arous', 'Manouba', 'Nabeul',
        'Zaghouan', 'Bizerte', 'Béja', 'Jendouba', 'Kef',
        'Siliana', 'Kairouan', 'Kasserine', 'Sidi Bouzid', 'Sousse',
        'Monastir', 'Mahdia', 'Sfax', 'Gafsa', 'Tozeur',
        'Kebili', 'Gabès', 'Medenine', 'Tataouine'
    ];

    // Loop through the array to create options
    foreach ($governorates as $governorate) {
        // Set selected attribute if the user's country matches the option
        $selected = ($country === $governorate) ? 'selected' : '';
        echo "<option value=\"$governorate\" $selected>$governorate</option>";
    }
    ?>
</select>


            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>

            <label for="zip_code">Zip Code:</label>
            <input type="text" id="zip_code" name="zip_code" value="<?php echo htmlspecialchars($zip_code); ?>" required>

            <button type="submit">Update Profile</button>
          
        
        </form>

        
    </div>
    <div class="history">
    <button  id="orderHistoryBtn">Order History</button>
    </div>

</main>

<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
document.getElementById("orderHistoryBtn").onclick = function() {
    window.location.href = 'order_history.php';
};
</script>

</body>
</html>

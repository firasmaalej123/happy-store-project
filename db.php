<?php
// Database configuration
$host = 'localhost'; // Your host name
$dbname = 'happy_store'; // Your database name
$username = 'root'; // Your database username
$password = 'MEDALIdammak123@'; // Your database password

// PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set PDO attributes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Disable prepared statement emulation

    // Optional: Additional settings if needed
    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

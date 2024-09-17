<?php
session_start();
include 'dbc.php';

// Debug output to check session
error_log("Session user_id: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Not set'));

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $productId = intval($_POST['product_id']);

    $insertQuery = "INSERT INTO shopping_cart (user_id, product_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $userId, $productId);
        $result = mysqli_stmt_execute($stmt);
        
        if ($result) {
            // Successfully added to cart
            $message = "Product added to cart successfully!";
            // Redirect to the previous page
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Error adding to cart
            echo "Error: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing statement
        echo "Error: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);


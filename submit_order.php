<?php
// Ensure session is started
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Include database connection
include('dbc.php');

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Retrieve cart items
$query = "SELECT shopping_cart.id, shopping_cart.product_id, products.product_name, products.price 
          FROM shopping_cart 
          INNER JOIN products ON shopping_cart.product_id = products.product_id 
          WHERE shopping_cart.user_id = $user_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Initialize order total
    $total_amount = 0;

    // Prepare order details for insertion into orders table
    $order_details = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $price = $row['price'];

        // Calculate total amount
        $total_amount += $price;

        // Collect order details for display or further processing
        $order_details[] = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'price' => $price
        );
    }

    // Insert order into orders table (simplified example)
    $insert_query = "INSERT INTO orders (user_id, total_amount, order_date) 
                    VALUES ($user_id, $total_amount, NOW())";
    if (mysqli_query($conn, $insert_query)) {
        $order_id = mysqli_insert_id($conn); // Get the ID of the inserted order

        // Insert order details into order_details table (simplified example)
        foreach ($order_details as $detail) {
            $product_id = $detail['product_id'];
            $product_name = $detail['product_name'];
            $price = $detail['price'];

            $insert_detail_query = "INSERT INTO order_details (order_id, product_id, product_name, price) 
                                   VALUES ($order_id, $product_id, '$product_name', $price)";
            mysqli_query($conn, $insert_detail_query);
        }

        // Clear user's shopping cart after successful order submission
        $clear_cart_query = "DELETE FROM shopping_cart WHERE user_id = $user_id";
        mysqli_query($conn, $clear_cart_query);

        // Display confirmation message or redirect to a confirmation page
        $_SESSION['order_confirmation'] = true; // Set a session variable for confirmation page

        header("Location: order_confirmation.php");
        exit();
    } else {
        // Handle error in inserting order
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // No items in the cart, handle accordingly
    echo "Your cart is empty.";
}

// Close database connection
mysqli_close($conn);

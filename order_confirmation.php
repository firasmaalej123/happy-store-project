<?php
session_start();

// Check if the user has completed an order
if (!isset($_SESSION['order_confirmation']) || $_SESSION['order_confirmation'] !== true) {
    // Redirect to the cart page or handle unauthorized access
    header("Location: cart.php");
    exit();
}

// Clear the order confirmation session variable to prevent displaying on refresh
unset($_SESSION['order_confirmation']);

// Include database connection
include('dbc.php');

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Retrieve order details from the database
$query = "SELECT orders.id AS order_id, orders.total_amount, orders.order_date, order_details.product_name, order_details.price
          FROM orders
          INNER JOIN order_details ON orders.id = order_details.order_id
          WHERE orders.user_id = $user_id
          ORDER BY orders.order_date DESC
          LIMIT 1"; // Assuming we want to display the most recent order

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Initialize an array to store all products in the order
    $order_info = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        // Store each product as an element in the $order_info array
        $order_info[] = array(
            'order_id' => $row['order_id'],
            'total_amount' => $row['total_amount'],
            'order_date' => $row['order_date'],
            'product_name' => $row['product_name'],
            'price' => $row['price']
        );
    }
} else {
    // Handle error or no order found
    $order_info = null;
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        /* Basic CSS for styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .confirmation-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .order-details {
            margin-top: 20px;
        }
        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .order-details th, .order-details td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        .order-details th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h2>Order Confirmation</h2>
        
        <?php if ($order_info): ?>
            <div class="order-details">
                <p><strong>Your order is confirmed. Enjoy!</strong></p>
                <p><strong>Total Amount:</strong> <?php echo number_format($order_info[0]['total_amount'], 2); ?> TND</p>
                <p><strong>Order Date:</strong> <?php echo date('Y-m-d H:i:s', strtotime($order_info[0]['order_date'])); ?></p>
                
                
            </div>
        <?php else: ?>
            <p>No order found or error retrieving order details.</p>
        <?php endif; ?>
        
        <p><a href="order_history.php">order history</a></p>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset some default styles */
body, h2, h3, p, table {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    padding: 20px;
}

/* User details */
h2 {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border-radius: 5px;
}

p {
    margin: 5px 0;
    padding: 5px 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* Order details */
h3 {
    background-color: #2196F3;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-top: 20px;
}

form {
    margin: 10px 0;
}

input[type="submit"] {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #d32f2f;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
}

table th, table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f4f4f4;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}




    </style>
    <title>orders</title>
</head>
<body>
    


<?php
include 'dbc.php'; // Ensure this file contains the necessary database connection code

// Fetch only users who have made orders and related order details information
$sql = "
    SELECT 
        users.user_id,
        users.username,
        users.tel_number,
        users.address,
        users.country,
        users.zipcode,
        orders.id AS order_id,
        orders.order_date,
        orders.total_amount,
        order_details.product_id,
        order_details.product_name,
        order_details.price
    FROM users
    JOIN orders ON users.user_id = orders.user_id
    JOIN order_details ON orders.id = order_details.order_id
    ORDER BY users.user_id, orders.id, order_details.order_detail_id
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $current_user_id = null;
    $current_order_id = null;

    while($row = $result->fetch_assoc()) {
        if ($current_user_id != $row['user_id']) {
            if ($current_order_id !== null) {
                echo "</table>";
                $current_order_id = null;
            }

            $current_user_id = $row['user_id'];

            echo "<h2>User: " . $row['username'] . "</h2>";
            echo "<p><strong>Telephone Number:</strong> " . $row['tel_number'] . "</p>";
            echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
            echo "<p><strong>Country:</strong> " . $row['country'] . "</p>";
            echo "<p><strong>ZIP Code:</strong> " . $row['zipcode'] . "</p>";
        }

        if ($current_order_id != $row['order_id']) {
            if ($current_order_id !== null) {
                echo "</table>";
            }

            $current_order_id = $row['order_id'];

            echo "<h3>Order ID: " . $row['order_id'] . "</h3>";
            echo "<p><strong>Order Date:</strong> " . $row['order_date'] . "</p>";
            echo "<p><strong>Total Amount:</strong> $" . $row['total_amount'] . "</p>";
            echo "<form method='post' action='remove_order.php'>
                    <input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                    <input type='submit' value='Remove Order'>
                  </form>";

            echo "<table border='1'>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                    </tr>";
        }

        echo "<tr>
                <td>" . $row['product_id'] . "</td>
                <td>" . $row['product_name'] . "</td>
                <td>$" . $row['price'] . "</td>
              </tr>";
    }

    if ($current_order_id !== null) {
        echo "</table>";
    }
} else {
    echo "No users found.";
}

$conn->close();
?>
</body>
</html>
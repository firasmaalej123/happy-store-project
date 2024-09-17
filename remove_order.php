<?php
include 'dbc.php'; // Ensure this file contains the necessary database connection code

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Get the user ID associated with the order
        $sql_get_user_id = "SELECT user_id FROM orders WHERE id = ?";
        $stmt_get_user_id = $conn->prepare($sql_get_user_id);
        $stmt_get_user_id->bind_param("i", $order_id);
        $stmt_get_user_id->execute();
        $stmt_get_user_id->bind_result($user_id);
        $stmt_get_user_id->fetch();
        $stmt_get_user_id->close();

        // Delete order details
        $sql_delete_order_details = "DELETE FROM order_details WHERE order_id = ?";
        $stmt_delete_order_details = $conn->prepare($sql_delete_order_details);
        $stmt_delete_order_details->bind_param("i", $order_id);
        $stmt_delete_order_details->execute();
        $stmt_delete_order_details->close();

        // Delete order
        $sql_delete_order = "DELETE FROM orders WHERE id = ?";
        $stmt_delete_order = $conn->prepare($sql_delete_order);
        $stmt_delete_order->bind_param("i", $order_id);
        $stmt_delete_order->execute();
        $stmt_delete_order->close();

        // Check if the user has any other orders
        $sql_check_user_orders = "SELECT COUNT(*) FROM orders WHERE user_id = ?";
        $stmt_check_user_orders = $conn->prepare($sql_check_user_orders);
        $stmt_check_user_orders->bind_param("i", $user_id);
        $stmt_check_user_orders->execute();
        $stmt_check_user_orders->bind_result($order_count);
        $stmt_check_user_orders->fetch();
        $stmt_check_user_orders->close();

        if ($order_count == 0) {
            // User has no other orders, remove the user from the display
            // (Note: Adjust if needed, this example does not remove user from database, only display logic)
            echo "User has no other orders.";
        }

        // Commit transaction
        $conn->commit();

        header("Location: display_orders.php");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Error removing order: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}

$conn->close();

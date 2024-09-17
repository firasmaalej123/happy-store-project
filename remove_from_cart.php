<?php
include('dbc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $cart_item_id = $_POST['id'];

    // Perform the deletion from the shopping cart table
    $delete_query = "DELETE FROM shopping_cart WHERE id = $cart_item_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        // Redirect back to the cart page after successful removal
        header("Location: cart.php");
        exit();
    } else {
        // Handle error if deletion fails
        echo "Error: Failed to remove item from cart.";
    }
} else {
    // Redirect to cart page if accessed directly without POST data
    header("Location: cart.php");
    exit();
}

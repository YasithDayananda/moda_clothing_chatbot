<?php
// Include database connection file
include 'db_connection.php';

// Get product ID from the form submission
$product_id = $_POST['product_id'];

// Validate and sanitize input
$product_id = intval($product_id); // Convert to integer to prevent SQL injection

// Check if product_id is valid
if ($product_id > 0) {
    // Example: Assuming you have a table `orders` and a session to track user ID
    session_start();
    $user_id = $_SESSION['user_id']; // Ensure the user is logged in and has a user_id

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, order_date) VALUES (?, ?, 1, NOW())");
    $stmt->bind_param('ii', $user_id, $product_id);

    if ($stmt->execute()) {
        echo 'Order added successfully.';
        // Redirect to a confirmation page or back to the product page
        header('Location: confirmation_page.php'); // Replace with your confirmation or product page
        exit();
    } else {
        echo 'Failed to add order.';
    }

    // Close statement and connection
    $stmt->close();
} else {
    echo 'Invalid product ID.';
}

$conn->close();
?>

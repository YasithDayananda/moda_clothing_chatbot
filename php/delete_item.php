<?php

include 'db_connect.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // SQL to delete a record
    $sql = "DELETE FROM products WHERE product_id = '$product_id'";
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    // Redirect to admin items page
    header("Location: ../pages/admin.php");
    exit();
} else {
    echo "No item ID provided.";
}

?>
<?php
// Database connection
include 'db_connect.php';

// Get search query
$search_query = isset($_POST['search_query']) ? $_POST['search_query'] : '';

if ($search_query) {
    // Add wildcards to the search query
    $search_query = "%" . $search_query . "%";
    echo $search_query;
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ?");
    $stmt->bind_param("s", $search_query);

    // Execute and fetch results
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if there are results
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='../images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['product_name']) . "'>";
            echo "<h2>" . htmlspecialchars($row['product_name']) . "</h2>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<p>Price: $" . htmlspecialchars($row['unit_price']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "No results found.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
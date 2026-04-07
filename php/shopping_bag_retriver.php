<?php
include 'db_connect.php';

$sql = "SELECT product_name, unit_price, image FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<img src="' . $row["image"] . '" alt="' . $row["product_name"] . '">';
        echo '<h2>' . $row["product_name"] . '</h2>';
        echo '<p>$' . $row["unit_price"] . '</p>';
        echo '</div>';
    }
} else {
    echo "<p>No products found.</p>";
}
$conn->close();
?>

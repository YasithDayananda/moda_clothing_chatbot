<?php
include 'db_connect.php';

$sql = "SELECT product_id, product_name, unit_price, image FROM products WHERE category='accessories'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<img src="' . $row["image"] . '" alt="' . $row["product_name"] . '">';
        echo '<h2>' . $row["product_name"] . '</h2>';
        echo '<p>$' . $row["unit_price"] . '</p>';
        echo '<button class="add-to-cart" data-product-id="' . $row['product_id'] . '" data-product-name="' . $row['product_name'] . '" data-product-price="' . $row['unit_price'] . '" data-product-image="' . $row['image'] . '">Add to Cart</button>';
        echo '</div>';
    }
} else {
    echo "<p>No products found.</p>";
}
$conn->close();
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = this.getAttribute('data-product-price');
            const productImage = this.getAttribute('data-product-image');

            // Send data to the server using Fetch API
            fetch('../php/add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `product_id=${productId}&product_name=${encodeURIComponent(productName)}&product_price=${productPrice}&product_image=${encodeURIComponent(productImage)}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Alert the response from the server
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>

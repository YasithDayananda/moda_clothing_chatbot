<?php

$host = "localhost";
$user="root";
$pass="";
$db="moda_db_sliit_y1_s2_wad";
$conn=new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    echo "Failed to connect DB".$conn->connect_error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Moda Clothing</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="header">
        <h1>Admin Panel</h1>
        <button id="action-btn" class="hidden">Add</button>
    </div>
    <div class="sidebar">
        <a href="#" id="products-btn">Manage Products</a>
        <a href="#" id="orders-btn">Manage Orders</a>
        <a href="#" id="users-btn">Manage Users</a>
    </div>
    <div class="content">
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="../php/add_product.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <label for="product-id">Product Id:</label>
                <input type="text" id="pid" name="product_id" required>

                <label for="product-name">Product Name:</label>
                <input type="text" id="pname" name="product_name" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="10" required></textarea>

                <label for="product-color">Product Color:</label>
                <input type="text" id="pcolor" name="product_color" required>

                <label for="product-size">Product Size:</label>
                <input type="text" id="psize" name="product_size" required>

                <label for="quantity">Product Quantity:</label>
                <div class="quantity-input"> 
                    <button id="decrease-btn" type="button" onclick="decreaseQuantity()">-</button>
                    <input type="text" id="quantity" name="quantity" value="1" required>
                    <button id="increase-btn" type="button" onclick="increaseQuantity()">+</button>
                </div>

                <label for="unit-price">Product Unit Price:</label>
                <input type="text" id="unit_price" name="unit_price" required>

                <label>Category:</label>
                <input type="radio" id="male" name="category" value="male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="category" value="female" required>
                <label for="female">Female</label>
                <input type="radio" id="unisex" name="category" value="unisex" required>
                <label for="unisex">Unisex</label>
                <input type="radio" id="accessories" name="category" value="accessories" required>
                <label for="accessories">Accessories</label>
                <input type="radio" id="shoes" name="category" value="shoes" required>
                <label for="shoes">Shoes</label>

                <label for="image_upload">Upload Images:</label>
                <input type="file" id="image_upload" name="image_upload[]" accept="image/*" multiple required>

                <input type="submit" class="btn" name="add_product" value="Add Product">
            </form>

            <!-- Manage Products Table -->
            <h2>Manage Products</h2>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Category</th>
                        <th>Immage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> 
            <?php
            // Fetch and display items
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['product_id']}</td>
                        <td>{$row['product_name']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['product_color']}</td>
                        <td>{$row['product_size']}</td>
                        <td>{$row['quantity']}</td>
                        <td>Rs. {$row['unit_price']}</td>
                        <td>{$row['category']}</td>
                        <td><img src='{$row['image']}' width='50'></td>
                        <td><a href='../php/edit_product.php?id={$row['product_id']}'>Edit</a> | <a href='../php/delete_item.php?id={$row['product_id']}'>Delete</a></td>
                      </tr>";
            }
            ?>
        </table>
                    <!-- Product rows will be dynamically inserted here by JavaScript -->                        
                </tbody>
            </table>
        </div>
    </div>
    <script src="../js/admin.js"></script>
</body>
</html>

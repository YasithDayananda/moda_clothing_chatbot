<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $product_name = $row['product_name'];
        $description = $row['description'];
        $product_color = $row['product_color'];
        $product_size = $row['product_size'];
        $quantity = $row['quantity'];
        $unit_price = $row['unit_price'];
        $category = $row['category'];
        $image = $row['image'];
    } else {
        echo "No product found with the given ID.";
        exit();
    }
} else {
    echo "No item ID provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get updated details from the form
    $updated_name = $_POST['product_name'];
    $updated_description = $_POST['description'];
    $updated_color = $_POST['product_color'];
    $updated_size = $_POST['product_size'];
    $updated_quantity = $_POST['quantity'];
    $updated_price = $_POST['unit_price'];
    $updated_category = $_POST['category'];

    // Handle image upload if a new image is provided
    if ($_FILES['image_upload']['name']) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image_upload"]["name"]);
        move_uploaded_file($_FILES["image_upload"]["tmp_name"], $target_file);
        $updated_image = $target_file;
    } else {
        $updated_image = $image;
    }

    // Update the product details in the database
    $update_sql = "UPDATE products SET 
        product_name='$updated_name', 
        description='$updated_description', 
        product_color='$updated_color', 
        product_size='$updated_size', 
        quantity='$updated_quantity', 
        unit_price='$updated_price', 
        category='$updated_category', 
        image='$updated_image' 
        WHERE product_id='$product_id'";

    if (mysqli_query($conn, $update_sql)) {
        echo "Product updated successfully!";
        header("Location: ../pages/admin.php");
        exit();
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Moda Clothing</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="modal-content">
        <h2>Edit Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="product-id">Product Id:</label>
            <input type="text" id="pid" name="product_id" value="<?php echo $product_id; ?>" readonly>

            <label for="product-name">Product Name:</label>
            <input type="text" id="pname" name="product_name" value="<?php echo $product_name; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="10" required><?php echo $description; ?></textarea>

            <label for="product-color">Product Color:</label>
            <input type="text" id="pcolor" name="product_color" value="<?php echo $product_color; ?>" required>

            <label for="product-size">Product Size:</label>
            <input type="text" id="psize" name="product_size" value="<?php echo $product_size; ?>" required>

            <label for="quantity">Product Quantity:</label>
            <input type="text" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required>

            <label for="unit-price">Product Unit Price:</label>
            <input type="text" id="unit_price" name="unit_price" value="<?php echo $unit_price; ?>" required>

            <label>Category:</label>
            <input type="radio" id="male" name="category" value="male" <?php if ($category == 'male') echo 'checked'; ?> required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="category" value="female" <?php if ($category == 'female') echo 'checked'; ?> required>
            <label for="female">Female</label>
            <input type="radio" id="unisex" name="category" value="unisex" <?php if ($category == 'unisex') echo 'checked'; ?> required>
            <label for="unisex">Unisex</label>
            <input type="radio" id="accessories" name="category" value="accessories" <?php if ($category == 'accessories') echo 'checked'; ?> required>
            <label for="accessories">Accessories</label>
            <input type="radio" id="shoes" name="category" value="shoes" <?php if ($category == 'shoes') echo 'checked'; ?> required>
            <label for="shoes">Shoes</label>

            <label for="image_upload">Upload New Image:</label>
            <input type="file" id="image_upload" name="image_upload" accept="image/*">
            <img src="<?php echo $image; ?>" width="100">
            <br>
            <input type="submit" class="btn" value="Update Product">
        </form>
    </div>
</body>
</html>

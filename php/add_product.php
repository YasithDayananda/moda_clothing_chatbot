<?php
include 'db_connect.php';

if (isset($_POST['add_product'])) {
    // Retrieve form data
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $product_color = isset($_POST['product_color']) ? $_POST['product_color'] : '';
    $product_size = isset($_POST['product_size']) ? $_POST['product_size'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $unit_price = isset($_POST['unit_price']) ? $_POST['unit_price'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    $image_upload_folder = '../uploads/';

    // Validate required fields
    if (empty($product_id) || empty($product_name) || empty($description) || empty($product_color) || empty($product_size) || empty($quantity) || empty($unit_price) || empty($category) || empty($_FILES['image_upload']['name'][0])) {
        $message[] = 'Please fill out all fields';
    } else {
        // Insert product details into the database
        $insert = "INSERT INTO products(product_id, product_name, description, product_color, product_size, quantity, unit_price, category) 
                   VALUES('$product_id', '$product_name', '$description', '$product_color', '$product_size', '$quantity', '$unit_price', '$category')";
        
        if (mysqli_query($conn, $insert)) {

            // Handle file uploads
            $uploaded_files = [];
            foreach ($_FILES['image_upload']['name'] as $key => $value) {
                $file_name = basename($_FILES['image_upload']['name'][$key]);
                $file_tmp_name = $_FILES['image_upload']['tmp_name'][$key];
                $file_path = $image_upload_folder . $file_name;

                if (move_uploaded_file($file_tmp_name, $file_path)) {
                    $uploaded_files[] = $file_path;
                } else {
                    $message[] = 'Error uploading file: ' . $file_name;
                }
            }

            // Update product record with uploaded image paths
            if (!empty($uploaded_files)) {
                $image = implode(',', $uploaded_files); 
                $update_images_query = "UPDATE products SET image='$image' WHERE product_id='$product_id'";
                mysqli_query($conn, $update_images_query);
            }

            $message[] = 'New Product Added Successfully';
            header("Location: ../pages/admin.php?info=added");
        } else {
            $message[] = 'Could Not Add The Product';
            header("Location: ../pages/admin.php?info=not added");
        }
    }
}
?>

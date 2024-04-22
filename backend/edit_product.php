<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "projectweb";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if product_id, name, description, and price are set in the POST request
if(isset($_POST['product_id'], $_POST['name'], $_POST['description'], $_POST['price'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Prepare and bind the SQL statement
    $stmt = $connection->prepare("UPDATE products SET name=?, description=?, price=? WHERE product_id=?");
    $stmt->bind_param("ssdi", $name, $description, $price, $product_id);

    // Execute the statement
    if($stmt->execute()) {
        // Return a success message or response if needed
        echo "Product updated successfully.";
    } else {
        // Return an error message or response if update failed
        echo "Error updating product.";
    }

    // Close statement
    $stmt->close();
} else {
    // Return an error message if any required fields are missing in the POST request
    echo "Missing required fields.";
}

// Close connection
$connection->close();
?>

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

// Check if product_id is set in the POST request
if(isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Perform the deletion operation in the database
    $sql = "DELETE FROM products WHERE product_id = $product_id";
    $result = $connection->query($sql);

    // Check if deletion was successful
    if($result) {
        // Return a success message or response if needed
        echo "Product deleted successfully.";
    } else {
        // Return an error message or response if deletion failed
        echo "Error deleting product.";
    }
} else {
    // Return an error message if product_id is not set in the POST request
    echo "Product ID not provided.";
}

// Close connection
$connection->close();
?>

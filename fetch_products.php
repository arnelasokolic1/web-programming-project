<?php
// Include the database connection file
require_once 'backend/config/connect.php';

try {
    // Prepare the SQL query to fetch product data
    $sql = "SELECT * FROM products";
    
    // Execute the query
    $stmt = $conn->query($sql);
    
    // Fetch all rows as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the product data as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
} catch(PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
}
?>

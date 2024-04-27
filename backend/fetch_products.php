<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "projectweb";

// Create a PDO instance
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

// Set PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Prepare SQL statement to fetch products from the Products table
$stmt = $conn->prepare("SELECT * FROM Products");

// Execute the statement
$stmt->execute();

// Fetch all products as associative arrays
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Close the connection
$conn = null;

// Convert the products array to JSON and output it
echo json_encode($products);
?>

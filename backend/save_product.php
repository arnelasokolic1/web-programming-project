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

// Validate and sanitize input data
$name = $_POST["product-name"];
$description = $_POST["product-description"];
$price = $_POST["product-price"];

// Prepare SQL statement to insert data into Products table
$stmt = $conn->prepare("INSERT INTO Products (name, description, price) VALUES (:name, :description, :price)");

// Bind parameters
$stmt->bindParam(':name', $name);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':price', $price);

// Execute the statement
$stmt->execute();

// Close the connection
$conn = null;

// Redirect back to admin/products.html
header("Location: ../admin/products.html");
exit; // Ensure no further code is executed after redirection
?>

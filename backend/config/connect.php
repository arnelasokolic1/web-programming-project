<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "project_web";

// Data source name (DSN)
$dsn = "mysql:host=$servername;dbname=$database";

try {
    // Create a PDO instance
    $conn = new PDO($dsn, $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully"; // You may choose to remove this line or handle it differently
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    throw $e;
} finally {
    // Close connection
    $conn = null;
}
?>

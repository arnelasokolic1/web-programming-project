<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "projectweb";

// Data source name (DSN)
$dsn = "mysql:host=$servername;dbname=$database";

try {
    // Create a PDO instance
    $conn = new PDO($dsn, $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optionally, you can echo a success message
    // echo "Connected successfully";
} catch(PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    throw $e; // Optionally, you can rethrow the exception
}

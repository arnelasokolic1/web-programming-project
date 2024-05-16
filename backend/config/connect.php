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

} catch(PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    throw $e; 
}

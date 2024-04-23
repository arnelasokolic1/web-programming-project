<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "projectweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get name from POST data
$name = $_POST['name'];

// Prepare SQL statement to insert admin
$sql = "INSERT INTO Admin (name) VALUES ('$name')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    // If insertion successful, return success response
    $response = array("success" => true);
} else {
    // If insertion failed, return error response
    $response = array("success" => false, "error" => "Failed to add admin: " . $conn->error);
}

// Close connection
$conn->close();

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>


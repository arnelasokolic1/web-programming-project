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

// Get admin ID, name, and email from POST data
$adminId = $_POST['adminId'];
$name = $_POST['name'];
$email = $_POST['email'];

// Prepare SQL statement to update admin
$sql = "UPDATE Admin SET name='$name', email='$email' WHERE id='$adminId'";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    // If update successful, return success response
    $response = array("success" => true);
} else {
    // If update failed, return error response
    $response = array("success" => false, "error" => "Failed to update admin: " . $conn->error);
}

// Close connection
$conn->close();

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

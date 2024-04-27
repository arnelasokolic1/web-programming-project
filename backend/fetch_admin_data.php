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

// Fetch admin data from the database
$sql = "SELECT id, name FROM Admin"; // Exclude the email field
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$adminData = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $adminData[] = $row;
    }
}

// Close connection
$conn->close();

// Return admin data as JSON
header('Content-Type: application/json');
echo json_encode($adminData);
?>


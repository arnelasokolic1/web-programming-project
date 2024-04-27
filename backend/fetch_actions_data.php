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

// Fetch data from Actions table
$sql = "SELECT action_id, product_name, discount FROM Actions";
$result = $conn->query($sql);

// Prepare array to store fetched data
$data = array();

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Fetch each row and add it to the data array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$conn->close();

// Set response header to JSON
header('Content-Type: application/json');

// Output the data array as JSON
echo json_encode($data);
?>

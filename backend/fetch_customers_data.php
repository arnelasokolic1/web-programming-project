<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "projectweb"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select all data from the Customers table
$sql = "SELECT * FROM Customers";

$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Fetch rows and store them in an array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Encode the array as JSON and output it
    echo json_encode($data);
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

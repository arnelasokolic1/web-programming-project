<?php

// Database connection parameters
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



// Query to fetch data from the ContactMessages table
$sql = "SELECT * FROM ContactMessages";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // Return data as JSON
    echo json_encode($data);
} else {
    echo json_encode(array()); // Return empty array if no data found
}

$conn->close();
?>

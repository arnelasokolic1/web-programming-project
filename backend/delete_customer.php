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

// Check if customerId is set and not empty
if(isset($_POST['customerId']) && !empty($_POST['customerId'])) {
    $customerId = $_POST['customerId'];

    // SQL to delete customer
    $sql = "DELETE FROM Customers WHERE customer_id = '$customerId'";

    if ($conn->query($sql) === TRUE) {
        // Return success message
        echo json_encode(array("success" => true));
    } else {
        // Return error message
        echo json_encode(array("success" => false, "error" => $conn->error));
    }
} else {
    // Return error message if customerId is not set or empty
    echo json_encode(array("success" => false, "error" => "Customer ID is not set or empty"));
}

// Close connection
$conn->close();
?>

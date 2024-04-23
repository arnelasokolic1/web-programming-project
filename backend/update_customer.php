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

// Check if form data and customer ID are set and not empty
if(isset($_POST['customerId']) && isset($_POST['name']) && isset($_POST['surname']) && !empty($_POST['customerId']) && !empty($_POST['name']) && !empty($_POST['surname'])) {
    $customerId = $_POST['customerId'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    // SQL to update customer
    $sql = "UPDATE Customers SET name = '$name', surname = '$surname' WHERE customer_id = '$customerId'";

    if ($conn->query($sql) === TRUE) {
        // Return success message
        echo json_encode(array("success" => true));
    } else {
        // Return error message
        echo json_encode(array("success" => false, "error" => $conn->error));
    }
} else {
    // Return error message if form data or customer ID is not set or empty
    echo json_encode(array("success" => false, "error" => "Form data or customer ID is missing or empty"));
}

// Close connection
$conn->close();
?>

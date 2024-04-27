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

// Check if form data is set and not empty
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['address'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // SQL to add new customer
    $sql = "INSERT INTO Customers (name, surname, email, phone, address) VALUES ('$name', '$surname', '$email', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        // Return success message
        echo json_encode(array("success" => true));
    } else {
        // Return error message
        echo json_encode(array("success" => false));
    }
} else {
    // Return error message if form data is not set or empty
    echo json_encode(array("success" => false));
}

// Close connection
$conn->close();
?>

<?php
// Establish a connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$database = "projectweb";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the data sent from the HTML form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password']; 

// Prepare and execute an SQL statement to insert the data into the database
$sql = "INSERT INTO Customers (name, email, password) VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>

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

// Function to sanitize input data
function sanitizeData($data) {
    // Remove leading and trailing whitespace
    $data = trim($data);
    // Remove backslashes
    $data = stripslashes($data);
    // Convert special characters to HTML entities
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and store form data
    $email = sanitizeData($_POST["email"]);
    $customerName = sanitizeData($_POST["customer_name"]);
    $message = sanitizeData($_POST["message"]);

    // Debugging: Print received data
    echo "Email: " . $email . "<br>";
    echo "Customer Name: " . $customerName . "<br>";
    echo "Message: " . $message . "<br>";

    // Insert data into the ContactMessages table
    $sql = "INSERT INTO ContactMessages (email, message, customer_name)
            VALUES ('$email', '$message', '$customerName')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Form not submitted!";
}


$conn->close();
?>

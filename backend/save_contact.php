<?php
// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $database = "projectweb";

    // Create a PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validate and sanitize input data
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $message = $_POST["message"];

    // Prepare SQL statement to insert data into Messages table
    $stmt = $conn->prepare("INSERT INTO Messages (email, customer_name, customer_surname, message) VALUES (:email, :name, :surname, :message)");

    // Bind parameters
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':message', $message);

    // Execute the statement
    $stmt->execute();

    // Close the connection
    $conn = null;

    // Set success message
    $success_message = "Your message was sent successfully!";
} else {
    // If the form is not submitted via POST, display an error message
    echo "Form submission method not allowed.";
}
?>

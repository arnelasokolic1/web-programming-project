<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "projectweb";

// Data source name (DSN)
$dsn = "mysql:host=$servername;dbname=$database";

try {
    // Create a PDO instance
    $conn = new PDO($dsn, $username, $password);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize input data
        $name = $_POST["name"];
        $email = $_POST["email"];
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

        // Optionally, you can redirect the user to a success page
        header("Location: contact_success.html");
        exit();
    }
} catch(PDOException $e) {
    // Handle connection errors
    echo "Error: " . $e->getMessage();
    // Log the error to a file or display it for debugging purposes
    file_put_contents('error.log', $e->getMessage(), FILE_APPEND);
}
?>


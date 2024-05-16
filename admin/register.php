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
        $email = $_POST["Email"];
        $password = $_POST["password"];

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert data into Admin table
        $stmt = $conn->prepare("INSERT INTO Admin (name, email, password) VALUES (:name, :email, :password)");

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        // Execute the statement
        $stmt->execute();

       
        header("Location: account.html");
        exit();
    }
} catch(PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    throw $e; 
}
?>


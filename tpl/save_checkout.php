<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // If the form is not submitted, redirect the user to an error page
    header("Location: error_page.html");
    exit(); // Make sure to exit after redirection
}

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

    // Validate and sanitize input data
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Prepare SQL statement to insert data into Customers table
    $stmt = $conn->prepare("INSERT INTO Customers (name, surname, email, phone, address) VALUES (:name, :surname, :email, :phone, :address)");

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);

    // Execute the statement
    $stmt->execute();

    // Set success message
    $success_message = "Your order was successful!";

} catch(PDOException $e) {
    // Handle connection errors
    $error_message = "Connection failed: " . $e->getMessage();
    // Log the error to a file or display it for debugging purposes
    file_put_contents('error.log', $e->getMessage(), FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <!-- Add any CSS or Bootstrap links here -->
</head>
<body>
    <div class="container">
        <?php if (isset($success_message)) : ?>
            <h1><?php echo $success_message; ?></h1>
            <!-- You can add additional content or a link to redirect the user to another page -->
        <?php else : ?>
            <h1>Error</h1>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

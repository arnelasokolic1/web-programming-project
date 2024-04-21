<?php
// Include the database connection file
require_once '../backend/config/connect.php';

// Check if form data is submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $message = $_POST['message'];

    // Insert the form data into the Messages table
    try {
        $sql = "INSERT INTO Messages (email, customer_name, customer_surname, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $name, $surname, $message]);
        
        // Optionally, you can echo a success message
        echo "Message sent successfully!";
    } catch(PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the request method is not POST, redirect back to the contact form page
    header("Location: tpl/contact.html");
    exit();
}
?>

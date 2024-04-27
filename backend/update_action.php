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

// Check if data is posted via a form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set and not empty
    if (isset($_POST['action_id']) && isset($_POST['product_name']) && isset($_POST['discount'])) {
        $action_id = $_POST['action_id'];
        $product_name = $_POST['product_name'];
        $discount = $_POST['discount'];

        // Prepare an SQL statement to update the action in the database
        $sql = "UPDATE Actions SET product_name=?, discount=? WHERE action_id=?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters to the statement
        $stmt->bind_param("sdi", $product_name, $discount, $action_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Action updated successfully
            echo json_encode(array("success" => true));
        } else {
            // Error occurred while updating action
            echo json_encode(array("success" => false, "message" => "Error updating action"));
        }

        // Close the statement
        $stmt->close();
    } else {
        // Required fields are not set or empty
        echo json_encode(array("success" => false, "message" => "All fields are required"));
    }
} else {
    // Invalid request method
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}

// Close the database connection
$conn->close();
?>

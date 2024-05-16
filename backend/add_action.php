<?php
//  database configuration
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
    if (isset($_POST['product_name']) && isset($_POST['discount'])) {
        $product_name = $_POST['product_name'];
        $discount = $_POST['discount'];

        $sql = "INSERT INTO Actions (product_name, discount) VALUES (?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sd", $product_name, $discount);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the ID of the last inserted row
            $last_id = $conn->insert_id;
            // Action inserted successfully, send success response with the new action ID
            echo json_encode(array("success" => true, "action_id" => $last_id));
        } else {
            // Error occurred while inserting action
            echo json_encode(array("success" => false, "message" => "Error inserting action"));
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

// 

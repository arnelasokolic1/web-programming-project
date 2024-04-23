<?php
// Include database configuration
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

// Check if action ID is provided
if(isset($_POST['actionId'])) {
    // Sanitize action ID
    $actionId = $_POST['actionId'];

    // Prepare and execute SQL statement to delete the action
    $sql = "DELETE FROM Actions WHERE action_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $actionId);

    // Check if deletion was successful
    if ($stmt->execute()) {
        // Return success response
        $response = array(
            'success' => true
        );
        echo json_encode($response);
    } else {
        // Return error response
        $response = array(
            'success' => false
        );
        echo json_encode($response);
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>

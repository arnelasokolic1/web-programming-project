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

// Check if adminId is set and not empty
if(isset($_POST['adminId']) && !empty($_POST['adminId'])) {
    // Escape adminId to prevent SQL injection
    $adminId = $conn->real_escape_string($_POST['adminId']);
    
    // SQL to delete admin
    $sql = "DELETE FROM Admin WHERE id = '$adminId'";
    
    if ($conn->query($sql) === TRUE) {
        // If deletion successful, return success message
        $response['success'] = true;
    } else {
        // If deletion failed, return error message
        $response['success'] = false;
        $response['error'] = "Error deleting record: " . $conn->error;
    }
} else {
    // If adminId not set or empty, return error message
    $response['success'] = false;
    $response['error'] = "Admin ID not provided.";
}

// Close connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

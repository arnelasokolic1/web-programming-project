<?php
require_once 'MessagesService.php';

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_web";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$messagesService = new MessagesService($conn);

// Route to handle adding a new message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "addMessage") {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $message = $_POST["message"];
    echo json_encode($messagesService->addMessage($email, $name, $surname, $message));
}

// Route to handle retrieving all messages
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "getAllMessages") {
    echo json_encode($messagesService->getAllMessages());
}

// Route to handle updating a message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "updateMessage") {
    $message_id = $_POST["message_id"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $message = $_POST["message"];
    echo json_encode($messagesService->updateMessage($message_id, $email, $name, $surname, $message));
}

// Route to handle deleting a message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "deleteMessage") {
    $message_id = $_POST["message_id"];
    echo json_encode($messagesService->deleteMessage($message_id));
}

$conn->close();
?>

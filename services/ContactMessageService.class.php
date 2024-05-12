<?php

//require_once __DIR__ . '/../config/Database.php';

class ContactMessageService {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // method retrieves all contact messages from the database
    public function getAllContactMessages() {
        $query = "SELECT * FROM contactmessages";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // method retrieves a single contact message by its ID from the database
    public function getContactMessageById($id) {
        $query = "SELECT * FROM contactmessages WHERE message_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // method adds a new contact message to the database
    public function addContactMessage($data) {
        $query = "INSERT INTO contactmessages (email, message, customer_name) VALUES (:email, :message, :customer_name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':message', $data['message']);
        $stmt->bindParam(':customer_name', $data['customer_name']);
        return $stmt->execute();
    }

    // method updates an existing contact message in the database
    public function updateContactMessage($id, $data) {
        $query = "UPDATE contactmessages SET email = :email, message = :message, customer_name = :customer_name WHERE message_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':message', $data['message']);
        $stmt->bindParam(':customer_name', $data['customer_name']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // method deletes a contact message from the database
    public function deleteContactMessage($id) {
        $query = "DELETE FROM contactmessages WHERE message_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>

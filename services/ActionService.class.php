<?php

//require_once __DIR__ . '/../config/Database.php';

class ActionService {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // method retrieves all actions from the database
    public function getAllActions() {
        $query = "SELECT * FROM actions";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // method retrieves a single action by its ID from the database
    public function getActionById($id) {
        $query = "SELECT * FROM actions WHERE action_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // method adds a new action to the database
    public function addAction($data) {
        $query = "INSERT INTO actions (product_name, discount) VALUES (:product_name, :discount)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_name', $data['product_name']);
        $stmt->bindParam(':discount', $data['discount']);
        return $stmt->execute();
    }

    // method updates an existing action in the database
    public function updateAction($id, $data) {
        $query = "UPDATE actions SET product_name = :product_name, discount = :discount WHERE action_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_name', $data['product_name']);
        $stmt->bindParam(':discount', $data['discount']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // method deletes an action from the database
    public function deleteAction($id) {
        $query = "DELETE FROM actions WHERE action_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>

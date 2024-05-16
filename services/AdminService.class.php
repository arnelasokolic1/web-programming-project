<?php

// require_once __DIR__ . '/../config/Database.php';

class AdminService {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    //retrieves all admins from the database
    public function getAllAdmins() {
        $query = "SELECT * FROM admins";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // creates a new admin
    public function createAdmin($data) {
        $query = "INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        return $stmt->execute();
    }

    // updates an existing admin
    public function updateAdmin($id, $data) {
        $query = "UPDATE admins SET name = :name, email = :email, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        return $stmt->execute();
    }

    // deletes an existing admin
    public function deleteAdmin($id) {
        $query = "DELETE FROM admins WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>

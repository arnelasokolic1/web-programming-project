<?php

// require_once __DIR__ . '/../config/Database.php';

class CustomerService {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // method retrieves all customers from the database
    public function getAllCustomers() {
        $query = "SELECT * FROM customers";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // method retrieves a customer by ID from the database
    public function getCustomerById($id) {
        $query = "SELECT * FROM customers WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // method adds a new customer to the database
    public function addCustomer($data) {
        $query = "INSERT INTO customers (name, surname, email, phone, address) VALUES (:name, :surname, :email, :phone, :address)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':surname', $data['surname']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        return $stmt->execute();
    }

    // method updates an existing customer in the database
    public function updateCustomer($id, $data) {
        $query = "UPDATE customers SET name = :name, surname = :surname, email = :email, phone = :phone, address = :address WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':surname', $data['surname']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);
        return $stmt->execute();
    }

    //  method deletes an existing customer from the database
    public function deleteCustomer($id) {
        $query = "DELETE FROM customers WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>

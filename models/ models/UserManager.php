<?php
class UserManager {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function createUser($name, $email, $password, $role) {
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (name, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, password_hash($password, PASSWORD_BCRYPT), $role]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM utilisateurs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM utilisateurs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
class PrestationManager {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function createPrestation($name, $price) {
        $stmt = $this->db->prepare("INSERT INTO prestations (name, price) VALUES (?, ?)");
        return $stmt->execute([$name, $price]);
    }

    public function getAllPrestations() {
        $stmt = $this->db->query("SELECT * FROM prestations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePrestation($id) {
        $stmt = $this->db->prepare("DELETE FROM prestations WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
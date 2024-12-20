<?php
require_once 'Connect/Database.php';
require_once 'Model/Model_role.php';

class ModelUser {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }

    public function connectDatabase() {
        $database = new Database(); // Membuat instance dari class Database
        $this->db = $database->connect(); // Mengambil koneksi dari class Database
    }

    public function getAllUser() {
        $query = "SELECT * FROM db_user";
        $result = $this->db->query($query);

        $user = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user[] = $row;
            }
        }
        return $user;
    }

    // public function createUser($username, $password, $role) {
    //     $role = $this->model_role->getRoleById($role);
    //     $query = "INSERT INTO db_user (username, password, role) VALUES (?, ?, ?)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param("ssi", $username, $password, $role);

    //     if ($stmt->execute()) {
    //         return true;
    //     }
    //     return false;
    // }


}

?>
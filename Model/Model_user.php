<?php
require_once 'Connect/Database.php';
require_once 'Model/Model_role.php';



class ModelUser {
    private $db;
    private $model_role;

    public function __construct() {
        $this->connectDatabase();
        $this->model_role = new ModelRole();
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

    public function createUser($nama_user, $password_user, $nama_role) {
        $query = "INSERT INTO db_user (nama_user, password_user, nama_role) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $nama_user, $password_user, $nama_role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getUsers(){
        return $this->db->query("SELECT * FROM db_users");
    }


}

?>
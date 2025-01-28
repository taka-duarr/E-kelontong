<?php
require_once 'Connect/Database.php';
require_once 'Model/Model_role.php';



class ModelUser {
    private $db;
    private $model_role;

    public function __construct(ModelRole $model_role) {
        $this->connectDatabase();
        $this->model_role = $model_role;
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

    public function updateUser( $nama_user, $password_user, $nama_role, $id_user) {
        $query = "UPDATE db_user SET nama_user = ?, password_user = ?, nama_role = ? WHERE id_user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssi", $nama_user, $password_user, $nama_role, $id_user);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    public function deleteUser($id_user) {
        foreach ($this->getAllUser() as $user) {
            if ($user['id_user'] == $id_user) {
                $query = "DELETE FROM db_user WHERE id_user = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("i", $id_user);
                $stmt->execute();
                return true;
            }
        }
        return false;
    }

    public function getUsers(){
        return $this->db->query("SELECT * FROM db_user");
    }

    public function getUserById($id_user) {
        foreach($this->getUsers() as $user) {
            if ($user['id_user'] == $id_user) {
                return $user;
            }
        }
        return null;
    }

    public function getUserByName($nama_user) {
        foreach($this->getUsers() as $user) {
            if ($user['nama_user'] == $nama_user) {
                return $user;
            }
        }
        return null;
    }


}

?>
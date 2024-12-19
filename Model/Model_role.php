<?php
require_once 'Connect/Database.php';

class ModelRole{
    private $db;

    public function __construct(){
        $this->connectDatabase();
    }

    public function connectDatabase() {
        $database = new Database(); // Membuat instance dari class Database
        $this->db = $database->connect(); // Mengambil koneksi dari class Database
    }

        public function getAllRole(){
            $query = "SELECT * FROM db_role";
            $result = $this->db->query($query);

            $role = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $role[] = $row;
            }
        }
        return $role;
        }

        public function createRole($nama_role, $status_role){
            $query = "INSERT INTO db_role (nama_role, status_role) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $nama_role, $status_role);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }


}
?>
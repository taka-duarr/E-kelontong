<?php
require_once 'Connect/Database.php';

interface RoleInterface {
    public function getAllRole();
    public function createRole($nama_role, $status_role);
    public function updateRole($id_role, $nama_role, $status_role);
    public function deleteRole($id_role);
    public function getRoleById($id_role);
    public function getRoleByName($nama_role);
}

abstract class AbstractDatabase {
    protected $db;

    public function __construct() {
        $this->connectDatabase();
    }

    abstract protected function connectDatabase();
}

class ModelRole extends AbstractDatabase implements RoleInterface {
    protected function connectDatabase() {
        $database = new Database(); // Membuat instance dari class Database
        $this->db = $database->connect(); // Mengambil koneksi dari class Database
    }

    public function getAllRole() {
        $query = "SELECT * FROM db_role";
        $result = $this->db->query($query);

        $role = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $role[] = $row;
            }
        }
        return $role;
    }

    public function createRole($nama_role, $status_role) {
        $query = "INSERT INTO db_role (nama_role, status_role) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $nama_role, $status_role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateRole($id_role, $nama_role, $status_role) {
        $query = "UPDATE db_role SET nama_role = ?, status_role = ? WHERE id_role = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssi", $nama_role, $status_role, $id_role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteRole($id_role) {
        foreach ($this->getAllRole() as $role) {
            if ($role['id_role'] == $id_role) {
                $query = "DELETE FROM db_role WHERE id_role = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("i", $id_role);
                $stmt->execute();
                return true;
            }
        }
        return false;
    }

    public function getRoleById($id_role) {
        foreach ($this->getAllRole() as $role) {
            if ($role['id_role'] == $id_role) {
                return $role;
            }
        }
        return null;
    }

    public function getRoleByName($nama_role) {
        foreach ($this->getAllRole() as $role) {
            if ($role['nama_role'] == $nama_role) {
                return $role;
            }
        }
        return null;
    }
}

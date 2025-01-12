<?php
require_once 'Connect/Database.php';

// Kelas Induk: BaseModel
class BaseModel {
    protected $db;

    public function __construct() {
        $this->connectDatabase();
    }

    public function connectDatabase() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAll() {
        $query = "SELECT * FROM db_barang"; // Langsung menggunakan nama tabel
        $result = $this->db->query($query);

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function deleteById($id_column, $id) {
        $query = "DELETE FROM db_barang WHERE $id_column = ?"; // Langsung menggunakan nama tabel
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

// Kelas Turunan: ModelBarang
class ModelBarang extends BaseModel {
    public function getAllBarang() {
        return $this->getAll();
    }

    public function createBarang($nama_barang, $stok_barang, $harga_barang, $gambar_barang, $status_barang) {
        $query = "INSERT INTO db_barang (nama_barang, stok_barang, harga_barang, gambar_barang, status_barang) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $nama_barang, $stok_barang, $harga_barang, $gambar_barang, $status_barang);
        return $stmt->execute();
    }

    public function updateBarang($id_barang, $nama_barang, $stok_barang, $harga_barang, $gambar_barang, $status_barang) {
        $query = "UPDATE db_barang 
                  SET nama_barang = ?, stok_barang = ?, harga_barang = ?, gambar_barang = ?, status_barang = ? 
                  WHERE id_barang = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssi", $nama_barang, $stok_barang, $harga_barang, $gambar_barang, $status_barang, $id_barang);
        return $stmt->execute();
    }

    public function deleteBarang($id_barang) {
        return $this->deleteById('id_barang', $id_barang);
    }

    public function getBarangById($id_barang) {
        $query = "SELECT * FROM db_barang WHERE id_barang = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getBarangByName($nama_barang) {
        $query = "SELECT * FROM db_barang WHERE nama_barang = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $nama_barang);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function searchBarang($keyword) {
        $query = "SELECT * FROM db_barang WHERE nama_barang LIKE ?";
        $stmt = $this->db->prepare($query);
        $search = '%' . $keyword . '%';
        $stmt->bind_param("s", $search);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>

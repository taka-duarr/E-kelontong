<?php
require_once 'Connect/Database.php';
class ModelBarang {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }

    
    
    public function connectDatabase() {
        $database = new Database(); // Membuat instance dari class Database
        $this->db = $database->connect(); // Mengambil koneksi dari class Database
    }
    
    

    public function getAllBarang() {
        $query = "SELECT * FROM db_barang"; // Ambil semua data barang
        $result = $this->db->query($query);

        $barang = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $barang[] = $row;
            }
        }

        return $barang; // Kembalikan hasil berupa array
    }

    public function createBarang($nama_barang,$stok_barang, $harga_barang, $gambar_barang, $status_barang) {
        $query = "INSERT INTO db_barang (nama_barang,stok_barang, harga_barang, gambar_barang, status_barang) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss" , $nama_barang, $stok_barang,$harga_barang, $gambar_barang, $status_barang);
        
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function updateBarang($id_barang, $nama_barang, $stok_barang, $harga_barang, $gambar_barang, $status_barang) {
        $query = "UPDATE db_barang SET nama_barang = ?, stok_barang = ?, harga_barang = ?, gambar_barang = ?, status_barang = ? 
                  WHERE id_barang = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssi", $nama_barang, $stok_barang, $harga_barang, $gambar_barang, $status_barang, $id_barang);
    
        if ($stmt->execute()) {
            return true;
        } else {
            // Debug jika terjadi error
            echo "Error: " . $stmt->error;
        }
    
        return false;
    }
    

    // Fungsi untuk menghapus data barang
    public function deleteBarang($id_barang) {
        foreach($this->getbarangs() as $barang) {
            if ($barang['id_barang'] == $id_barang) {
                $query = "DELETE FROM db_barang WHERE id_barang = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("i", $id_barang);
                $stmt->execute();
                return true;
            }
        }
        return false;
    }

    public function getbarangs(){
        return $this-> db->query("SELECT * FROM db_barang");
    }

    public function getBarangById($id_barang) {
        foreach($this->getbarangs() as $barang) {
            if ($barang['id_barang'] == $id_barang) {
                return $barang;
            }
        }
        return null;
    }

    public function getBarangByName($nama_barang) {
        foreach($this->getbarangs() as $barang) {
            if ($barang['nama_barang'] == $nama_barang) {
                return $barang;
            }
        }
        return null;
    }

    function searchBarang($keyword) {
        
        $sql = "SELECT * FROM db_barang WHERE nama_barang LIKE ?";
        $stmt = $this->db->prepare($sql);
        $search = '%' . $keyword . '%';
        $stmt->bind_param('s', $search);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    
    

    
}
?>

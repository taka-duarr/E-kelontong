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

    
}
?>

<?php
require_once 'Connect/Database.php';
require_once 'Model/Model_barang.php';
class ModelKeranjang {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }
    
    public function connectDatabase() {
        $database = new Database(); // Membuat instance dari class Database
        $this->db = $database->connect(); // Mengambil koneksi dari class Database
    }

    public function createKeranjang($id_user, $id_barang, $jumlah = 1) {
        $query = "INSERT INTO db_cart (id_user, id_barang, jumlah) 
                  VALUES (?, ?, ?) 
                  ON DUPLICATE KEY UPDATE jumlah = jumlah + ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiii", $id_user, $id_barang, $jumlah, $jumlah);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getAllKeranjang($id_user) {
        // Query yang sudah diperbaiki
        $sql = "SELECT c.id_cart, b.nama_barang, b.harga_barang, c.jumlah, b.gambar_barang
                FROM db_cart c
                JOIN db_barang b ON c.id_barang = b.id_barang
                WHERE c.id_user = ?"; // Gunakan ? sebagai placeholder
        
        // Persiapkan statement MySQLi
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            die("Error preparing statement: " . $this->db->error);
        }
        
        // Bind parameter untuk integer (id_user)
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        
        // Ambil hasil query
        $result = $stmt->get_result();
        
        // Ambil data sebagai array
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        
        $stmt->close();
        
        return $items;


    }

   
    
}
    

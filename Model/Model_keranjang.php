<?php
require_once 'Connect/Database.php';
class ModelKeranjang {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }
    
    public function connectDatabase() {
        $database = new Database(); // Membuat instance dari class Database
        $this->db = $database->connect(); // Mengambil koneksi dari class Database
    }

    public function addToCart($id_user, $id_barang, $jumlah = 1) {
        $query = "INSERT INTO db_cart (id_user, id_barang, jumlah) 
                  VALUES (:id_user, :id_barang, :jumlah) 
                  ON DUPLICATE KEY UPDATE jumlah = jumlah + :jumlah";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_barang', $id_barang);
        $stmt->bindParam(':jumlah', $jumlah);
        return $stmt->execute();
    }

    public function getCartItems($id_user) {
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
    

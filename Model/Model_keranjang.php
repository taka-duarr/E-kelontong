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
        $query = "INSERT INTO cart (id_user, id_barang, jumlah) 
                  VALUES (:id_user, :id_barang, :jumlah) 
                  ON DUPLICATE KEY UPDATE jumlah = jumlah + :jumlah";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_barang', $id_barang);
        $stmt->bindParam(':jumlah', $jumlah);
        return $stmt->execute();
    }

    public function getCartItems($id_user) {
        $query = "SELECT c.id, b.nama_barang, b.harga_barang, c.jumlah, b.gambar_barang 
                  FROM cart c 
                  JOIN barang b ON c.id_barang = b.id 
                  WHERE c.id_user = :id_user";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

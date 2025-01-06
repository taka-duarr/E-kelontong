<?php
require_once 'Connect/Database.php';
class ModelApprove {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }

    
    
    public function connectDatabase() {
        $database = new Database(); // Membuat instance dari class Database
        $this->db = $database->connect(); // Mengambil koneksi dari class Database
    }



    // Mendapatkan semua transaksi customer untuk admin
    public function getAllTransaksi() {
        $query = "
            SELECT 
                t.id_transaksi, t.tanggal, t.total_harga AS total_all, t.alamat, t.status,
                d.id_barang, d.jumlah, d.total_harga,
                b.nama_barang, b.harga_barang
            FROM db_transaksi t
            LEFT JOIN db_detail_transaksi d ON t.id_transaksi = d.id_transaksi
            LEFT JOIN db_barang b ON d.id_barang = b.id_barang
            ORDER BY t.tanggal DESC
        ";
    
        $result = $this->db->query($query);
    
        // Konversi hasil menjadi array
        $transaksi = [];
        while ($row = $result->fetch_assoc()) {
            $transaksi[] = $row;
        }
    
        return $transaksi;
    }
    



    // public function getPendingTransactions() {
    //     $query = "SELECT * FROM db_transaksi WHERE status = 0";
    //     $stmt = $this->db->query($query);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function approveTransaction($id_transaksi) {
    //     $query = "UPDATE db_transaksi SET status = 1 WHERE id_transaksi = :id_transaksi";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':id_transaksi', $id_transaksi);
    //     $stmt->execute();
    // }

    // public function getUserTransactions($id_user) {
    //     $query = "SELECT * FROM db_transaksi WHERE id_user = :id_user ORDER BY created_at DESC";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':id_user', $id_user);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    
    
    
}

    ?>
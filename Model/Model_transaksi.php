<?php

require_once 'Connect/Database.php';

class ModelTransaksi{
    private $db;

    public function __construct(){
        $this->connectDatabase();
    }

    public function connectDatabase() {
        $database = new Database(); // Membuat instance dari class Database
        $this->db = $database->connect(); // Mengambil koneksi dari class Database
    }

    // public function createTransaction($id_user, $total_harga, $status = 1) {
    //     $sql = "INSERT INTO transaksi (id_user, tanggal, total_harga, status) VALUES (?, NOW(), ?, ?)";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param("iii", $id_user, $total_harga, $status);
    //     $stmt->execute();
    
    //     // Mengembalikan ID transaksi yang baru dibuat
    //     return $this->db->insert_id;
    // }
    

    

    public function saveTransaksi($id_user, $total_harga, $status) {
        $query = "INSERT INTO db_transaksi (id_user, total_harga, status, tanggal) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iis", $id_user, $total_harga, $status);
    
        if ($stmt->execute()) {
            return $this->db->insert_id; // Mengembalikan ID transaksi terakhir
        }
        return false; // Gagal menyimpan transaksi
    }

    public function addTransactionDetails($id_transaksi, $cart_items) {
        $sql = "INSERT INTO db_detail_transaksi (id_transaksi, id_barang, jumlah, harga, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
    
        foreach ($cart_items as $item) {
            $subtotal = $item['jumlah'] * $item['harga'];
            $stmt->bind_param("iiiii", $id_transaksi, $item['id_barang'], $item['jumlah'], $item['harga'], $subtotal);
            $stmt->execute();
        }
    }
    

    public function saveDetailTransaksi($id_transaksi, $details) {
        $query = "INSERT INTO db_detail_transaksi (id_transaksi, id_barang, jumlah, harga, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
    
        foreach ($details as $item) {
            $subtotal = $item['jumlah'] * $item['harga_barang'];
            $stmt->bind_param("iiiii", $id_transaksi, $item['id_barang'], $item['jumlah'], $item['harga_barang'], $subtotal);
    
            if (!$stmt->execute()) {
                return false; // Jika ada satu detail gagal, hentikan
            }
        }
        return true; // Semua detail berhasil disimpan
    }

    public function getTransaction($id_transaksi) {
        $sql = "SELECT * FROM db_transaksi WHERE id_transaksi = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id_transaksi); // Mengikat parameter
        $stmt->execute();

        // Mengambil hasil menggunakan bind_result
        $result = $stmt->get_result();
        $transaction = $result->fetch_assoc(); // Ambil baris sebagai array asosiatif

        $stmt->close();
        return $transaction;
    }

    // Mengambil detail transaksi
    public function getTransactionDetails($id_transaksi)
    {
        $query = "SELECT dt.id_transaksi, b.nama_barang, dt.jumlah, dt.harga AS harga_satuan, (dt.jumlah * dt.harga) AS subtotal
                  FROM db_detail_transaksi dt
                  JOIN db_barang b ON dt.id_barang = b.id_barang
                  WHERE dt.id_transaksi = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id_transaksi);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // Pastikan data dikembalikan sebagai array asosiatif
    }
    
}


?>
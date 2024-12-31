<?php

require_once 'Connect/Database.php';

class ModelTransaksi {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }

    public function connectDatabase() {
        $database = new Database(); // Koneksi database
        $this->db = $database->connect();
    }

    // Simpan transaksi uta

    public function saveTransaksi($id_user, $total_harga, $status) {
        $query = "INSERT INTO db_transaksi (id_user, total_harga, status, tanggal) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $id_user, $total_harga, $status);

        if ($stmt->execute()) {
            return $this->db->insert_id; // Mengembalikan id_transaksi yang baru dibuat
        }
        return false;
    }

    // Menyimpan detail transaksi
    public function saveDetailTransaksi($id_transaksi, $id_barang, $total_harga_item) {
        $query = "INSERT INTO db_detail_transaksi (id_transaksi, id_barang, total_harga) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $id_transaksi, $id_barang, $total_harga_item);
        return $stmt->execute();
    }

    // Menghapus item dari keranjang setelah checkout
    // public function deleteCartItems($id_user) {
    //     $query = "DELETE FROM db_cart WHERE id_user = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bind_param("i", $id_user);
    //     return $stmt->execute();
    // }


    public function getListTransaksi($id_user) {
        $query = "
            SELECT 
                t.id_transaksi, 
                t.tanggal, 
                t.total_harga AS total_all, 
                t.status, 
                d.id_barang, 
                c.jumlah, 
                d.total_harga, 
                b.nama_barang, 
                b.harga_barang, 
                b.gambar_barang
            FROM db_transaksi t
            JOIN db_detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN db_barang b ON d.id_barang = b.id_barang
            JOIN db_cart c ON d.id_barang = c.id_barang
            WHERE t.id_user = ?
            ORDER BY t.tanggal DESC
        ";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Query Error: " . $this->db->error); // Debug error kueri
        }
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            die("No data found for id_user: $id_user");
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    
    
    
    

}




?>
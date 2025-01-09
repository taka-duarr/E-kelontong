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

    public function saveTransaksi($id_user, $total_harga, $status, $alamat) {
        $query = "INSERT INTO db_transaksi (id_user, total_harga, status, alamat, tanggal) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiis", $id_user, $total_harga, $status, $alamat);

        if ($stmt->execute()) {
            return $this->db->insert_id; // Mengembalikan id_transaksi yang baru dibuat
        }
        return false;
    }

    // Menyimpan detail transaksi
    public function saveDetailTransaksi($id_transaksi, $id_barang, $jumlah, $total_harga_item) {
        $queryInsert = "
            INSERT INTO db_detail_transaksi (id_transaksi, id_barang, jumlah, total_harga)
            VALUES (?, ?, ?, ?)
        ";
        $stmtInsert = $this->db->prepare($queryInsert);
        if (!$stmtInsert) {
            die("Query Error: " . $this->db->error);
        }
    
        $stmtInsert->bind_param("iiii", $id_transaksi, $id_barang, $jumlah, $total_harga_item);
        return $stmtInsert->execute();
    }
    
    

    public function getCartItemsByUser($id_user) {
        $query = "
            SELECT 
                c.id_barang, 
                c.jumlah, 
                b.harga_barang
            FROM db_cart c
            JOIN db_barang b ON c.id_barang = b.id_barang
            WHERE c.id_user = ?
        ";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Query Error: " . $this->db->error); // Debug error kueri
        }
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // Mengembalikan array data keranjang
    }
    

    public function getListTransaksi($id_user) {
        $query = "
            SELECT 
                t.id_transaksi, 
                t.tanggal, 
                t.total_harga AS total_all, 
                t.status,
                t.alamat,
                t.nama_kurir,
                t.ongkir,
                t.total_afterongkir,
                t.bukti_pengiriman,
                d.jumlah,
                d.id_barang,
                d.total_harga,
                b.nama_barang, 
                b.harga_barang 
            FROM db_transaksi t
            JOIN db_detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN db_barang b ON d.id_barang = b.id_barang
            WHERE t.id_user = ?
        ";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    
    

    public function deleteCartItems($id_user) {
        $query = "DELETE FROM db_cart WHERE id_user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_user);
        return $stmt->execute();
    }
    public function deleteDetailTransaksi($id_user) {
        $query = "
            DELETE d
            FROM db_detail_transaksi d
            JOIN db_transaksi t ON d.id_transaksi = t.id_transaksi
            WHERE t.id_user = ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_user);
        return $stmt->execute();
    }
    
    
    
    
    
    

}

?>
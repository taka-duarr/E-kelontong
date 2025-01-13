<?php
require_once 'Connect/Database.php';
require_once 'Model/Model_barang.php';
class ModelKeranjang {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }
    
    public function connectDatabase() {
        //Aggregation adalah jenis hubungan "has-a" di mana objek yang satu dapat berdiri sendiri tanpa keberadaan objek lainnya.
        $database = new Database();
        $this->db = $database->connect(); 
    }

    public function createKeranjang($id_user, $id_barang, $jumlah) {
        // Cek apakah barang sudah ada di keranjang
        $query = "SELECT jumlah FROM db_cart WHERE id_user = ? AND id_barang = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $id_user, $id_barang);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Jika barang sudah ada, tambahkan jumlahnya
            $row = $result->fetch_assoc();
            $new_jumlah = $row['jumlah'] + $jumlah;
    
            $updateQuery = "UPDATE db_cart SET jumlah = ? WHERE id_user = ? AND id_barang = ?";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bind_param("iii", $new_jumlah, $id_user, $id_barang);
            $updateStmt->execute();
            return $updateStmt->affected_rows > 0;
        } else {
            // Jika barang belum ada, masukkan data baru
            $insertQuery = "INSERT INTO db_cart (id_user, id_barang, jumlah) VALUES (?, ?, ?)";
            $insertStmt = $this->db->prepare($insertQuery);
            $insertStmt->bind_param("iii", $id_user, $id_barang, $jumlah);
            $insertStmt->execute();
            return $insertStmt->affected_rows > 0;
        }
    }
    

    public function getAllKeranjang($id_user) {
        // Query yang sudah diperbaiki
        $sql = "SELECT c.id_cart, b.nama_barang, b.harga_barang, c.jumlah, b.gambar_barang, b.id_barang
                FROM db_cart c
                JOIN db_barang b ON c.id_barang = b.id_barang
                WHERE c.id_user = ?"; // Gunakan ? sebagai placeholder
        
        // Persiapkan statement MySQLi
        $stmt = $this->db->prepare($sql);
        
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

    public function deleteKeranjang($id_cart) {
        $query = "DELETE FROM db_cart WHERE id_cart = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_cart);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function updateKeranjang($id_barang, $jumlah) {
        $query = "UPDATE db_cart SET jumlah = ? WHERE id_barang = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $jumlah, $id_barang);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }


    public function clearKeranjangByUser($id_user) {
        $query = "DELETE FROM keranjang WHERE id_user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
    }
    

   
    
}
    

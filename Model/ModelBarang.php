<?php
class ModelBarang {
    private $db;

    public function __construct() {
        $this->connectDatabase();
    }

    
    
        public function connectDatabase() {
            $host = "localhost";
            $user = "root";
            $password = "";
            $dbname = "toko_mlijo";
    
            $this->db = new mysqli($host, $user, $password, $dbname);
    
            if ($this->db->connect_error) {
                return "Koneksi database gagal: " . $this->db->connect_error;
            }
    
            return "Koneksi database berhasil!";
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

    public function createBarang($nama_barang,$stok_barang, $harga_barang, $gambar_barang) {
        $query = "INSERT INTO db_barang (nama_barang,stok_barang, harga_barang, gambar_barang) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss" , $nama_barang, $stok_barang,$harga_barang, $gambar_barang);
        
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>

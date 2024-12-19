<?php
class Database {
    private $db;

    public function connect() {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "toko_mlijo";
    
        $this->db = new mysqli($host, $user, $password, $dbname);
    
        if ($this->db->connect_error) {
            die("Koneksi database gagal: " . $this->db->connect_error);
        }

        return $this->db;
    }
}
?>

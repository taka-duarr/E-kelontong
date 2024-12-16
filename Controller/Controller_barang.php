<?php
require_once 'Model/Model_barang.php';

class BarangController {
    private $model;

    public function __construct() {
        $this->model = new ModelBarang();
    }

    public function list_barang() {
        $Barangs = $this->model->getAllBarang();
        
            // include 'Views/customer/shop.php'; // View untuk customer
        
            include 'Views/admin/barang_list.php'; // View untuk admin
        
    }

    public function customerShop() {
        $Barangs = $this->model->getAllBarang(); // Ambil semua barang dari model
        include 'Views/customer/shop.php'; // Oper view shop.php
    }
    

    

    public function addBarang() {
        // Pastikan metode ini tidak menerima argumen
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_barang = $_POST['nama_barang'] ?? null;
            $stok_barang = $_POST['stok_barang'] ?? null;
            $harga_barang = $_POST['harga_barang'] ?? null;
            $gambar_barang = $_FILES['gambar_barang']['name'] ?? null;
            $status_barang = $_POST['status_barang'] ?? null;
    
            // Validasi
            if ($nama_barang && $stok_barang && $harga_barang && $status_barang) {
                // Proses upload gambar
                if (!empty($gambar_barang)) {
                    $targetDir = "imgBarang/";
                    $targetFile = $targetDir . basename($gambar_barang);
                    move_uploaded_file($_FILES["gambar_barang"]["tmp_name"], $targetFile);
                }
    
                // Simpan data
                $this->model->createBarang($nama_barang, $stok_barang, $harga_barang, $gambar_barang, $status_barang);
    
                // Redirect ke halaman daftar barang
                header("Location: index.php?modul=barang&fitur=list");
                exit;
            } else {
                echo "Semua field harus diisi!";
            }
        } else {
            // Jika bukan POST, tampilkan form input
            include 'Views/admin/barang_input.php';
        }
    }
    
    

    // public function delete($id_barang) {
    //     $this->model->deleteBarang($id_barang);
    //     header("Location: index.php?modul=barang&fitur=list");
    // }

    // public function edit($id_barang, $nama, $harga, $gambar) {
    //     $this->model->updateBarang($id_barang, $nama, $harga, $gambar);
    //     header("Location: index.php?modul=barang&fitur=list");
    // }
}
?>

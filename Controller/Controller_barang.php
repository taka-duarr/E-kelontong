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
    

    

    public function create($nama, $harga, $gambar) {
        $this->model->createBarang($nama, $harga, $gambar);
        header("Location: index.php?modul=barang&fitur=list");
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

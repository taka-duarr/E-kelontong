<?php
require_once 'Model/Model_keranjang.php';

class ControllerKeranjang {
    private $ModelKeranjang;

    public function __construct() {
        $this->ModelKeranjang = new ModelKeranjang();
    }

    public function addKeranjang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userId = $_SESSION['user'] ?? null;
            $barangId = $_POST['id_barang'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;

            $result = $this->ModelKeranjang->createKeranjang($userId, $barangId, $jumlah);

            if ($result) {
                header('Location: index.php?modul=cart&fitur=list');
            } else {
                echo "Error adding to cart.";
            }
        }
    }

    
        public function listKeranjang() {
            $id_user = $_SESSION['user'] ?? null;
    
            if ($id_user === null) {
                die("ID user tidak ditemukan. Pastikan Anda sudah login.");
            }
    
            
            $Carts = $this->ModelKeranjang->getAllKeranjang($id_user['id']);

            echo '<pre>';
    print_r($Carts);
    echo '</pre>';
    
            require_once 'Views/customer/cart.php'; // Tampilkan data keranjang
        }
    
    
}

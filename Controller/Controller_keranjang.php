<?php
require_once 'Model/Model_keranjang.php';

class ControllerKeranjang {
    private $ModelKeranjang;

    public function __construct() {
        $this->ModelKeranjang = new ModelKeranjang();
    }

    public function addKeranjang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     echo '<pre>';
        // print_r($_POST); // Debug data POST
        // echo '</pre>';


        // echo '<pre>';
        // print_r($_SERVER);
        // print_r($_POST);
        // print_r($_GET);
        // echo '</pre>';
        // die();

            $id_user = $_SESSION['user'] ?? null;
            $id_barang = $_POST['id_barang'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;

            $result = $this->ModelKeranjang->createKeranjang($id_user, $id_barang, $jumlah);

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
    
            
            $Carts = $this->ModelKeranjang->getAllKeranjang($id_user);

    //         echo '<pre>';
    // print_r($Carts);
    // echo '</pre>';
    
            require_once 'Views/customer/cart.php'; // Tampilkan data keranjang
        }
    
    
}

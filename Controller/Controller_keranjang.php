<?php
require_once 'Model/Model_keranjang.php';

class ControllerKeranjang {
    private $ModelKeranjang;

    public function __construct() {
        $this->ModelKeranjang = new ModelKeranjang();
    }

    public function addKeranjang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_SESSION['user']['id'] ?? null;
            $id_barang = $_POST['id_barang'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;

            $result = $this->ModelKeranjang->createKeranjang($id_user, $id_barang, $jumlah);

            if ($result) {
                $_SESSION['notification'] = "Item berhasil ditambahkan ke keranjang!";
                header('Location: index.php?modul=cust&fitur=shop');
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

            // Menambahkan item ke dalam session cart
           


    //         echo '<pre>';
    // print_r($Carts);
    // echo '</pre>';
    
            require_once 'Views/customer/cart.php'; // Tampilkan data keranjang
        }

    public function deleteKeranjang($id_cart) {
        $result = $this->ModelKeranjang->deleteKeranjang($id_cart);
        header('Location: index.php?modul=cart&fitur=list');
    }

    public function updateKeranjang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_barang = $_POST['id_barang'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;

            $result = $this->ModelKeranjang->updateKeranjang($id_barang, $jumlah);

            if ($result) {
                $_SESSION['notification'] = "Item berhasil diupdate!";
                header('Location: index.php?modul=cart&fitur=list');
            } else {
                echo "Error updating cart.";
            }
        }
    }

    
    
}

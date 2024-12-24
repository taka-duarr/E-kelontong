<?php
require_once 'Model/Model_keranjang.php';

class ControllerKeranjang {
    private $ModelKeranjang;

    public function __construct() {
        $this->ModelKeranjang = new ModelKeranjang();
    }

    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // if (!isset($_SESSION['id_user'])) {
            //     header('Location: index.php?modul=login&fitur=login');
            //     exit;
            // }

            $userId = $_SESSION['id_user']['id'];
            $barangId = $_POST['id_barang'];
            $jumlah = $_POST['jumlah'] ?? 1;

            $result = $this->ModelKeranjang->addToCart($userId, $barangId, $jumlah);

            if ($result) {
                header('Location: index.php?modul=cart&fitur=list');
            } else {
                echo "Error adding to cart.";
            }
        }
    }

    public function listCartItems() {
        
        // if (!isset($_SESSION['id_user'])) {
        //     header('Location: index.php?modul=login&fitur=login');
        //     exit;
        // }

        $userId = $_SESSION['user']['id'];
        $items = $this->ModelKeranjang->getCartItems($userId);
        include 'Views/customer/cart.php';
    }
}

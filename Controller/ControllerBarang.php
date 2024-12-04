<?php
require_once  'Model/ModelBarang.php';



class HomeController {
    public function index() {
        // Panggil model untuk mengambil data barang
        $ModelBarang = new ModelBarang();
        $barang = $ModelBarang->getAllBarang();
        // Kirim data barang ke view
        require_once 'Views/dasboard.php';
    }
}
?>

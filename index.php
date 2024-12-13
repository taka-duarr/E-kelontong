<?php
require_once 'Controller/ControllerBarang.php';

// Buat instance controller
$controller = new ControllerBarang();

// Panggil fungsi index untuk menampilkan daftar barang
$controller->index();
?>

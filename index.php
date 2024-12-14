<?php
require_once 'Controller/Controller_barang.php';

// Routing berdasarkan modul dan fitur
$modul = $_GET['modul'] ?? 'barang';
$fitur = $_GET['fitur'] ?? 'list';

$controller = new BarangController();

if ($modul === 'barang') {
    switch ($fitur) {
        case 'list':
            $controller->list_barang();

            break;


        case 'input':
            // Contoh: Form input barang
            $controller->create($_POST['nama_barang'],$_POST['stok_barang'], $_POST['harga_barang'], $_POST['gambar_barang']);
            break;

        // case 'delete':
        //     $controller->delete($_GET['id_barang']);
        //     break;

        // case 'edit':
        //     $controller->edit($_POST['id_barang'], $_POST['nama'], $_POST['harga'], $_POST['gambar']);
        //     break;

        default:
            echo "Fitur tidak ditemukan!";
            break;
    }
}elseif ($modul === 'cust') {
    switch ($fitur) {
        case 'shop':
            $controller->customerShop();
            break;
        default:
            echo "Fitur tidak ditemukan!";
            break;
    }
}
?>

<?php
require_once 'Model/ModelBarang.php'; // Sesuaikan path jika diperlukan

// Membuat instance dari ModelBarang
$model = new ModelBarang();

// --- Create ---
echo "Testing Create...\n";
$model->createBarang('Produk F',1 , 60000, 'produk_f.jpg');
$model->createBarang('Produk G',2 , 70000, 'produk_g.jpg');

// --- Read ---
echo "Testing Read...\n";
$dataBarang = $model->getAllBarang();
print_r($dataBarang);

// // --- Update ---
// echo "Testing Update...\n";
// $model->updateBarang(1, 'Produk A Diperbarui', 15000, 'produk_a_update.jpg');

// // --- Read After Update ---
// $dataBarang = $model->getAllBarang();
// print_r($dataBarang);

// // --- Delete ---
// echo "Testing Delete...\n";
// $model->deleteBarang(2); // Menghapus barang dengan ID 2

// // --- Read After Delete ---
// $dataBarang = $model->getAllBarang();
// print_r($dataBarang);

// // --- Get By ID ---
// echo "Testing Get By ID...\n";
// $singleBarang = $model->getBarangById(3); // Mengambil barang dengan ID 3
// print_r($singleBarang);
?>

<?php
require_once 'Model/Model_kurir.php';

class KurirController {
    private $model;

    public function __construct() {
        $this->model = new ModelKurir();
    }

    public function listAllTransaksi() {
    
        $nama_kurir = $_SESSION['user']['username']; // Ambil nama kurir dari session
        $transaksi = $this->model->getTransaksiByKurir($nama_kurir); // Ambil data transaksi berdasarkan nama kurir();
    
        // Proses grouping data seperti sebelumnya
        $groupedTransaksi = [];
        foreach ($transaksi as $item) {
            $id_transaksi = $item['id_transaksi'];
    
            if (!isset($groupedTransaksi[$id_transaksi])) {
                $groupedTransaksi[$id_transaksi] = [
                    "id_transaksi" => $item["id_transaksi"],
                    "tanggal" => $item["tanggal"],
                    "total_all" => $item["total_all"],
                    "alamat" => $item["alamat"],
                    "status" => $item["status"],
                    "nama_kurir" => $item["nama_kurir"],
                    "ongkir" => $item["ongkir"],
                    "total_afterongkir" => $item["total_afterongkir"],
                    "items" => []
                ];
            }
    
            if (!empty($item['id_barang'])) {
                $groupedTransaksi[$id_transaksi]["items"][] = [
                    "id_barang" => $item["id_barang"],
                    "jumlah" => $item["jumlah"],
                    "total_harga" => $item["total_harga"],
                    "nama_barang" => $item["nama_barang"],
                    "harga_barang" => $item["harga_barang"],
                ];
            }
        }
    
        $groupedTransaksi = array_values($groupedTransaksi);
    
        // Kirim data ke view
        include 'Views/kurir/checkout_list.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_transaksi = $_POST['id_transaksi'];
            $status = $_POST['status'];
            $this->model->updateStatusTransaksi($id_transaksi, $status);
            header("Location: index.php?modul=kurir&fitur=list");
            exit;
        }
    }
}
?>
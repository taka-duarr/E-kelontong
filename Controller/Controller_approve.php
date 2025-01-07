<?php
require_once 'Model/Model_approve.php';

class ApproveController {
    private $model;

    public function __construct() {
        $this->model = new ModelApprove();
    }

    public function listAllTransaksi() {
        $transaksi = $this->model->getAllTransaksi();

        // Mengelompokkan data transaksi agar tidak duplikat
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
        include 'Views/admin/list_approve.php';
    }

    public function edit($id_transaksi) {
        $transaksi = $this->model->getTransaksiById($id_transaksi);
        $kurir = $this->model->getAllKurir();

        include 'Views/admin/edit_approve.php';
    }

    

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_transaksi = $_POST['id_transaksi'];
            $status = $_POST['status'];
            $nama_kurir = $_POST['nama_kurir'];
            $ongkir = $_POST['ongkir'];

            $transaksi = $this->model->getAllTransaksi();

            foreach ($transaksi as $item) {
                $total_afterongkir = $item['total_all'] + $ongkir;
            }
            $this->model->UpdateApprove($id_transaksi, $status, $nama_kurir, $ongkir, $total_afterongkir);

            header("Location: index.php?modul=approve&fitur=list");
            exit;
        }
    }
}
?>
<?php
require_once 'Model/Model_approve.php';

class ApproveController {
    private $model;

    public function __construct() {
        $this->model = new ModelApprove();
    }

    // public function approve(){
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id_transaksi = $_POST['id_transaksi'];
        
    //         $this->model->approveTransaction($id_transaksi);
        
    //         header("Location: index.php?modul=approve&fitur=edit");
    //         exit;
    //     }
        
    // }

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
    }
?>
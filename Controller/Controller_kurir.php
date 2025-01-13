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
                    "bukti_pengiriman" => $item["bukti_pengiriman"],
                    "nama_user" => $item["nama_user"],
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

    public function edit($id_transaksi) {
        $transaksi = $this->model->getTransaksiById($id_transaksi);

        include 'Views/kurir/update_kurir.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_transaksi = $_POST['id_transaksi'];
            $status = $_POST['status'];
            $bukti_pengiriman = '';
            // echo "<pre>";
            // print_r($_FILES);
            // echo "</pre>";
    
            // Periksa apakah file diunggah
            if (isset($_FILES['bukti_pengiriman']) && $_FILES['bukti_pengiriman']['error'] === UPLOAD_ERR_OK) {
                $targetDir = "bukti_pengiriman/";
                $bukti_pengiriman = basename($_FILES["bukti_pengiriman"]["name"]);
                $targetFile = $targetDir . $bukti_pengiriman;
                // echo $targetFile;
    
                // Validasi tipe file (hanya gambar yang diperbolehkan)
                $fileType = mime_content_type($_FILES["bukti_pengiriman"]["tmp_name"]);
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($fileType, $allowedTypes)) {
                    echo "Hanya file gambar yang diperbolehkan.";
                    exit;
                }
    
                // Pindahkan file ke folder tujuan
                if (!move_uploaded_file($_FILES["bukti_pengiriman"]["tmp_name"], $targetFile)) {
                    echo "Gagal mengunggah file.";
                    exit;
                }
            }
    
            // Update transaksi di database
            $this->model->updateApprove($id_transaksi, $status, $bukti_pengiriman);
    
            // Redirect setelah update
            header("Location: index.php?modul=kurir&fitur=list");
            exit;
        }
    }
    
}
?>
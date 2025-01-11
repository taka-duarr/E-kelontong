<?php
require_once 'Model/Model_approve.php';
require_once '../vendor/autoload.php'; // Pastikan autoload Composer di-load
use Dompdf\Dompdf;

class ApproveController {
    private $model;

    public function __construct() {
        $this->model = new ModelApprove();
    }

    public function listAllTransaksi() {
        $transaksi = $this->model->getAllTransaksi();
        $kurir = $this->model->getAllKurir();
    
        // Ambil filter dari request (GET)
        $filterTanggal = $_GET['tanggal'] ?? null;
        $filterStatus = $_GET['status'] ?? null;
        $filterNamaKurir = $_GET['nama_kurir'] ?? null;
    
        // Terapkan filter tanggal
        if ($filterTanggal) {
            $transaksi = array_filter($transaksi, function ($item) use ($filterTanggal) {
                // Pastikan item['tanggal'] ada dan formatnya sesuai
                $tanggalData = $item['tanggal'] ?? null;
        
                if (!$tanggalData) {
                    return false; // Jika tidak ada tanggal, lewati
                }
        
                // Konversi tanggal ke format standar jika diperlukan
                $tanggalData = date('Y-m-d', strtotime($tanggalData));
                $filterTanggal = date('Y-m-d', strtotime($filterTanggal));
        
                // Bandingkan tanggal
                return $tanggalData === $filterTanggal;
            });
        }
        
        
    
        // Terapkan filter status
        if ($filterStatus !== null && $filterStatus !== '') {
            $transaksi = array_filter($transaksi, function ($item) use ($filterStatus) {
                return (string) $item['status'] === $filterStatus;
            });
        }
    
        // Terapkan filter nama kurir
        // Terapkan filter nama kurir
        if ($filterNamaKurir) {
            $transaksi = array_filter($transaksi, function ($item) use ($filterNamaKurir) {
                return isset($item['nama_kurir']) && is_string($item['nama_kurir']) && stripos($item['nama_kurir'], $filterNamaKurir) !== false;
            });
        }

            
    
        // Mengelompokkan data transaksi
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

        if (isset($_GET['fitur']) && $_GET['fitur'] === 'printReport') {
            // Gunakan Dompdf untuk mencetak laporan
            ob_start();
            include 'Views/admin/print_report.php'; // Pastikan template sudah sesuai
            $html = ob_get_clean();
    
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
    
            // Kirim file PDF ke browser
            $dompdf->stream("laporan_transaksi.pdf", ["Attachment" => false]);
            exit;
        }
    
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
    
            // Ambil semua data transaksi
            $transaksi = $this->model->getAllTransaksi();
    
            $total_afterongkir = null;
            foreach ($transaksi as $item) {
                if ($item['id_transaksi'] == $id_transaksi) {
                    $total_afterongkir = $item['total_all'] + $ongkir;
                    break; // Hentikan iterasi setelah menemukan transaksi yang sesuai
                }
            }
    
            if ($total_afterongkir !== null) {
                // Update data transaksi
                $this->model->UpdateApprove($id_transaksi, $status, $nama_kurir, $ongkir, $total_afterongkir);
    
                // Redirect ke halaman list setelah update
                header("Location: index.php?modul=approve&fitur=list");
                exit;
            } else {
                echo "Transaksi tidak ditemukan.";
            }
        }
    }
    
    

}
?>
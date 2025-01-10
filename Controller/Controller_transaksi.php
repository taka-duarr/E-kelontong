    <?php
    require_once 'Model/Model_transaksi.php';
    class TransaksiController {
        private $model;
    
        public function __construct() {
            $this->model = new ModelTransaksi();
        }
    
public function checkout($id_user) {
    $nama_user = $_SESSION['user']['username'];
    $cart_items = $this->model->getCartItemsByUser($id_user);
    $alamat = $_POST['alamat'] ?? 'nuuh';

    if (empty($alamat)) {
        die("Alamat pengiriman harus diisi. Silakan kembali dan lengkapi alamat Anda.");
    }

    if (empty($cart_items)) {
        die("Keranjang kosong. Tidak ada transaksi yang dapat dilakukan.");
    }

    $total_harga = 0;
    foreach ($cart_items as $item) {
        if (!isset($item['jumlah'], $item['harga_barang'])) {
            die("Data item tidak lengkap: " . json_encode($item));
        }
        $total_harga += $item['jumlah'] * $item['harga_barang'];
    }

    $status = 'pending';
    $id_transaksi = $this->model->saveTransaksi($id_user,$nama_user, $total_harga, $status, $alamat);

    if ($id_transaksi) {
        foreach ($cart_items as $item) {
            $total_harga_item = $item['jumlah'] * $item['harga_barang'];
            $this->model->saveDetailTransaksi($id_transaksi, $item['id_barang'], $item['jumlah'], $total_harga_item);
        }

        if (!$this->model->deleteCartItems($id_user)) {
            die("Gagal menghapus keranjang setelah checkout.");
        }

        echo "Transaksi berhasil dilakukan, ID Transaksi: " . $id_transaksi;
        header("Location: index.php?modul=transaksi&fitur=list");
        exit;
    } else {
        die("Gagal menyimpan transaksi.");
    }
}

    public function listTransaksi() {
        $id_user = $_SESSION['user']['id'];
        $transaksi = $this->model->getListTransaksi($id_user);
    
        // Mengelompokkan data transaksi agar tidak duplikat
        $groupedTransaksi = [];
        foreach ($transaksi as $item) {
            $id_transaksi = $item['id_transaksi'];
    
            // Jika transaksi belum ada, tambahkan
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
                    "items" => [] // Selalu inisialisasi items sebagai array kosong
                ];
            }
    
            // Jika ada detail barang, tambahkan ke items
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
    
        // Reset indeks array agar berurutan
        $groupedTransaksi = array_values($groupedTransaksi);
    
        // Kirim data ke view
        include 'Views/customer/invoice.php';
        
    }

    

        
}
    ?>


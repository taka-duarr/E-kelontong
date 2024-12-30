    <?php

    require_once 'Model/Model_transaksi.php';



    class TransaksiController {
        private $model;
    
        public function __construct() {
            $this->model = new ModelTransaksi();
        }
    
        public function checkout($id_user, $cart_items) {
            $total_harga = 0;
            foreach ($cart_items as $item) {
                $total_harga += $item['harga'] * $item['jumlah'];
            }
    
            // Simpan transaksi utama
            $status = 1; // Status transaksi 'Diproses'
            $id_transaksi = $this->model->saveTransaksi($id_user, $total_harga, $status);
    
            if ($id_transaksi) {
                // Simpan detail transaksi
                foreach ($cart_items as $item) {
                    $id_barang = $item['id_barang'];
                    $jumlah = $item['jumlah'];
                    $total_harga_item = $item['harga'] * $jumlah;
                    $this->model->saveDetailTransaksi($id_transaksi, $id_barang, $jumlah, $total_harga_item);
                }
    
                // Setelah transaksi disimpan, arahkan pengguna ke halaman transaksi list
                header("Location: index.php?modul=transaksi&fitur=list");
                exit;
            } else {
                echo "Gagal menyimpan transaksi!";
            }
    
        }
        public function listTransaksi() {
            $id_user = $_SESSION['user']['id'];
            $transaksi = $this->model->getListTransaksi($id_user);
            include 'Views/customer/invoice.php';
        }

        
}
    ?>


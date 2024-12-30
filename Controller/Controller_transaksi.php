    <?php

    require_once 'Model/Model_transaksi.php';



    class TransaksiController {
        private $model;
    
        public function __construct() {
            $this->model = new ModelTransaksi();
        }
    
        public function checkout($id_user, $cart_items) {
        $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        
       


        // Menghitung total harga dari keranjang
        $total_harga = 0;
        foreach ($cart_items as $item) {
            $total_harga += $item['jumlah'] * $item['jumlah'];
        }

        // Menyimpan transaksi baru
        $status = 'pending'; // Status bisa disesuaikan sesuai kebutuhan
        $id_transaksi = $this->model->saveTransaksi($id_user, $total_harga, $status);

        if ($id_transaksi) {
            // Menyimpan detail transaksi
            foreach ($cart_items as $item) {
                $this->model->saveDetailTransaksi($id_transaksi, $item['id_barang'], $item['jumlah'], $item['jumlah'] * $item['jumlah']);
            }

            // Menghapus data keranjang setelah checkout
            // $model->deleteCartItems($id_user);

            // Redirect atau beri feedback setelah transaksi berhasil
            echo "Transaksi berhasil dilakukan, ID Transaksi: " . $id_transaksi;
        } else {
            // Jika ada kesalahan saat membuat transaksi
            echo "Gagal melakukan transaksi.";
        }
    }
        public function listTransaksi() {
            $id_user = $_SESSION['user']['id'];
            $transaksi = $this->model->getListTransaksi($id_user);
            include 'Views/customer/invoice.php';
        }

        
}
    ?>


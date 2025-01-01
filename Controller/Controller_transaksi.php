    <?php

    require_once 'Model/Model_transaksi.php';



    class TransaksiController {
        private $model;
    
        public function __construct() {
            $this->model = new ModelTransaksi();
        }
    
        public function checkout($id_user, $cart_items) {
        $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $filteredData = array_filter($cart_items, function ($item) {
            return !empty($item['id_barang']) && !empty($item['jumlah']) && isset($item['harga_barang']);
        });
        
        // Fungsi untuk menghilangkan elemen duplikat
        $uniqueData = array_values(array_unique($filteredData, SORT_REGULAR));
        
        // Output hasil
        print_r($uniqueData);
//         echo '<pre>';
// print_r($cart_items);
// echo '</pre>';
// die();



        
       


        // Menghitung total harga dari keranjang
        $total_harga = 0;
        foreach ($uniqueData as $item) {
            $total_harga += $item['jumlah'] * $item['harga_barang'];
        }

        // Menyimpan transaksi baru
        $status = 'pending'; // Status bisa disesuaikan sesuai kebutuhan
        $id_transaksi = $this->model->saveTransaksi($id_user, $total_harga, $status);
       

        if ($id_transaksi) {
            // Menyimpan detail transaksi
            foreach ($uniqueData as $item) {
                $this->model->saveDetailTransaksi($id_transaksi, $item['id_barang'], $item['jumlah'], $item['jumlah'] * $item['jumlah']);
            }

            // Menghapus data keranjang setelah checkout
            // $model->deleteCartItems($id_user);

            // Redirect atau beri feedback setelah transaksi berhasil
            echo "Transaksi berhasil dilakukan, ID Transaksi: " . $id_transaksi;
            header("Location: index.php?modul=transaksi&fitur=list");
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


    <?php

    require_once 'Model/Model_transaksi.php';



    class TransaksiController {
        private $model;
    
        public function __construct() {
            $this->model = new ModelTransaksi();
        }
    
//         public function checkout($id_user, $cart_items) {
//         $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
//         // $filteredData = array_filter($cart_items, function ($item) {
//         //     return !empty($item['id_barang']) && !empty($item['jumlah']) && isset($item['harga_barang']);
//         // });
        
//         // // Fungsi untuk menghilangkan elemen duplikat
//         // $uniqueData = array_values(array_unique($filteredData, SORT_REGULAR));
        
//         // // Output hasil
//         // print_r($uniqueData);
//          echo '<pre>';
//         print_r($cart_items);
//         echo '</pre>';
// die();   

//         // Menghitung total harga dari keranjang
//         $total_harga = 0;
//         foreach ($uniqueData as $item) {
//             $total_harga += $item['jumlah'] * $item['harga_barang'];
//         }

//         // Menyimpan transaksi baru
//         $status = 'pending'; // Status bisa disesuaikan sesuai kebutuhan
//         $id_transaksi = $this->model->saveTransaksi($id_user, $total_harga, $status);
       

//         if ($id_transaksi) {
//             // Menyimpan detail transaksi
//             foreach ($uniqueData as $item) {
//                 $this->model->saveDetailTransaksi($id_transaksi, $item['id_barang'], $item['jumlah'] * $item['harga_barang']);

//             }

//             // if (!$this->model->deleteDetailTransaksi($id_user)) {
                
//             //     die("Gagal menghapus detail transaksi.");
//             // }

//             // if (!$this->model->deleteCartItems($id_user)) {
//             //     die("Gagal menghapus keranjang.");
//             // }

//             // Redirect atau beri feedback setelah transaksi berhasil
//             echo "Transaksi berhasil dilakukan, ID Transaksi: " . $id_transaksi;
//             header("Location: index.php?modul=transaksi&fitur=list");
//         } else {
//             // Jika ada kesalahan saat membuat transaksi
//             echo "Gagal melakukan transaksi.";
//         }

//         unset($_SESSION['cart']);
     
//     }

    public function checkout($id_user) {
        // Ambil data keranjang dari database
        $cart_items = $this->model->getCartItemsByUser($id_user);
        
        // Validasi jika keranjang kosong
        if (empty($cart_items)) {
            die("Keranjang kosong. Tidak ada transaksi yang dapat dilakukan.");
        }

        // Hitung total harga
        $total_harga = 0;
        foreach ($cart_items as $item) {
            $total_harga += $item['jumlah'] * $item['harga_barang'];
        }

        // Simpan transaksi utama
        $status = 'pending'; // Status bisa disesuaikan
        $id_transaksi = $this->model->saveTransaksi($id_user, $total_harga, $status);

        if ($id_transaksi) {
            // Simpan detail transaksi
            foreach ($cart_items as $item) {
                $total_harga_item = $item['jumlah'] * $item['harga_barang'];
                $this->model->saveDetailTransaksi($id_transaksi, $item['id_barang'], $total_harga_item);
            }

            // Hapus data keranjang setelah transaksi selesai
            if (!$this->model->deleteCartItems($id_user)) {
                die("Gagal menghapus keranjang setelah checkout.");
            }

            // Redirect atau tampilkan pesan sukses
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
                    "total_harga" => $item["total_harga"],
                    "status" => $item["status"],
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


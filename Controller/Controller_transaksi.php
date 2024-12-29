<?php

require_once 'Model/Model_transaksi.php';

class TransaksiController {
    private $Model_transaksi;

    public function __construct() {
        $this->Model_transaksi = new ModelTransaksi();
    }

    // Proses checkout
    public function checkout($id_user, $cartItems) {
        $_SESSION['user']['id'] = $id_user;
    
        if (empty($cartItems) || !is_array($cartItems)) {
            die("Keranjang kosong. Tidak ada barang untuk diproses.");
        }
    
        $total_harga = 0;
        $details = [];  // Pastikan $details selalu diinisialisasi sebagai array
    
        // Hitung total harga dan siapkan detail transaksi
        foreach ($cartItems as $item) {
            // Periksa apakah 'harga_barang' ada dalam item
            $harga_barang = isset($item['harga_barang']) ? $item['harga_barang'] : 0; // Gunakan 0 jika tidak ada harga
    
            $details[] = [
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah'],
                'harga_barang' => $harga_barang // Gunakan harga_barang yang sudah diperiksa
            ];
    
            $subtotal = $item['jumlah'] * $harga_barang;  // Gunakan harga_barang
            $total_harga += $subtotal;
        }
    
        // Simpan transaksi utama
        $id_transaksi = $this->Model_transaksi->saveTransaksi($id_user, $total_harga, 1);
    
        // Simpan detail transaksi
        $transaction = $this->Model_transaksi->saveDetailTransaksi($id_transaksi, $details);
    
        return $id_transaksi;
    }
    
    


    // Menampilkan transaksi dan detail
    public function listTransaksi() {
        $id_transaksi = $_GET['id_transaksi'] ?? null;
        $transaction = $this->Model_transaksi->getTransaction($id_transaksi);
        $details = $this->Model_transaksi->getTransactionDetails($id_transaksi);

        if (!is_array($details)) {
            $details = [];  // Jika bukan array, set menjadi array kosong
        }

        include 'Views/customer/invoice.php';

       
    }

    
}

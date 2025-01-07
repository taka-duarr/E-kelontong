<!-- <?php
echo '<pre>';
var_dump($transaksi);
echo '</pre>';
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen py-10 px-5">
        <div class="max-w-4xl mx-auto space-y-6">
            <h1 class="text-2xl font-bold text-black text-center">Konfirmasi Transaksi</h1>
            <?php  $groupedTransaksi = array_reverse($groupedTransaksi, true); ?>
            
            <!-- Pengelompokan Berdasarkan Transaksi -->
            <?php foreach ($groupedTransaksi as $id_transaksi => $transaksi): ?>
                <div class="rounded-lg bg-white shadow-lg p-6 border border-gray-300">
                    <!-- Informasi Transaksi -->
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-black">ID Transaksi: <?= $id_transaksi + 1 ?></h2>
                        <p class="text-sm text-gray-600">
                            Tanggal: <?= htmlspecialchars($transaksi['tanggal']) ?> | 
                            Total Harga: Rp <?= number_format($transaksi['total_all'], 0, ',', '.') ?> | 
                            Alamat: <?= htmlspecialchars($transaksi['alamat']) ?> |
                            Status: <?= $transaksi['status'] ? 'sedang dikirim' : 'menunggu persetujuan' ?> |
                            nama kurir : <?= $transaksi['nama_kurir'] ? : 'menunggu persetujuan' ?> |
                            ongkir : <?= $transaksi['ongkir'] ? : 'menunggu persetujuan' ?> |
                            harga setelah ongkir : <?= $transaksi['total_afterongkir'] ? : 'menunggu persetujuan' ?> 
                        </p>
                    </div>

                    <!-- Tabel Barang -->
                    <table class="w-full text-sm text-left text-black mb-4">
                        <thead class="text-xs text-white uppercase bg-black">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama Barang</th>
                                <th class="px-4 py-2">Jumlah</th>
                                <th class="px-4 py-2">Harga Satuan</th>
                                <th class="px-4 py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksi['items'] as $index => $item): ?>
                            <tr class="border-b">
                                <td class="px-4 py-2"><?= $index + 1 ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($item['nama_barang']) ?></td>
                                <td class="px-4 py-2"><?= $item['jumlah'] ?></td>
                                <td class="px-4 py-2">Rp <?= number_format($item['harga_barang'], 0, ',', '.') ?></td>
                                <td class="px-4 py-2">Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>    
                    </table>
                   
                </div>
            <?php endforeach; ?>

            <!-- Pesan Terima Kasih -->
            <div class="text-center mt-8">
                <h3 class="text-gray-800">Terima kasih telah berbelanja di <span class="font-semibold">E-Kelontong!</span></h3>
                <p class="text-sm text-gray-600 mt-2">Barang pesanan Anda akan segera diproses.</p>
            </div>

            <!-- Tombol Kembali -->
            <div class="text-center">
                <a href="index.php?modul=cust&fitur=shop" class="px-6 py-3 text-white bg-black rounded-lg hover:bg-gray-700 transition duration-300">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>  
</body>
</html>

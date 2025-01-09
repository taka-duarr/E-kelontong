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
                            <!-- Tanggal: <?= htmlspecialchars($transaksi['tanggal']) ?> |  -->
                            Total Harga: Rp <?= number_format($transaksi['total_all'], 0, ',', '.') ?> | 
                            <!-- Alamat: <?= htmlspecialchars($transaksi['alamat']) ?> | -->
                            Status: 
                            <?= $transaksi['status'] == 0 ? 'Menunggu persetujuan' : 
                            ($transaksi['status'] == 1 ? 'sedang dikirim' : 
                            ($transaksi['status'] == 2 ? 'telah sampai' : 'Status tidak diketahui')) ?> |
                            <!-- nama kurir : <?= $transaksi['nama_kurir'] ? : 'menunggu persetujuan' ?> | -->
                            <!-- ongkir : <?= $transaksi['ongkir'] ? : 'menunggu persetujuan' ?> | -->
                            harga setelah ongkir : <?= $transaksi['total_afterongkir'] ? : 'menunggu persetujuan' ?> 
                            <!-- bukti pengiriman : <img src="bukti_pengiriman/<?= $transaksi['bukti_pengiriman'] ?>" alt="<?= $transaksi['bukti_pengiriman'] ?>" class="h-15 w-10 object-cover rounded"> -->
                        </p>
                    </div>

                    <!-- Tombol Lihat Detail Barang -->
                    <div class="text-center">
                        <button onclick="showModal(<?= htmlspecialchars(json_encode($transaksi['items'])) ?>)" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition duration-300">
                            Lihat Detail Barang
                        </button>
                    </div>
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

    <!-- Modal Pop-up -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg max-w-lg w-full shadow-lg">
            <h2 class="text-lg font-semibold text-black mb-4">Detail Barang</h2>
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
                <tbody id="modal-body"></tbody>
            </table>
            <div class="text-center">
                <button onclick="hideModal()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Script Modal -->
    <script>
        function showModal(items) {
            const modalBody = document.getElementById('modal-body');
            modalBody.innerHTML = items.map((item, index) => `
                <tr class="border-b">
                    <td class="px-4 py-2">${index + 1}</td>
                    <td class="px-4 py-2">${item.nama_barang}</td>
                    <td class="px-4 py-2">${item.jumlah}</td>
                    <td class="px-4 py-2">Rp ${new Intl.NumberFormat('id-ID').format(item.harga_barang)}</td>
                    <td class="px-4 py-2">Rp ${new Intl.NumberFormat('id-ID').format(item.total_harga)}</td>
                </tr>
            `).join('');
            document.getElementById('modal').classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</body>
</html>

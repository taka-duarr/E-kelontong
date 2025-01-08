<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<!-- Navbar -->
<?php include 'includes/navbar.php'; ?>

<!-- Main container -->
<div class="flex">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="container mx-auto">
            <!-- Button to Insert New Barang -->
          

            <!-- Barang Table -->
            <div class="bg-gray-200 shadow-md rounded my-6">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                    <?php foreach ($groupedTransaksi as $transaksi): ?>
            <div class=" bg-gray-200 border rounded p-5 mb-5 shadow">
                <h2 class="text-xl font-bold">Transaction ID: <?= $transaksi['id_transaksi'] ?></h2>
                <p><strong>Date:</strong> <?= $transaksi['tanggal'] ?></p>
                <p><strong>Total:</strong> Rp <?= number_format($transaksi['total_all'], 0, ',', '.') ?></p>
                <p><strong>Address:</strong> <?= $transaksi['alamat'] ?></p>
                <p><strong>Status:</strong> 
                <?php 
                    if ($transaksi['status'] == 0) {
                        echo 'Belum disetujui';
                    } elseif ($transaksi['status'] == 1) {
                        echo 'Disetujui';
                    } elseif ($transaksi['status'] == 2) {
                        echo 'Telah terkirim';
                    } else {
                        echo 'Status tidak diketahui';
                    }
                    ?>
                </p>
                <p><strong>kurir :</strong> <?= $transaksi['nama_kurir'] ?  : 'belum disetujui'  ?></p>
                <p><strong>ongkir :</strong> <?= $transaksi['ongkir'] ?></p>
                <p><strong>total setelah ongkir :</strong> <?= $transaksi['total_afterongkir']  ?></p>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                    <a href="index.php?modul=kurir&fitur=edit&id_transaksi=<?php echo $transaksi['id_transaksi']; ?>">Update</a>
                </button>
                
                <?php if (!empty($transaksi['items'])): ?>
                    <table class=" table-auto border-collapse w-full mt-5">
                        <thead class="bg-black text-white">
                            <tr>
                                <th class="border px-4 py-2">Item Name</th>
                                <th class="border px-4 py-2">Quantity</th>
                                <th class="border px-4 py-2">Price</th>
                                <th class="border px-4 py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksi['items'] as $item): ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $item['nama_barang'] ?></td>
                                    <td class="border px-4 py-2"><?= $item['jumlah'] ?></td>
                                    <td class="border px-4 py-2">Rp <?= number_format($item['harga_barang'], 0, ',', '.') ?></td>
                                    <td class="border px-4 py-2">Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-red-500">No items found for this transaction.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List pesanan - Tabel</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php include 'includes/navbar.php'; ?>
<div class="flex">
<?php include 'includes/sidebar.php'; ?>
<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto py-8 px-4">
        <header class="text-center mb-8">
            <h1 class="text-3xl font-bold text-black">List Pesanan</h1>
            
        </header>

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total </th>
                        <th> Nama penerima</th>
                        <th> Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupedTransaksi as $transaksi): ?>
                        <tr>
                            <td><?= $transaksi['id_transaksi'] ?></td>
                            <td><?= $transaksi['tanggal'] ?></td>
                            <td>Rp <?= number_format($transaksi['total_afterongkir'], 0, ',', '.') ?></td>
                            <td><?= $transaksi['nama_user']?></td>
                            <td class="badge mt-5 <?= $transaksi['status'] == 0 ? 'badge-warning' : ($transaksi['status'] == 1 ? 'badge-info' : 'badge-success') ?>">
                            <?php 
                            if ($transaksi['status'] == 1) echo 'sedang dikirim';
                            else if ($transaksi['status'] == 2) echo 'telah dikirim';
                            else echo '';
                            
                            ?>
                            </td>
                            <td>
                                <button onclick="showModal(<?= htmlspecialchars(json_encode($transaksi)) ?>)" class="btn btn-primary btn-sm">
                                    Lihat Detail
                                </button>
                                <button class="btn btn-success btn-sm">
                                    <a href="index.php?modul=kurir&fitur=edit&id_transaksi=<?php echo $transaksi['id_transaksi']; ?>">
                                        Update
                                    </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div id="modal" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">Detail Transaksi</h3>
                <div id="modal-header" class="space-y-2 mb-4"></div>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="modal-body"></tbody>
                    </table>
                </div>
                <div class="modal-action">
                    <button onclick="hideModal()" class="btn">Tutup</button>
                </div>
            </div>
        </div>
    </div>

       <div id="image-modal" class="modal">
    <div class="modal-box max-w">
        <!-- Tambahkan batas maksimal ukuran gambar -->
        <img id="image-modal-content" class="max-w-[200px] h-auto mx-auto object-contain" alt="Bukti Pengiriman">
        <div class="modal-action">
            <button onclick="hideImageModal()" class="btn">Tutup</button>
        </div>
    </div>
    </div>

    <script>
        function showModal(transaksi) {
            const { id_transaksi, tanggal, total_afterongkir, alamat, nama_kurir, ongkir, items,bukti_pengiriman, total_all } = transaksi;

            let modalHeader = `
                <p><strong>ID Transaksi:</strong> ${id_transaksi}</p>
                <p><strong>Tanggal:</strong> ${tanggal}</p>
                <p><strong>Alamat:</strong> ${alamat}</p>
                <p><strong>Nama Kurir:</strong> ${nama_kurir}</p>
                <p><strong>Ongkir:</strong> Rp ${new Intl.NumberFormat('id-ID').format(ongkir)}</p>
                <p><strong>Total Harga:</strong> Rp ${new Intl.NumberFormat('id-ID').format(total_all)}</p>
                <p><strong>Total Setelah Ongkir:</strong> Rp ${new Intl.NumberFormat('id-ID').format(total_afterongkir)}</p>
                <p><strong>Bukti Pengiriman:</strong> <button onclick="showImageModal('bukti_pengiriman/${bukti_pengiriman}')" class="btn btn-xs btn-outline btn-info">Lihat Gambar</button></p>
                `;

            const modalBody = items.map((item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.nama_barang}</td>
                    <td>${item.jumlah}</td>
                    <td>Rp ${new Intl.NumberFormat('id-ID').format(item.harga_barang)}</td>
                    <td>Rp ${new Intl.NumberFormat('id-ID').format(item.total_harga)}</td>
                </tr>
            `).join('');

            document.getElementById('modal-header').innerHTML = modalHeader;
            document.getElementById('modal-body').innerHTML = modalBody;
            document.getElementById('modal').classList.add('modal-open');
        }

        function hideModal() {
            document.getElementById('modal').classList.remove('modal-open');
        }
        function hideImageModal() {
            document.getElementById('image-modal').classList.remove('modal-open');
        }
        function showImageModal(imageUrl) {
            const imageModal = document.getElementById('image-modal');
            const imageContent = document.getElementById('image-modal-content');
            imageContent.src = imageUrl;
            imageModal.classList.add('modal-open');
        }

    </script>
</body>
</html>

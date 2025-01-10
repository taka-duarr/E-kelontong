<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kelontong - List Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto py-8 px-4">
        <header class="text-center mb-12">
            <h1 class="text-4xl font-bold text-black">List Transaksi</h1>
            <p class="text-base-content/70 mt-2">Cek detail transaksi Anda di bawah ini</p>
        </header>

        <div class="space-y-6">
            <?php foreach ($groupedTransaksi as  $transaksi): ?>
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="flex justify-between items-center flex-wrap gap-4">
                            <div>
                                <h2 class="card-title">ID Transaksi: <?= $transaksi['id_transaksi'] ?></h2>
                                
                                <p class="text-sm">
                                    Status: 
                                    <span class="badge <?= $transaksi['status'] == 0 ? 'badge-warning' : ($transaksi['status'] == 1 ? 'badge-info' : 'badge-success') ?>">
                                        <?php 
                                        if ($transaksi['status'] == 0) echo 'Menunggu persetujuan';
                                        else if ($transaksi['status'] == 1) echo 'Sedang dikirim';
                                        else echo 'Telah sampai';
                                        ?>
                                    </span>
                                </p>
                                <?php if ($transaksi['status'] == 1 || $transaksi['status'] == 2): ?>
                                    <p class="text-sm">
                                        Total setelah ongkir: <span class="font-semibold text-success">Rp <?= number_format($transaksi['total_afterongkir'], 0, ',', '.') ?></span>
                                    </p>
                                <?php elseif ($transaksi['status'] == 0): ?>
                                <p class="text-sm">
                                    Total Harga: <span class="font-semibold text-success">Rp <?= number_format($transaksi['total_all'], 0, ',', '.') ?></span>
                                </p>
                                <?php endif; ?>
                            </div>
                            <button onclick="showModal(<?= htmlspecialchars(json_encode($transaksi)) ?>)" class="btn bg-black text-white ">
                                Lihat Detail
                            </button>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi['items'] as $item): ?>
                                        <tr>
                                            <td><?= $item['nama_barang'] ?></td>
                                            <td><?= $item['jumlah'] ?></td>
                                            <td>Rp <?= number_format($item['harga_barang'], 0, ',', '.') ?></td>
                                            <td>Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <footer class="text-center mt-12">
            <h3 class="text-xl font-semibold">Terima kasih telah berbelanja di <span class="text-primary">E-Kelontong!</span></h3>
            <p class="text-base-content/70 mt-2">Uangmu Semangatku</p>
            <a href="index.php?modul=cust&fitur=shop" class="btn btn-neutral mt-4">Kembali ke Beranda</a>
        </footer>
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

    <!-- Image Modal -->
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
            const { id_transaksi, status, total_all, total_afterongkir, items, tanggal, alamat, nama_kurir, ongkir, bukti_pengiriman } = transaksi;

            let modalHeader = `
                <p><strong>ID Transaksi:</strong> ${id_transaksi}</p>
                <p><strong>Status:</strong> 
                    <span class="badge ${status == 0 ? 'badge-warning' : (status == 1 ? 'badge-info' : 'badge-success')}">
                        ${status == 0 ? 'Menunggu persetujuan' : status == 1 ? 'Sedang dikirim' : 'Telah sampai'}
                    </span>
                </p>
                <p><strong>Tanggal:</strong> ${tanggal}</p>
                <p><strong>Alamat Pengiriman:</strong> ${alamat}</p>
                <p><strong>Total Harga:</strong> Rp ${new Intl.NumberFormat('id-ID').format(total_all)}</p>
            `;

            if (status > 0) {
                modalHeader += `
                    <p><strong>Nama Kurir:</strong> ${nama_kurir}</p>
                    <p><strong>Ongkir:</strong> Rp ${new Intl.NumberFormat('id-ID').format(ongkir)}</p>
                    <p><strong>Total Harga Setelah Ongkir:</strong> Rp ${
                        total_afterongkir ? new Intl.NumberFormat('id-ID').format(total_afterongkir) : 'Menunggu persetujuan'
                    }</p>
                `;
            }

            if (status == 2) {
                modalHeader += `
                    <p><strong>Bukti Pengiriman:</strong> <button onclick="showImageModal('bukti_pengiriman/${bukti_pengiriman}')" class="btn btn-xs btn-outline btn-info">Lihat Gambar</button></p>
                `;
            }

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

        function showImageModal(imageUrl) {
            const imageModal = document.getElementById('image-modal');
            const imageContent = document.getElementById('image-modal-content');
            imageContent.src = imageUrl;
            imageModal.classList.add('modal-open');
        }

        function hideImageModal() {
            document.getElementById('image-modal').classList.remove('modal-open');
        }
    </script>
</body>
</html>

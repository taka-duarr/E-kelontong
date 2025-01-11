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
        
        <form method="GET" action="index.php" class="flex flex-wrap gap-4 mb-8">
    <input type="hidden" name="modul" value="approve">
    <input type="hidden" name="fitur" value="list">

    <!-- Filter Tanggal -->
    <div class="form-control">
        <label for="tanggal" class="label">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" value="<?= htmlspecialchars($_GET['tanggal'] ?? '') ?>" class="input input-bordered">
    </div>

    <!-- Filter Status -->
    <div class="form-control">
        <label for="status" class="label">Status</label>
        <select name="status" id="status" class="select select-bordered">
            <option value="">Semua</option>
            <option value="0" <?= (isset($_GET['status']) && $_GET['status'] === '0') ? 'selected' : '' ?>>Belum Disetujui</option>
            <option value="1" <?= (isset($_GET['status']) && $_GET['status'] === '1') ? 'selected' : '' ?>>Sedang Dikirim</option>
            <option value="2" <?= (isset($_GET['status']) && $_GET['status'] === '2') ? 'selected' : '' ?>>Telah Sampai</option>
        </select>
    </div>

    <!-- Filter Nama Kurir -->
    

    <div class="form-control">
    <label for="nama_kurir" class="label">Nama Kurir</label>
    <!-- Dropdown untuk memilih nama kurir -->
    <select name="nama_kurir" id="nama_kurir" class="select select-bordered">
        <option value="">semua</option> <!-- Opsi kosongkan -->
        <?php foreach ($kurir as $nama): ?>
            <option value="<?php echo htmlspecialchars($nama); ?>" 
                <?php echo (isset($_GET['nama_kurir']) && $_GET['nama_kurir'] === $nama) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($nama); ?>
            </option>
        <?php endforeach; ?>
    </select>
    </div>


    <!-- Tombol Submit -->
    <div class="form-control">
        <button type="submit" class="btn btn-primary mt-8">Filter</button>
    </div>

    <!-- Tombol Print Report -->
    <div class="form-control">
        <button type="submit" name="fitur" formtarget="_blank" value="printReport" class="btn btn-secondary mt-8">Print Report</button>
    </div>

</form>




        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total </th>
                        <th>nama pemesan</th>
                        <th> Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupedTransaksi as $transaksi): ?>
                        <tr>
                            <td><?= $transaksi['id_transaksi'] ?></td>
                            <td><?= $transaksi['tanggal'] ?></td>
                            <td><?php
                             if ($transaksi['total_afterongkir'] == 0)
                                echo 'Rp '.number_format($transaksi['total_all'], 0, ',', '.');
                            else
                                echo 'Rp '.number_format($transaksi['total_afterongkir'], 0, ',', '.');
                            ?></td>
                            <td><?= $transaksi['nama_user'] ?></td>
                            <td class="badge mt-5 <?= $transaksi['status'] == 0 ? 'badge-warning' : ($transaksi['status'] == 1 ? 'badge-info' : 'badge-success') ?>">
                            <?php 
                            if ($transaksi['status'] == 0) echo 'belum disetujui';
                            else if ($transaksi['status'] == 1) echo 'sedang dikirim';
                            else if ($transaksi['status'] == 2) echo 'telah sampai';
                            else echo '';
                            
                            ?>
                            </td>
                            <td>
                                <button onclick="showModal(<?= htmlspecialchars(json_encode($transaksi)) ?>)" class="btn btn-primary btn-sm">
                                    Lihat Detail
                                </button>
                                <button class="btn btn-success btn-sm">
                                    <a href="index.php?modul=approve&fitur=edit&id_transaksi=<?php echo $transaksi['id_transaksi']; ?>">
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
                <p><strong>Bukti Pengiriman:</strong> <button onclick="showImageModal('bukti_pengiriman/${bukti_pengiriman}  ')" class="btn btn-xs btn-outline btn-info">Lihat Gambar</button></p>
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

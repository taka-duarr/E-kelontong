<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        .transaction { margin-bottom: 30px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; }
        .transaction-header { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .details-table { margin-top: 10px; }
        .details-table th, .details-table td { border: 1px solid #000; padding: 5px; }
        .separator { border-bottom: 2px dashed #ccc; margin: 20px 0; }
    </style>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    <?php foreach ($groupedTransaksi as $item): ?>
        <div class="transaction">
            <div class="transaction-header">
                <strong>ID Transaksi:</strong> <?= htmlspecialchars($item['id_transaksi']) ?><br>
                <strong>Tanggal:</strong> <?= htmlspecialchars($item['tanggal']) ?><br>
                <strong>Total Setelah Ongkir:</strong> Rp <?= number_format($item['total_afterongkir'] ?? $item['total_all'], 0, ',', '.') ?><br>
                <strong>Ongkir:</strong> Rp <?= number_format($item['ongkir'] ?? 0)  ?><br>
                <strong>Nama Pemesan:</strong> <?= htmlspecialchars($item['nama_user'] ?? '-') ?><br>
                <strong>Status:</strong> 
                <?= $item['status'] == 0 ? 'Menunggu Persetujuan' : ($item['status'] == 1 ? 'Sedang Dikirim' : 'Telah Sampai') ?><br>
                <strong>Nama Kurir:</strong> <?= htmlspecialchars($item['nama_kurir'] ?? '-') ?>
            </div>

            <?php if (!empty($item['items'])): ?>
                <table class="details-table">
                    <thead>
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item['items'] as $detail): ?>
                            <tr>
                                <td><?= htmlspecialchars($detail['id_barang']) ?></td>
                                <td><?= htmlspecialchars($detail['nama_barang']) ?></td>
                                <td>Rp <?= number_format($detail['harga_barang'], 0, ',', '.') ?></td>
                                <td><?= htmlspecialchars($detail['jumlah']) ?></td>
                                <td>Rp <?= number_format($detail['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="separator"></div>
    <?php endforeach; ?>
</body>
</html>

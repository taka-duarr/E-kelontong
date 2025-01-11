<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-200 min-h-screen">

<!-- Navbar -->
<?php include 'includes/navbar.php'; ?>

<div class="flex">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="container mx-auto py-8 px-4">
        

        <!-- Insert Button -->
        <div class="mb-6">
            <a href="index.php?modul=barang&fitur=input" class="btn btn-primary">Insert New Barang</a>
        </div>

        <!-- Barang Table -->
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Stok</th>
                        <th>Harga Barang</th>
                        <th>Gambar Barang</th>
                        <th>Status Barang</th>
                        <th >Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($Barangs)): ?>
                        <?php foreach ($Barangs as $barang): ?>
                            <tr>
                                <td><?= htmlspecialchars($barang['id_barang']); ?></td>
                                <td><?= htmlspecialchars($barang['nama_barang']); ?></td>
                                <td><?= htmlspecialchars($barang['stok_barang']); ?></td>
                                <td><?= htmlspecialchars($barang['harga_barang']); ?></td>
                                <td>
                                    <img src="imgBarang/<?= htmlspecialchars($barang['gambar_barang']); ?>" alt="<?= htmlspecialchars($barang['nama_barang']); ?>" class="h-16 w-16 object-cover rounded">
                                </td>
                                <td>
                                    <span class="badge <?= $barang['status_barang'] == 1 ? 'badge-success' : 'badge-error'; ?>">
                                        <?= $barang['status_barang'] == 1 ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="index.php?modul=barang&fitur=edit&id_barang=<?= $barang['id_barang']; ?>" class="btn btn-sm btn-success">Update</a>
                                    <a href="index.php?modul=barang&fitur=delete&id_barang=<?= $barang['id_barang']; ?>" class="btn btn-sm btn-error">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No data available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

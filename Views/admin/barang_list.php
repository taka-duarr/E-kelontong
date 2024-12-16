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
            <div class="mb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="index.php?modul=barang&fitur=input">Insert New Barang</a>
                </button>
            </div>

            <!-- Barang Table -->
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID Barang</th>
                            <th class="w-1/5 py-3 px-4 uppercase font-semibold text-sm">Nama Barang</th>
                            <th class="w-1/6     py-3 px-4 uppercase font-semibold text-sm">Jumlah Stok</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Harga Barang</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">gambar barang</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">status barang</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <!-- Dynamic Rows -->
                        <?php if (!empty($Barangs)): ?>
                            <?php foreach ($Barangs as $barang): ?>
                                <tr class="text-center">
                                    <td class="py-3 px-4 text-blue-600"><?php echo htmlspecialchars($barang['id_barang']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($barang['nama_barang']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($barang['stok_barang']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($barang['harga_barang']); ?></td>
                                    <td class="py-3 px-4"><img src="imgBarang/<?php echo htmlspecialchars($barang['gambar_barang']); ?>" alt="<?php echo htmlspecialchars($barang['nama_barang']); ?>" class="h-25 w-25 object-cover rounded"></td>
                                    <td class="py-3 px-4"><?php echo $barang['status_barang'] == 1 ? "active" : "inactive"; ?></td>
                                    <td class="py-3 px-4">
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                            <a href="index.php?modul=barang&fitur=edit&id_barang=<?php echo $barang['id_barang']; ?>">Update</a>
                                        </button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                            <a href="index.php?modul=barang&fitur=delete&id_barang=<?php echo $barang['id_barang']; ?>">Delete</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">No data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>

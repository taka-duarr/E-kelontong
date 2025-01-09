<!-- <?php
echo '<pre>';
var_dump($barang);
echo '</pre>';
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Barang</title>
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
            <!-- Form Update Barang -->
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Barang</h2>
                <form action="index.php?modul=barang&fitur=update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id_barang" name="id_barang" value="<?php echo htmlspecialchars($barang['id_barang']); ?>">

                    <!-- Nama Barang -->
                    <div class="mb-4">
                        <label for="nama_barang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang:</label>
                        <input type="text" id="nama_barang" name="nama_barang" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            required value="<?php echo htmlspecialchars($barang['nama_barang']); ?>">
                    </div>

                    <!-- Stok Barang -->
                    <div class="mb-4">
                        <label for="stok_barang" class="block text-gray-700 text-sm font-bold mb-2">Stok Barang:</label>
                        <input type="number" id="stok_barang" name="stok_barang" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            required value="<?php echo htmlspecialchars($barang['stok_barang']); ?>">
                    </div>

                    <!-- Harga Barang -->
                    <div class="mb-4">
                        <label for="harga_barang" class="block text-gray-700 text-sm font-bold mb-2">Harga Barang:</label>
                        <input type="text" id="harga_barang" name="harga_barang" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            required value="<?php echo htmlspecialchars($barang['harga_barang']); ?>">
                    </div>

                    
                    
                    <div class="mb-4">
                        <label for="gambar_barang" class="block text-gray-700 text-sm font-bold mb-2">Upload Gambar:</label>
                        <input type="file" id="gambar_barang" name="gambar_barang" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            accept="imgBarang/">
                        <?php if (!empty($barang['gambar_barang'])): ?>
                            <img src="imgBarang/<?php echo htmlspecialchars($barang['gambar_barang']); ?>" alt="gambar_barang" class="mt-2 w-32 h-32 object-cover">
                        <?php endif; ?>
                    </div>
                    <!-- Status Barang -->
                    <div class="mb-4">
                        <label for="status_barang" class="block text-gray-700 text-sm font-bold mb-2">Status Barang:</label>
                        <select id="status_barang" name="status_barang" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="1" <?php echo $barang['status_barang'] == 1 ? 'selected' : ''; ?>>Ada</option>
                            <option value="0" <?php echo $barang['status_barang'] == 0 ? 'selected' : ''; ?>>Tidak Ada</option>
                        </select>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex items-center justify-between">
                        <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

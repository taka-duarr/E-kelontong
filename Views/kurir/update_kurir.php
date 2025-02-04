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
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Persetujuan</h2>
                <form action="index.php?modul=kurir&fitur=update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id_transaksi" name="id_transaksi" value="<?php echo htmlspecialchars($transaksi['id_transaksi']); ?>">

                    <!-- Status Barang -->
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status pesanan:</label>
                        <select id="status" name="status" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="1" <?php echo $transaksi['status'] == 1 ? 'selected' : ''; ?>>Belum sampai</option>
                            <option value="2" <?php echo $transaksi['status'] == 2 ? 'selected' : ''; ?>>Telah sampai</option>
                        </select>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="mb-4">
                        <label for="bukti_pengiriman" class="block text-gray-700 text-sm font-bold mb-2">Upload Gambar:</label>
                        <input type="file" id="bukti_pengiriman" name="bukti_pengiriman" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="bukti_pengiriman/" required>
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

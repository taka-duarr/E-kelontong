<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Kurir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main Container -->
    <div class="flex">

        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="container mx-auto p-8">
            <h1 class="text-2xl font-bold mb-4">Daftar Pesanan</h1>

            <!-- Table Container -->
            <div class="bg-white shadow-md rounded">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">ID </th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Nama Pesanan</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Deskripsi</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <!-- Data Dummy -->
                        <tr>
                            <td class="py-3 px-4">1</td>
                            <td class="py-3 px-4">Sabun</td>
                            <td class="py-3 px-4">Yang aman ya</td>
                            <td class="py-3 px-4">Belum diantar</td>
                            <td class="py-3 px-4">
                                <!-- Tombol "Sedang Diantar" -->
                                <form method="POST" action="update_order_status.php" class="inline-block">
                                    <input type="hidden" name="order_id" value="1">
                                    <input type="hidden" name="status" value="on-delivery">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                        Sedang Diantar
                                    </button>
                                </form>
                                <!-- Tombol "Telah Sampai" -->
                                <form method="POST" action="update_order_status.php" class="inline-block ml-2">
                                    <input type="hidden" name="order_id" value="1">
                                    <input type="hidden" name="status" value="delivered">
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                        Telah Sampai
                                    </button>
                                </form>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

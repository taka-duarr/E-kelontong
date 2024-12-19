<!-- <?php
echo '<pre>';
var_dump($role);
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
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Role</h2>
                <form action="index.php?modul=role&fitur=update" method="POST">
                    <input type="hidden" id="id_role" name="id_role" value="<?php echo htmlspecialchars($role['id_role']); ?>">

                    <!-- Nama Barang -->
                    <div class="mb-4">
                        <label for="nama_role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                        <input type="text" id="nama_role" name="nama_role" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            required value="<?php echo htmlspecialchars($role['nama_role']); ?>">
                    </div>


                    <!-- Status role -->
                    <div class="mb-4">
                        <label for="status_role" class="block text-gray-700 text-sm font-bold mb-2">Status Role:</label>
                        <select id="status_role" name="status_role" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="1" <?php echo $role['status_role'] == 1 ? 'selected' : ''; ?>>Ada</option>
                            <option value="0" <?php echo $role['status_role'] == 0 ? 'selected' : ''; ?>>Tidak Ada</option>
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

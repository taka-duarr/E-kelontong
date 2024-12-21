<!-- <?php
echo '<pre>';
var_dump($user);
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
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update User</h2>
                <form action="index.php?modul=user&fitur=update" method="POST">
                    <input type="hidden" id="id_user" name="id_user" value="<?php echo htmlspecialchars($user['id_user']); ?>">

                    <!-- Nama Barang -->
                    <div class="mb-4">
                        <label for="nama_user" class="block text-gray-700 text-sm font-bold mb-2">User:</label>
                        <input type="text" id="nama_user" name="nama_user" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            required value="<?php echo htmlspecialchars($user['nama_user']); ?>">
                    </div>

                    <div class="mb-4">
                        <label for="password_user" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input type="text" id="password_user" name="password_user" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            required value="<?php echo htmlspecialchars($user['password_user']); ?>">
                    </div>

                    <div class="mb-4">
                        <label for="nama_role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                        <select id="nama_role" name="nama_role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="">Pilih Role</option>
                        <?php foreach ($roles as $role) { ?>
                            <option  value="<?php echo htmlspecialchars($role['nama_role']); ?>">
                                <?php echo htmlspecialchars($role['nama_role']); ?>
                            </option>
                        <?php } ?>
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

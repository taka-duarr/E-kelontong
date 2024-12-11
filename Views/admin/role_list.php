<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Role</title>
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
        <!-- Your main content goes here -->
        <div class="container mx-auto">
            <!-- Button to Insert New Role -->
            <div class="mb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="index.php?modul=role&fitur=input">Insert New Role</a>
                </button>
                    <!-- notifikasi peringatan -->


            </div>

            <!-- Roles Table -->
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-full bg-white grid-cols-1">
                    <thead class="bg-gray-800 text-white">

                    <tr>
                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Role ID</th>
                        <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Role Name</th>
                        <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Role Description</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Role Status</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Gaji</th>
                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>

                    </thead>
                    <tbody class="text-gray-700">
                    <!-- Static Data Rows -->
                    <!-- <?php foreach ($Roles as $role){?> -->
                    <tr class="text-center">
                        <td class="py-3 px-4 text-blue-600">haha</td>
                        <td class="w-1/4 py-3 px-4">test</td>
                        <td class="w-1/3 py-3 px-4">test</td>
                        <td class="w-1/6 py-3 px-4">test</td>
                        <td class="w-1/6 py-3 px-4">test</td>
                                
                        <td class="w-1/6 py-3 px-4">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="index.php?modul=role&fitur=edit&id_peran=<?php echo $role->id_peran ?>">Update</a>
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="index.php?modul=role&fitur=delete&id_peran=<?php echo $role->id_peran ?>">Delete</a>
                            </button>
                        </td>
                        <?php } ?>
                    </tr>



                




                    <!-- <tr class="text-center">
                        <td class="py-3 px-4 text-blue-600">2</td>
                        <td class="w-1/4 py-3 px-4">Editor</td>
                        <td class="w-1/3 py-3 px-4">Can edit content but limited access to settings</td>
                        <td class="w-1/6 py-3 px-4">Active</td>
                        <td class="w-1/6 py-3 px-4">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="#">Update</a>
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="#">Delete</a>
                            </button>
                        </td>
                    </tr> -->

                    <!-- <tr class="text-center">
                        <td class="py-3 px-4 text-blue-600">3</td>
                        <td class="w-1/4 py-3 px-4">Viewer</td>
                        <td class="w-1/3 py-3 px-4">Can only view content, no editing privileges</td>
                        <td class="w-1/6 py-3 px-4">Inactive</td>
                        <td class="w-1/6 py-3 px-4">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="#">Update</a>
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="#">Delete</a>
                            </button>
                        </td>
                    </tr> -->
                    <!-- More rows can be added statically here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List User</title>
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
            <a href="index.php?modul=user&fitur=input" class="btn btn-primary">Insert New User</a>
        </div>

        <!-- User Table -->
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full ">
                <thead>
                    <tr>
                        <th class="w-1/12">ID User</th>
                        <th class="w-1/4">User</th>
                        <th class="w-1/4">Password</th>
                        <th class="w-1/4">Role</th>
                        <th class="w-1/6">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id_user']); ?></td>
                                <td><?= htmlspecialchars($user['nama_user']); ?></td>
                                <td><?= htmlspecialchars($user['password_user']); ?></td>
                                <td><?= htmlspecialchars($user['nama_role']); ?></td>
                                <td>
                                    <a href="index.php?modul=user&fitur=edit&id_user=<?= $user['id_user']; ?>" class="btn btn-sm btn-success">Update</a>
                                    <a href="index.php?modul=user&fitur=delete&id_user=<?= $user['id_user']; ?>" class="btn btn-sm btn-error">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No data available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Role</title>
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
            <a href="index.php?modul=role&fitur=input" class="btn btn-primary">Insert New Role</a>
        </div>

        <!-- Role Table -->
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th class="w-3/12">ID Role</th>
                        <th class="w-3/12">Role Name</th>
                        <th class="w-3/12">Status</th>
                        <th class="w-3/12">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($roles)): ?>
                        <?php foreach ($roles as $role): ?>
                            <tr>
                                <td><?= htmlspecialchars($role['id_role']); ?></td>
                                <td><?= htmlspecialchars($role['nama_role']); ?></td>
                                <td>
                                    <span class="badge <?= $role['status_role'] == 1 ? 'badge-success' : 'badge-error'; ?>">
                                        <?= $role['status_role'] == 1 ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="index.php?modul=role&fitur=edit&id_role=<?= $role['id_role']; ?>" class="btn btn-sm btn-success">Update</a>
                                    <a href="index.php?modul=role&fitur=delete&id_role=<?= $role['id_role']; ?>" class="btn btn-sm btn-error">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No data available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

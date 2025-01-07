<head>
    <!-- Tambahkan Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center py-3 px-5" style="font-family: 'Inter', sans-serif;">
            <!-- Logo / Nama Aplikasi -->
            <div class="text-blue-600 font-semibold text-2xl">
                KURIR
            </div>

            <!-- Bagian Profil dan Navigasi -->
            <div class="flex items-center space-x-4">
                <!-- Informasi Pengguna -->
                <div class="flex flex-col text-right">
                    <span class="text-gray-800 font-semibold">
                        <?= $_SESSION['user']['username'] ?? 'Username'; ?>
                    </span>
                    <span class="text-gray-500 text-sm">
                        <?= $_SESSION['user']['role'] ?? 'Role'; ?>
                    </span>
                </div>

                <a href="index.php?modul=login&fitur=logout">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-full transition duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                        Logout
                    </button>
                </a>
            </div>
        </div>
    </nav>
</body>

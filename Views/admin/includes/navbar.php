<head>
    <!-- Tambahkan Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center py-3 px-5" style="font-family: 'Inter', sans-serif;">
            <!-- Logo / Nama Aplikasi -->
            <div class="text-blue-600 font-semibold text-2xl">
                ADMIN
            </div>

            <!-- Bagian Profil dan Navigasi -->
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <!-- Profil dengan Hover -->
                    <img src="views/includes/pict/gambar.jpg" alt="Profil" class="w-10 h-10 rounded-full border-2 border-blue-600 transition-transform transform hover:scale-105 shadow-sm">
                </div>
                <!-- <span class="text-gray-800 cursor-pointer hover:text-blue-600 transition duration-200 font-medium"><?= $_SESSION['username_login']->username ?></span> -->
                <!-- <span class="text-gray-500 font-medium"><?= $_SESSION['username_login']->role->nama_peran ?></span> -->

                <!-- Tombol Logout tanpa simbol -->
                <a href="index.php?modul=logout">
                    <button class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-full transition duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                        Logout
                    </button>
                </a>
            </div>
        </div>
    </nav>
</body>
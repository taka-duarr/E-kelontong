
<?php
// Menyertakan file model untuk mengambil data
require_once '../Model/ModelBarang.php';


// Membuat instance dari kelas ModelBarang
$model = new ModelBarang();

// Mengambil status koneksi
$connectionStatus = $model->connectDatabase();

// Mengambil data barang
$db_barang = $model->getAllBarang();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kelontong</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-100">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- slider -->
    <div class="container mx-auto px-6 py-4">
    <div class="relative overflow-hidden">
        <!-- Slider Container -->
    
        <div id="slider" class="flex transition-transform duration-500 ease-in-out">
            <!-- Slide 1 -->
            <div class="w-full flex-shrink-0">
                <img src="image/placeholder1.jpeg" 
                alt="Iklan 1" class="w-200 h-100 object-cover rounded-lg">
            </div>
            <!-- Slide 2 -->
            <div class="w-full flex-shrink-0">
                <img src="image/placeholder2.png" 
                alt="Iklan 2" class="w-200 h-100 object-cover rounded-lg">
            </div>
            <!-- Slide 3 -->
            <div class="w-full flex-shrink-0">
                <img src="image/placeholder3.jpg" 
                alt="Iklan 3" class="w-200 h-100 object-cover rounded-lg">
            </div>
        </div>

        <!-- Navigation Buttons -->
        <button id="prev" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-4 py-2 rounded-full hover:bg-gray-800">‹</button>
        <button id="next" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-700 text-white px-4 py-2 rounded-full hover:bg-gray-800">›</button>
    </div>
</div>

<script>
    const slider = document.getElementById('slider');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');

    let currentIndex = 0;

    // Total slide count (adjust based on your slides)
    const totalSlides = slider.children.length;

    function updateSlider() {
        // Calculate the offset based on current index
        const offset = -currentIndex * slider.offsetWidth;
        slider.style.transform = `translateX(${offset}px)`;
    }

    // Event listener for Next button
    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalSlides; // Loop back to the first slide
        updateSlider();
    });

    // Event listener for Previous button
    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; // Loop back to the last slide
        updateSlider();
    });

    // Optional: Auto-slide every 5 seconds
    setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }, 5000);
</script>



    <!-- Filters -->
    <div class="container mx-auto px-6 py-4">
        <h1 class="text-3xl font-bold mb-4">Semua Produk</h1>
        <div class="flex space-x-4 overflow-x-auto">
            <button class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Kategori</button>
            <button class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Harga</button>
            <button class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Diskon</button>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto px-6 py-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Produk -->
            <?php foreach ($db_barang as $item): ?>
    <div class="bg-white rounded shadow-lg hover:shadow-xl hover:scale-105 transition-transform">
        <img src="<?php echo $item['gambar_barang']; ?>" 
            alt="<?php echo htmlspecialchars($item['nama_barang']); ?>" 
            class="w-full h-48 object-cover rounded-t">
        <div class="p-4">
            <h2 class="font-bold text-lg"><?php echo htmlspecialchars($item['nama_barang']); ?></h2>
            <p class="text-gray-600">Rp <?php echo number_format($item['harga_barang'], 0, ',', '.'); ?></p>
        </div>
        </div>
        <?php endforeach; ?>



           
                    
            <!-- Tambahkan lebih banyak produk -->
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Kelontong - Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen flex flex-col">
    <?php include 'includes/navbar.php'; ?>

    <main class="flex-grow container mx-auto px-2 sm:px-4 py-4 sm:py-8">
    <div class="flex flex-col sm:flex-row justify-center items-center mb-4 sm:mb-6">
    <div class="w-full sm:w-2/3 mb-4 sm:mb-0 flex justify-center items-center space-x-4 text-center">
        <!-- Search Box -->
        <input type="text" id="liveSearch" placeholder="Search ..." class="input input-bordered w-full sm:w-full" />
        
        <!-- Mobile: Keranjang and List Pesanan beside search -->
        <div class="flex space-x-2 sm:space-x-4">
            <a href="index.php?modul=cart&fitur=list" class="btn btn-ghost btn-circle">
                <i class="fa fa-fw fa-cart-arrow-down text-xl"></i>
            </a>
            <a href="index.php?modul=transaksi&fitur=list" class="btn btn-ghost btn-circle">
                <i class="fa-solid fa-money-bill text-xl"></i>
            </a>
        </div>
    </div>
</div>


    <div id="searchResults" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4">
        <?php if (!empty($Barangs)) { ?>
            <?php foreach ($Barangs as $item) { ?>
                <?php if ($item['status_barang'] == 1) { ?>
                    <div class="card bg-base-100 shadow-xl">
                        <figure class="px-2 pt-2 sm:px-4 sm:pt-4">
                            <img src="imgBarang/<?php echo htmlspecialchars($item['gambar_barang']); ?>" alt="<?php echo htmlspecialchars($item['nama_barang']); ?>" class="rounded-xl h-32 sm:h-48 w-full object-cover" />
                        </figure>
                        <div class="card-body p-2 sm:p-4 items-center text-center">
                            <h2 class="card-title text-sm sm:text-base"><?php echo htmlspecialchars($item['nama_barang']); ?></h2>
                            <p class="text-xs sm:text-sm">Harga: Rp <?php echo number_format($item['harga_barang'], 0, ',', '.'); ?></p>
                            <p class="text-xs sm:text-sm">Stok: <?php echo htmlspecialchars($item['stok_barang']); ?></p>
                            <div class="card-actions">
                                <form method="POST" action="index.php?modul=cart&fitur=add">
                                    <input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($item['id_barang']); ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm sm:btn-md bg-black text-white"> 
                                        <i class="fa fa-fw fa-cart-arrow-down mr-1 sm:mr-2"></i>Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <p class="col-span-full text-center">Tidak ada data barang tersedia.</p>
        <?php } ?>
    </div>

    <div class="text-center mt-4 sm:mt-8">
        <p class="text-xs sm:text-sm">TIDAK ADA BARANG LAGI</p>
    </div>
</main>


    <?php include 'includes/footer.php'; ?>

    <script>
        document.getElementById('liveSearch').addEventListener('input', function () {
            const query = this.value.trim();
            const resultsContainer = document.getElementById('searchResults');

            if (query.length > 0) {
                fetch(`index.php?modul=cust&fitur=search&q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        resultsContainer.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                const card = `
                                    <div class="card bg-base-100 shadow-xl">
                                        <figure class="px-2 pt-2 sm:px-4 sm:pt-4">
                                            <img src="imgBarang/${item.gambar_barang}" alt="${item.nama_barang}" class="rounded-xl h-32 sm:h-48 w-full object-cover" />
                                        </figure>
                                        <div class="card-body p-2 sm:p-4 items-center text-center">
                                            <h2 class="card-title text-sm sm:text-base">${item.nama_barang}</h2>
                                            <p class="text-xs sm:text-sm">Harga: Rp ${parseInt(item.harga_barang).toLocaleString()}</p>
                                            <p class="text-xs sm:text-sm">Stok: ${item.stok_barang}</p>
                                            <div class="card-actions">
                                                <form method="POST" action="index.php?modul=cart&fitur=add">
                                                    <input type="hidden" name="id_barang" value="${item.id_barang}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-sm sm:btn-md bg-black text-white">
                                                        <i class="fa fa-fw fa-cart-arrow-down mr-1 sm:mr-2"></i>Keranjang
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                resultsContainer.insertAdjacentHTML('beforeend', card);
                            });
                        } else {
                            resultsContainer.innerHTML = '<p class="col-span-full text-center">Tidak ada barang yang sesuai dengan pencarian Anda.</p>';
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            } else {
                fetch('index.php?modul=cust&fitur=getbarang')
                    .then(response => response.json())
                    .then(data => {
                        resultsContainer.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                const card = `
                                    <div class="card bg-base-100 shadow-xl">
                                        <figure class="px-2 pt-2 sm:px-4 sm:pt-4">
                                            <img src="imgBarang/${item.gambar_barang}" alt="${item.nama_barang}" class="rounded-xl h-32 sm:h-48 w-full object-cover" />
                                        </figure>
                                        <div class="card-body p-2 sm:p-4 items-center text-center">
                                            <h2 class="card-title text-sm sm:text-base">${item.nama_barang}</h2>
                                            <p class="text-xs sm:text-sm">Harga: Rp ${parseInt(item.harga_barang).toLocaleString()}</p>
                                            <p class="text-xs sm:text-sm">Stok: ${item.stok_barang}</p>
                                            <div class="card-actions">
                                                <form method="POST" action="index.php?modul=cart&fitur=add">
                                                    <input type="hidden" name="id_barang" value="${item.id_barang}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-sm sm:btn-md bg-black text-white">
                                                        <i class="fa fa-fw fa-cart-arrow-down mr-1 sm:mr-2"></i>Keranjang
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                resultsContainer.insertAdjacentHTML('beforeend', card);
                            });
                        } else {
                            resultsContainer.innerHTML = '<p class="col-span-full text-center">Tidak ada barang yang tersedia.</p>';
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }
        });

        <?php
        if (isset($_SESSION['notification'])) {
            echo "
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{$_SESSION['notification']}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn bg-black text-white'
                }
            });
            ";
            unset($_SESSION['notification']);
        }
        ?>
    </script>
</body>
</html>

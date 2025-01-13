<!-- <?php var_dump($Barangs); ?> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop - Product List Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Start Top Nav -->
    <body>
    <?php include 'includes/navbar.php'; ?>

    <script src="Views/customer/assets/js/bootstrap.bundle.min.js"></script>
</body>
    <!-- Close Header -->

    <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 d-flex justify-content-between align-items-center">
            <!-- Search Bar -->
            <div class="input-group w-100" style="max-width: 90%;">
            <input type="text" id="liveSearch" class="form-control" placeholder="Search ..." aria-label="Search">
        </div>
        
    



            <?php
            if (isset($_SESSION['notification'])) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{$_SESSION['notification']}',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'custom-confirm-button' // Tambahkan class khusus
                        }
                    });
                </script>";
                unset($_SESSION['notification']); // Hapus notifikasi setelah ditampilkan
            }            
            ?>

<style>
    .custom-confirm-button {
        background-color:rgb(0, 0, 0) !important; /* Warna tombol */
        color: white !important; /* Warna teks tombol */
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
    }
    .custom-confirm-button:hover {
        background-color:rgb(56, 59, 57) !important; /* Warna saat tombol di-hover */
    }
</style>


            <!-- Cart Icon -->
            <a href="index.php?modul=cart&fitur=list" class="nav-icon position-relative text-decoration-none" >
                <i class="fa fa-fw fa-cart-arrow-down text-dark ms-3"></i>
                
            </a>
            <a href="index.php?modul=transaksi&fitur=list" class="nav-icon position-relative text-decoration-none" >
            <i class="fa-solid fa-money-bill text-dark ms-3"></i>
                
            </a>
        </div>
    </div>
</div>



    <style>
        .img-container {
    width: 100%;
    height: 260px; /* Sesuaikan dengan tinggi yang diinginkan */
    overflow: hidden;
}

.img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Menjaga aspek rasio gambar dan crop secara otomatis */
}

    </style>



    <!-- Start Content -->
    <div class="container mt-4 ">
    <div class="row"  id="searchResults">
        <?php if (!empty($Barangs)) { ?>
            <?php foreach ($Barangs as $item) { ?>
                <?php if ($item['status_barang'] == 1) { ?>
                    <div class="col-md-3 mb-4 ">
                        <div class="card h-100 shadow-sm ">
                        <div class="img-container ">
                            <img src="imgBarang/<?php echo htmlspecialchars($item['gambar_barang']); ?>" class="w-full h-48 object-cover"  class="card-img-top img-fluid"   alt="<?php echo htmlspecialchars($item['nama_barang']); ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($item['nama_barang']); ?></h5>
                                <p class="card-text">Harga: Rp <?php echo number_format($item['harga_barang'], 0, ',', '.'); ?></p>
                                <p class="card-text">Stok: <?php echo htmlspecialchars($item['stok_barang']); ?></p>
                            </div>
                            <div class="card-footer text-center">
                            <form method="POST" action="index.php?modul=cart&fitur=add">
                                <input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($item['id_barang']); ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fa fa-fw fa-cart-arrow-down text-light me-2"></i>Keranjang
                                </button>
                                
                            </form>
                        </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <p class="text-center">Tidak ada data barang tersedia.</p>
        <?php } ?>
    </div>
</div>

    <br>
    <div class="col-lg-6  m-auto text-center ">
        <p  class="fs-6  ">
            TIDAK ADA BARANG LAGI
        </p>
    </div>
    <br>




    <body>
    <!-- Start Top Nav -->
    
    <?php include 'includes/footer.php'; ?>

    <script src="Views/customer/assets/js/bootstrap.bundle.min.js"></script>
    </body>
    <script>
    document.getElementById('liveSearch').addEventListener('input', function () {
    const query = this.value.trim();
    const resultsContainer = document.getElementById('searchResults');

    if (query.length > 0) {
        fetch(`index.php?modul=cust&fitur=search&q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                resultsContainer.innerHTML = ''; // Kosongkan hasil sebelumnya

                if (data.length > 0) {
                    data.forEach(item => {
                        const card = `
                            <div class="col-md-3 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="img-container">
                                        <img src="imgBarang/${item.gambar_barang}" class="card-img-top img-fluid" alt="${item.nama_barang}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">${item.nama_barang}</h5>
                                        <p class="card-text">Harga: Rp ${parseInt(item.harga_barang).toLocaleString()}</p>
                                        <p class="card-text">Stok: ${item.stok_barang}</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <form method="POST" action="index.php?modul=cart&fitur=add">
                                            <input type="hidden" name="id_barang" value="${item.id_barang}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-dark">
                                                <i class="fa fa-fw fa-cart-arrow-down text-light me-2"></i>Keranjang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        `;
                        resultsContainer.insertAdjacentHTML('beforeend', card);
                    });
                } else {
                    resultsContainer.innerHTML = '<p class="text-center">Tidak ada barang yang sesuai dengan pencarian Anda.</p>';
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    } else {
        // Tampilkan kembali daftar barang awal saat input kosong
        fetch('index.php?modul=cust&fitur=getbarang')
            .then(response => response.json())
            .then(data => {
                console.log('All items:', data);
                resultsContainer.innerHTML = ''; // Kosongkan hasil sebelumnya

                if (data.length > 0) {
                    data.forEach(item => {
                        const card = `
                            <div class="col-md-3 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="img-container">
                                        <img src="imgBarang/${item.gambar_barang}" class="card-img-top img-fluid" alt="${item.nama_barang}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">${item.nama_barang}</h5>
                                        <p class="card-text">Harga: Rp ${parseInt(item.harga_barang).toLocaleString()}</p>
                                        <p class="card-text">Stok: ${item.stok_barang}</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <form method="POST" action="index.php?modul=cart&fitur=add">
                                            <input type="hidden" name="id_barang" value="${item.id_barang}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-dark">
                                                <i class="fa fa-fw fa-cart-arrow-down text-light me-2"></i>Keranjang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        `;
                        resultsContainer.insertAdjacentHTML('beforeend', card);
                    });
                } else {
                    resultsContainer.innerHTML = '<p class="text-center">Tidak ada barang yang tersedia.</p>';
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }
});


    </script>
</body>

</html>
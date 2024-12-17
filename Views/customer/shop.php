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
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-Views/customer/shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    <body>
    <?php include 'includes/navbar.php'; ?>

    <script src="Views/customer/assets/js/bootstrap.bundle.min.js"></script>
</body>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
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
    <div class="row ">
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
                                <a href="#" class="btn btn-dark" >  <i class="fa fa-fw fa-cart-arrow-down text-light me-2"></i>Keranjang</a>
                                
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




    <!-- Start Footer -->
    <footer class="bg-black" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

            <div class="col-md-4 pt-5">
    <h2 class="h2 text-light border-bottom pb-3 border-light logo">E-Kelontong</h2>
    <ul class="list-unstyled text-light footer-link-list">
        <li class="d-flex align-items-start">
            <i class="fas fa-map-marker-alt fa-fw me-2"></i>
            <div>Jl. Sigma no 27, desa skibidi, kecamatan rizz kabupaten singapura barat, jawa timur, Indonesia</div>
        </li>
    </ul>
</div>



                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Contact Us</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                    <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:081234567890">081234567890</a>
                        </li>
                    <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:yasinmart@gmail.com">yasinmart@gmail.com</a>
                        </li>
                    </ul>
                </div>


                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="Views/customer/board.php">Home</a></li>
                        <li><a class="text-decoration-none" href="Views/customer/about.php">About Us</a></li>
                        <li><a class="text-decoration-none" href="https://maps.app.goo.gl/hGEjCLpvxttXM9qd8">Shop Locations</a></li>
                        
                        <li><a class="text-decoration-none" href="Views/customer/contact.php">Contact</a></li>
                    </ul>
                </div>

               

                

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        
                    </ul>
                </div>
                
            </div>
        </div>

        <div class="w-100 bg-black py-3">
           
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>
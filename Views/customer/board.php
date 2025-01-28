<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop eCommerce HTML CSS Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="Views/customer/assets/img/favicon.ico">


    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

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


   

  <!-- Carousel Items -->
  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="Views/customer/assets/img/placeholder1.jpeg" class="d-block w-100" alt="Image 1">
    </div>
    <div class="carousel-item">
      <img src="Views/customer/assets/img/placeholder2.png" class="d-block w-100" alt="Image 2">
    </div>
    <div class="carousel-item">
      <img src="Views/customer/assets/img/placeholder3.jpg" class="d-block w-100" alt="Image 3">
    </div>
  </div>

  <!-- Controls -->
  <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Debugging -->
<script>
  // Inisialisasi Carousel
  var myCarousel = document.querySelector('#carouselExample');
  var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 3000, // Durasi antar slide
    wrap: true,     // Loop kembali ke slide pertama
  });

</script>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center" style="max-width: 50%; word-wrap: break-word;">
        <h1 class="h1 text-black"><b>E-</b> Kelontong</h1>
        <h3 class="h2">Selamat datang di E-Kelontong</h3>
        <p>
        E-Kelontong merupakan solusi belanja kebutuhan sehari-hari yang mudah dan praktis.
        Kami menyediakan berbagai macam produk berkualitas dengan harga terjangkau untuk memenuhi kebutuhan Anda.
        </p>
        <p>

        Nikmati pengalaman berbelanja online yang cepat, aman, dan nyaman hanya di E-Kelontong.
        Temukan promo menarik setiap harinya dan pastikan kebutuhan rumah tangga Anda selalu terpenuhi! 
        </p>
    </div>
</div>








<!-- footer -->
    <body>
    
    <script src="Views/customer/assets/js/bootstrap.bundle.min.js"></script>
    <?php include 'includes/footer.php'; ?>

    
</body>
</body>

</html>
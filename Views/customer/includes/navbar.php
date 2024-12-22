
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop - Product List Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="http://tugas_akhir.test/" />

    <link rel="apple-touch-icon" href="Views/customer/assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="Views/customer/assets/img/favicon.ico">

    <link rel="stylesheet" href="Views/customer/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="Views/customer/assets/css/templatemo.css">
    <link rel="stylesheet" href="Views/customer/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="Views/customer/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-Views/customer/shop

-->
</head>


    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-black navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">yasinmart@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">081234567890</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-dark fs-2 fw-bold d-flex align-items-center" >
        <img src="Views/customer/assets/img/logo.png" alt="Logo" class="me-2" style="width: 40px; height: 40px;">
        E-Kelontong
        </a>



            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Views/customer/board.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Views/customer/about.php">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?modul=cust&fitur=shop">Toko</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Views/customer/contact.php">Lokasi</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex flex-column align-items-end">
                    <span class=" text-dark fs-6 fw-bold d-flex align-items-center">
                        <?= $_SESSION['user']['username'] ?? 'Username'; ?>
                    </span>
                    <span class="text-gray-500 fs-6 text-sm">
                        <?= $_SESSION['user']['role'] ?? 'Role'; ?>
                    </span>
                    </div>
                    <a class="nav-icon position-relative text-decoration-none ms-3">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none ms-3" href="index.php?modul=cust&fitur=logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>

        </div>
    </nav>
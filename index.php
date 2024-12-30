    <?php
    session_start();
    require_once 'Controller/Controller_barang.php';
    require_once 'Controller/Controller_role.php';
    require_once 'Controller/Controller_user.php';
    require_once 'Controller/Controller_login.php';
    require_once 'Controller/Controller_keranjang.php';
    require_once 'Controller/Controller_transaksi.php';
    
    // Routing berdasarkan modul dan fitur

    $modul = $_GET['modul'] ?? 'barang';
    $fitur = $_GET['fitur'] ?? 'list';

    if (!isset($_SESSION['user']) && ($_GET['modul'] ?? '') !== 'login') {
        header('Location: index.php?modul=login&fitur=login');
        exit;
    }

    if ($modul === 'barang') {
        $controller = new BarangController();
        switch ($fitur) {
            case 'list':
                $controller->list_barang();

                break;


            case 'input':
                // Contoh: Form input barang
                $controller->addBarang();
                break;

            case 'delete':
                $controller->delete($_GET['id_barang']);
                break;

            case 'edit':
                $controller->edit($_GET['id_barang']);
                break;

            case 'update':
                $controller->update();
                break;

            default:
                echo "Fitur tidak ditemukan!";
                break;
        }
    }elseif ($modul === 'cust') {
        $controller = new BarangController();
        switch ($fitur) {
            case 'shop':
                $controller->customerShop();
                break;
            default:
                echo "Fitur tidak ditemukan!";
                break;
        }
    }elseif ($modul == 'role'){
        $controller = new RoleController();
        switch ($fitur) {
            case 'list':
                $controller->listRole();
                break;

            case 'input':
                $controller->addRole();
                break;

            case 'delete':
                $controller->delete($_GET['id_role']);
                break;

            case 'edit':
                $controller->edit($_GET['id_role']);
                break;

            case 'update':
                $controller->update();
                break;
                

            default:
                echo "Fitur tidak ditemukan!";
            }
    }elseif($modul === 'user'){
        $controller = new UserController();
        switch ($fitur) {
            case 'list':
                $controller->listUser();
                break;

            case 'input':
                $controller->addUser();
                break;

            case 'delete':
                $controller->delete($_GET['id_user']);
                break;

            case 'edit':
                $controller->edit($_GET['id_user']);
                break;

            case 'update':
                $controller->update();
                break;

            }
        }elseif($modul === 'login'){
                $controller = new LoginController();
                switch ($fitur) {
                    case 'login':
                        $controller->login();
                        break;

                    case 'logout':
                        $controller->logout();
                        exit;
                    
                    case 'register':
                        $controller->register();
                        break;
                }
    }elseif($modul === 'cart'){
        $controller = new ControllerKeranjang();
        // echo '<pre>';
        // print_r($_SERVER);
        // print_r($_POST);
        // print_r($_GET);
        // echo '</pre>';
        // die();
        switch ($fitur) {
            case 'list':
                $controller->listKeranjang();
                break;

            case 'add':
                $controller->addKeranjang();
                break;

            case 'delete':
                $controller->deleteKeranjang($_GET['id_cart']);
                break;  

            case 'update':
                $controller->updateKeranjang();
                break;
        }
    }elseif($modul === 'transaksi'){
        $controller = new TransaksiController();
        $cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        switch ($fitur) {
            case 'list':
                $controller->listTransaksi();
                break;
            case 'add':
                 // Contoh total harga dari POST
            $controller->checkout($_SESSION['user']['id'], $cart_items);
            break;
        }
    }else{
        echo "Modul tidak ditemukan!";
    }

    ?>

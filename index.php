    <?php
    require_once 'Controller/Controller_barang.php';
    require_once 'Controller/Controller_role.php';

    // Routing berdasarkan modul dan fitur

    $modul = $_GET['modul'] ?? 'barang';
    $fitur = $_GET['fitur'] ?? 'list';




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
                $controller->update($_GET['id_role']);
                break;

            default:
                echo "Fitur tidak ditemukan!";
            }

    }
    ?>

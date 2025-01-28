<?php
require_once 'Model/Model_role.php';
require_once 'Model/Model_user.php';


class UserController {
    private $model_user;
    private $model_role;

    public function __construct() {
        $this->model_role = new ModelRole();
        $this->model_user = new ModelUser($this->model_role);
    }
    
    public function listUser() {
        $users = $this->model_user->getAllUser();
        include 'Views/admin/user_list.php';
    }

    public function addUser() {
        // Ambil data role dari model
        $roles = $this->model_role->getAllRole();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_user = $_POST['nama_user'] ?? null;
            $password_user = $_POST['password_user'] ?? null;
            $model_role = $_POST['nama_role'] ?? null;
    
            if ($nama_user && $password_user && $model_role) {
                $this->model_user->createUser($nama_user, $password_user, $model_role);
                header("Location: index.php?modul=user&fitur=list");
                exit;
            } else {
                echo "Semua input harus diisi.";
            }
        } else {
            include 'Views/admin/user_input.php';
        }
    }

    public function delete($id_user) {
        $this->model_user->deleteUser($id_user);
        header("Location: index.php?modul=user&fitur=list");
    }

    public function edit($id_user) {
        $user = $this->model_user->getUserById($id_user);
        $roles = $this->model_role->getAllRole();
        include 'Views/admin/user_update.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'] ?? null;
            $nama_user = $_POST['nama_user'] ?? null;
            $password_user = $_POST['password_user'] ?? null;
            $model_role = $_POST['nama_role'] ?? null;
            $this->model_user->updateUser($nama_user, $password_user, $model_role, $id_user);
            header("Location: index.php?modul=user&fitur=list");
            
        }
    }
    
}

?>
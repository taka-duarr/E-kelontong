<?php
require_once 'Model/Model_user.php';
require_once 'Model/Model_role.php';

class UserController {
    private $model_user;

    public function __construct() {
        $this->model_user = new ModelUser();
    }

    public function listUser() {
        $users = $this->model_user->getAllUser();
        include 'Views/admin/user_list.php';
    }

    // public function addUser() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $name = $_POST['name'] ?? null;
    //         $password = $_POST['password'] ?? null;
    //         $role = $_POST['role'] ?? null;
    //     }
    //     $this->model_user->createUser($name, $password, $role);
    //     header("Location: index.php?modul=user&fitur=list");
    //     exit;
    //     else {
    //         include 'Views/admin/user_input.php';
    //     }
    // }
}

?>
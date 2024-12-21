<?php
require_once 'Model/Model_user.php';

class LoginController
{
    private $modelUser;

    public function __construct()
    {
        $this->modelUser = new ModelUser();
    }

    public function login(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['nama_user'] ?? null;
            $password = $_POST['password_user'] ?? null;
            foreach ($users as $user) {
                if ($user['nama_user'] == $username && $user['password_user'] == $password) {
                    $user = $this->modelUser->getUserByName($nama_user);
                    header("Location: index.php?modul=barang&fitur=list");
                }
            } 
        }
            include 'Views/login.php';
        
    }
}

<?php
require_once 'Model/Model_user.php';

class LoginController
{
    private $modelUser;

    public function __construct()
    {
        $this->modelUser = new ModelUser();
    }

    public function login()
    {
   
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['nama_user'] ?? null;
            $password = $_POST['password_user'] ?? null;
    
            if ($username && $password) {
                $user = $this->modelUser->getUserByName($username);
    
                if ($user && $user['password_user'] === $password) {
                    // Simpan informasi pengguna di session
                    $_SESSION['user'] = [
                        'id' => $user['id_user'],
                        'username' => $user['nama_user'],
                        'role' => $user['nama_role']
                    ];
    
                    // Pengkondisian berdasarkan role
                    if ($user['nama_role'] === 'customer') {
                        header("Location: Views/customer/board.php");
                    } elseif ($user['nama_role'] === 'admin') {
                        header("Location: index.php?modul=barang&fitur=list");
                    } else {
                        $error = "Role tidak dikenali.";
                    }
                    exit;
                } else {
                    $error = "Username atau password salah.";
                }
            } else {
                $error = "Harap isi semua kolom.";
            }
        }
    
        include 'Views/login.php';
    }

    public function logout() {
        header("Location: index.php?modul=login&fitur=login");
        
    }
    
    
    
}

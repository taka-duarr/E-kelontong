<?php
require_once 'Model/Model_user.php';
require_once 'Model/Model_role.php';

class LoginController
{
    private $modelUser;

    public function __construct()
    {
        // Membuat objek ModelRole
        $model_role = new ModelRole();

        // Mengirim objek ModelRole ke konstruktor ModelUser
        $this->modelUser = new ModelUser($model_role);
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
                    } elseif($user['nama_role'] === 'kurir') {
                        header("Location: index.php?modul=kurir&fitur=list");
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

    public function register(){
        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['nama_user'] ?? null;
            $password = $_POST['password_user'] ?? null;
            $role = 'customer'; // Role fixed sebagai 'customer'

            try {
                // Validasi input
                if (!$username || !$password) {
                    throw new Exception("Harap isi semua kolom.");
                }

                // Validasi jika username sudah ada
                $existingUser = $this->modelUser->getUserByName($username);
                if ($existingUser) {
                    throw new Exception("Username sudah digunakan, coba yang lain.");
                }

                // Tambahkan user ke database
                $this->modelUser->createUser($username, $password, $role);
                $success = "Pendaftaran berhasil! Silakan login.";
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        include 'Views/register.php'; // Tampilkan halaman register
    }
}

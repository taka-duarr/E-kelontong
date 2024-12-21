<?php
require_once 'Model/Model_role.php';

class RoleController {
    private $model_role;

    public function __construct(){
        $this->model_role = new ModelRole(); // Pastikan nama kelas konsisten
    }

    public function listRole(){ // Memperbaiki nama metode agar sesuai dengan 'role'
        $roles = $this->model_role->getAllRole(); // Memperbaiki referensi objek

        include 'Views/admin/role_list.php';
    }

    public function addRole() { 
        // Pastikan metode ini tidak menerima argumen
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_role = $_POST['nama_role'] ?? null;
            $status_role = $_POST['status_role'] ?? null;

            // Simpan data
            $this->model_role->createRole($nama_role, $status_role);

            // Redirect ke halaman daftar role
            header("Location: index.php?modul=role&fitur=list");
            exit;
        } else {
            // Jika bukan POST, tampilkan form input
            include 'Views/admin/role_input.php';
        }
    }

    public function delete($id_role) {
        $this->model_role->deleteRole($id_role);
        header("Location: index.php?modul=role&fitur=list");
    }

    public function edit($id_role) {
        $role = $this->model_role->getRoleById($id_role);
        include 'Views/admin/role_update.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_role = $_POST['id_role'] ?? null;
            $nama_role = $_POST['nama_role'] ?? null;
            $status_role = $_POST['status_role'] ?? null;
            $this->model_role->updateRole($id_role, $nama_role, $status_role);
            header("Location: index.php?modul=role&fitur=list");
        }
    }

    
}
?>
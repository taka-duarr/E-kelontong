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
}
?>
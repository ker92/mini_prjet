<?php
class AdminController {
    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php');
            exit;
        }
        require 'views/admin.php';
    }
}
?>


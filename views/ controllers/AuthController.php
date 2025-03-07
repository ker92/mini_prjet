<?php
class AuthController {
public function login() {
require 'views/login.php';
}
    public function register() {
        require 'views/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>
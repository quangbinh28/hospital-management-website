<?php
require_once 'models/UserModel.php';

class AuthController {
    public function loginPage() {
        $VIEW = "./views/User/DangNhap.php";
        include './template/Template.php';
    }

    public function handleLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();


        $user = $userModel->handleLogin($username, $password);
    }
    
    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    public static function authentication() {
        if (empty($_SESSION['IsLogined']) || $_SESSION['IsLogined'] !== true) {
            header("Location: index.php?action=error");
            exit;
        }
    }
}

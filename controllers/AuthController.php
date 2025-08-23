<?php
require_once 'models/UserModel.php';

class AuthController {
    public function loginPage() {
        $VIEW = "./views/User/DangNhap.php";
        include './template/Template.php';
    }

    public function registerPage() {
        $VIEW = "./views/User/DangKy.php";
        include './template/Template.php';
    }

    public function handleLogin() {
        $username = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new UserModel();
        $user = $userModel->handleLogin($username, $password);
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                "email"     => $_POST['EmailBN'] ?? '',
                "password"  => $_POST['Password'] ?? '',
                "maxacnhan" => $_POST['MaXacNhan'] ?? '',
                "hoten"     => $_POST['HoTenBN'] ?? '',
                "ngaysinh"  => $_POST['NgaySinhBN'] ?? '',
                "mabhyt"    => $_POST['MaBHYT'] ?? '',
                "sodt"      => $_POST['SoDTBN'] ?? '',
                "diachi"    => $_POST['DiaChiBN'] ?? '',
                "gioitinh"  => $_POST['GioiTinhBN'] ?? ''
            ];

            $userModel = new UserModel();
            $result = $userModel->handleRegister($data);

            if ($result['success']) {
                // ✅ Đăng ký thành công -> chuyển sang trang login
                header("Location: index.php?controller=auth&action=loginpage");
                exit();
            } else {
                // ❌ Có lỗi -> trả về view đăng ký và hiển thị lỗi
                $errorMessage = $result['error'] ?? "Đăng ký thất bại. Vui lòng thử lại.";
                $VIEW = "./views/User/DangKy.php";
                include './template/Template.php';
            }
        } else {
            // Nếu không phải POST -> mở lại form đăng ký
            $VIEW = "./views/User/DangKy.php";
            include './template/Template.php';
        }
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

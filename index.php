<?php
session_start();

// Lấy controller và action từ URL, mặc định vào tìm kiếm bệnh nhân
$controller = strtolower($_GET['controller'] ?? 'trangchu');
$action     = strtolower($_GET['action'] ?? 'trangchupage');

switch ($controller) {
    case 'trangchu':
        require_once 'controllers/TrangChuController.php';
        $ctrl = new TrangChuController();

        if ($action === 'trangchupage') {
            $ctrl->trangChuPage();
        } else {
            echo "❌ Không tìm thấy action [$action] trong TrangChuController";
        }
        break;

    case 'benhnhan':
        require_once 'controllers/BenhNhanController.php';
        $ctrl = new BenhNhanController();

        if ($action === 'timkiem') {
            $ctrl->timKiem();
        } elseif ($action === 'timkiempage') {
            $ctrl->timKiemPage();
        } elseif ($action === 'chitiet' && isset($_GET['id'])) {
            $ctrl->chiTiet($_GET['id']);
        } elseif ($action === 'thempage') {
            $ctrl->themPage();
        } elseif ($action === 'them') {
            $ctrl->them();
        } else {
            echo "❌ Không tìm thấy action [$action] trong BenhNhanController";
        }
        break;

    case 'hoso':
        require_once 'controllers/HoSoBenhAnController.php';
        $ctrl = new HoSoBenhAnController();

        if ($action === 'them' && isset($_GET['maBN'])) {
            $ctrl->them($_GET['maBN']);
        } elseif ($action === 'luu') {
            $ctrl->luu();
        } elseif ($action === 'capnhatpage' && isset($_GET['maHS'])) {
            $ctrl->capNhatPage($_GET['maHS']);
        } elseif ($action === 'luuCapNhat') {
            $ctrl->luuCapNhat();
        } elseif ($action === 'chitiet' && isset($_GET['maHS'])) {
            $ctrl->chiTiet($_GET['maHS']);
        } else {
            echo "❌ Không tìm thấy action [$action] trong HoSoBenhAnController";
        }
        break;

    case 'donthuoc':
        require_once 'controllers/DonThuocController.php';
        $ctrl = new DonThuocController();

        if ($action === 'taopage') {
            $ctrl->taoPage();
        } elseif ($action === 'luu') {
            $ctrl->luu();
        } elseif ($action === 'tracuupage') {
            $ctrl->traCuuPage();
        } elseif ($action === 'tracuu') {
            $ctrl->timKiem();
        } elseif ($action === 'chitiet' && isset($_GET['maDT'])) {
            $ctrl->chiTiet($_GET['maDT']);
        } elseif ($action === 'sansang' && isset($_GET['maDT'])) {
            $ctrl->sanSang($_GET['maDT']);
        } elseif ($action === 'dalay' && isset($_GET['maDT'])) {
            $ctrl->daLay($_GET['maDT']);
        } else {
            echo "❌ Không tìm thấy action [$action] trong DonThuocController";
        }
        break;

    case 'lichkham':
        require_once 'controllers/LichKhamController.php';
        $ctrl = new LichKhamController();

        if ($action === 'datlichpage') {
            $ctrl->datLichPage();
        } elseif ($action === 'laybacsitheokhoa') {
            $ctrl->layBacSiTheoKhoa();
        } elseif ($action === 'laycakhamtheobacsi') {
            $ctrl->layCaKhamTheoBacSi();
        } elseif ($action === 'datlichkham') {
            $ctrl->datLichKham();
        } elseif ($action === 'xacnhanpage') {
            $ctrl->xacNhanLichPage();
        } elseif ($action === 'tracuu') {
            $ctrl->traCuuLichKham();
        }elseif ($action === 'tracuupage') {
            $ctrl->traCuuPage();
        } elseif ($action === 'xacnhanlich' && isset($_GET['maLich'])) {
            $ctrl->xacNhanLich($_GET['maLich']);
        } elseif ($action === 'huylich' && isset($_GET['maLich'])) {
            $ctrl->huyLich($_GET['maLich']);
        } else {
            echo "❌ Không tìm thấy action [$action] trong LichKhamController";
        }
        break;
    case 'bacsi':
        require_once 'controllers/BacSiController.php';
        $ctrl = new BacSiController();
        if ($action === 'thempage') {
            $ctrl->themPage();
        } elseif ($action === 'luu') {
            $ctrl->luu();
        } else {
            echo "❌ Không tìm thấy action [$action] trong BacSiController";
        }
        break;
    case 'auth':
        require_once 'controllers/AuthController.php';
        $ctrl = new AuthController();
        if ($action === 'loginpage') {
            $ctrl->loginPage();
        } elseif ($action === 'login') {
            $ctrl->handleLogin();
        } elseif ($action === 'logout') {
            $ctrl->logout();
        } elseif ($action === 'registerpage') {
            $ctrl->registerPage();
        }
        break;
    case 'thuoc':
        require_once 'controllers/ThuocController.php';
        $ctrl = new ThuocController();

        if ($action === 'goiythuoc') {
            $ctrl->goiYThuoc();
        } else {
            echo "❌ Không tìm thấy action [$action] trong ThuocController";
        }
        break;
    default:
        echo "❌ Không tìm thấy controller [$controller]";
        break;
}

<?php
session_start();

$controller = $_GET['controller'] ?? 'benhnhan';
$action     = $_GET['action'] ?? 'timkiempage';

switch ($controller) {
    // case 'trangchu':
    //     require_once 'controllers/TrangChuController.php';
    //     $ctrl = new TrangChuController();
    //     $ctrl->index();
    //     break;

    // case 'xacthuc':
    //     require_once 'controllers/XacThucController.php';
    //     $ctrl = new XacThucController();
    //     if ($action === 'dangnhap') {
    //         $ctrl->dangNhap();
    //     } elseif ($action === 'xulydangnhap') {
    //         $ctrl->xuLyDangNhap();
    //     } elseif ($action === 'dangxuat') {
    //         $ctrl->dangXuat();
    //     } else {
    //         echo "Không tìm thấy hành động trong XacThucController";
    //     }
    //     break;

    case 'benhnhan':
        require_once 'controllers/BenhNhanController.php';
        $ctrl = new BenhNhanController();
        if ($action === 'timkiem') {
            $ctrl->timKiem();
        } elseif ($action === 'timkiempage') {
            $ctrl->timKiemPage();
        } elseif ($action === 'chitiet' && isset($_GET['id'])) {
            $ctrl->chiTiet($_GET['id']);
        } else {
            echo "Không tìm thấy hành động trong BenhNhanController";
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
            echo "Không tìm thấy action phù hợp trong HoSoBenhAnController";
        }
        break;

    default:
        echo "Không tìm thấy controller: $controller";
        break;
}

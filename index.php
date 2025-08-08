<?php
session_start();

// Lấy controller và action từ URL, mặc định vào tìm kiếm bệnh nhân
$controller = strtolower($_GET['controller'] ?? 'benhnhan');
$action     = strtolower($_GET['action'] ?? 'timkiempage');

switch ($controller) {
    case 'trangchu':
        require_once 'controllers/TrangChuController.php';
        $ctrl = new TrangChuController();

        if ($action === 'index') {
            $ctrl->index();
        } else {
            echo "❌ Không tìm thấy action [$action] trong TrangChuController";
        }
        break;

    case 'xacthuc':
        require_once 'controllers/XacThucController.php';
        $ctrl = new XacThucController();

        if ($action === 'dangnhap') {
            $ctrl->dangNhap();
        } elseif ($action === 'xulydangnhap') {
            $ctrl->xuLyDangNhap();
        } elseif ($action === 'dangxuat') {
            $ctrl->dangXuat();
        } else {
            echo "❌ Không tìm thấy action [$action] trong XacThucController";
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
        } else {
            echo "❌ Không tìm thấy action [$action] trong DonThuocController";
        }
        break;

    default:
        echo "❌ Không tìm thấy controller [$controller]";
        break;
}

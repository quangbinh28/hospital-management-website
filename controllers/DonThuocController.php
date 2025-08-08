<?php
require_once 'models/DonThuocModel.php';

class DonThuocController {
    private $model;

    public function __construct() {
        $this->model = new DonThuocModel();
    }

    public function taoPage() {
        $VIEW = './views/Thuoc/DonThuoc_Tao.php';
        include './template/Template.php';
    }

    public function traCuuPage() {
        $VIEW = './views/Thuoc/DonThuoc_TraCuu.php';
        include './template/Template.php';
    }

    public function timKiem() {
        $maDT   = $_POST['maDT'] ?? '';
        $tenBN  = $_POST['tenBN'] ?? '';
        $ngayLap = $_POST['ngayLap'] ?? '';
        $page   = $_POST['page'] ?? 1;

        $result = $this->model->timKiemDonThuoc($maDT, $tenBN, $ngayLap, $page);
        $donThuocList = $result['data'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include './views/Thuoc/DonThuoc_KetQuaTraCuu.php';
        } else {
            $VIEW = './views/Thuoc/DonThuoc_TraCuu.php';
            include './template/Template.php';
        }
    }

    public function chiTiet() {
        $maDT = $_GET['maDT'] ?? '';
        if (!$maDT) {
            echo "<div class='alert alert-danger'>Mã đơn thuốc không hợp lệ.</div>";
            return;
        }

        $donThuoc = $this->model->layChiTietDonThuoc($maDT);
        $VIEW = './views/Thuoc/DonThuoc_ChiTiet.php';
        include './template/Template.php';
    }

    public function luu() {
        $maBN = $_POST['maBN'] ?? '';
        $chanDoan = $_POST['chanDoan'] ?? '';
        $ghiChu = $_POST['ghiChu'] ?? '';
        $thuocList = $_POST['thuoc'] ?? [];

        if (empty($maBN) || empty($thuocList)) {
            echo "<div class='alert alert-danger'>Thiếu thông tin bệnh nhân hoặc thuốc.</div>";
            return;
        }

        $maDT = $this->model->taoDonThuoc($maBN, $chanDoan, $ghiChu, $thuocList);
        echo "<div class='alert alert-success'>Đơn thuốc #$maDT đã được tạo thành công.</div>";
    }
}

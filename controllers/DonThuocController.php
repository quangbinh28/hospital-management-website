<?php
require_once 'models/DonThuocModel.php';

class DonThuocController {
    private $model;

    public function __construct() {
        $this->model = new DonThuocModel();
    }

    public function taoPage() {
        $VIEW = './views/Thuoc/Thuoc_TaoDonThuoc.php';
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

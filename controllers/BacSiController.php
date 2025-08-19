<?php
require_once 'models/BacSiModel.php';

class BacSiController {
    private $model;

    public function __construct() {
        $this->model = new BacSiModel();
    }

    // Hiển thị form thêm bác sĩ
    public function themPage() {
        $VIEW = 'views/BacSi/ThemBacSi.php';
        include './template/Template.php';
    }

    // Nhận dữ liệu từ form và lưu vào DB
    public function luu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maChungChi = $_POST['maChungChi'];
            $hoTen = $_POST['hoTen'];
            $ngaySinh = $_POST['ngaySinh'];
            $gioiTinh = $_POST['gioiTinh'];
            $diaChi = $_POST['diaChi'];
            $kinhNghiem = $_POST['kinhNghiem'] ?? [];

            // Lưu vào DB
            $maNV = $this->model->themBacSi($maChungChi, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $kinhNghiem);

            if ($maNV) {
                echo "✅ Thêm bác sĩ thành công! Mã NV: $maNV";
            } else {
                echo "❌ Lỗi khi thêm bác sĩ!";
            }
        }
    }
}

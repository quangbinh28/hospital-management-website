<?php
require_once 'models/LichKhamModel.php';

class LichKhamController {
    private $model;

    public function __construct() {
        $this->model = new LichKhamModel();
    }

    public function datLichPage() {
        $dsChuyenKhoa = $this->model->layDanhSachChuyenKhoa();
        $VIEW = './views/LichKham/DatLichKham.php';
        include './template/Template.php';
    }

    public function layBacSiTheoKhoa() {
        $maKhoa = $_POST['maKhoa'] ?? '';
        $bacSiList = $this->model->layDanhSachBacSiTheoKhoa($maKhoa);
        header('Content-Type: application/json');
        echo json_encode($bacSiList);
    }

    public function layCaKhamTheoBacSi() {
        $maBS = $_POST['maBS'] ?? '';
        $caList = $this->model->layDanhSachCaKhamTheoBacSi($maBS);
        header('Content-Type: application/json');
        echo json_encode($caList);
    }

    public function datLichKham() {
        $maBS        = $_POST['maBS'] ?? '';
        $ngay        = $_POST['ngay'] ?? '';
        $gio         = $_POST['gio'] ?? '';
        $nguyenNhan  = $_POST['nguyen_nhan'] ?? '';
        $nguoiDK     = $_SESSION['user_id'] ?? '';

        $ketQua = $this->model->datLichKham($maBS, $ngay, $gio, $nguyenNhan, $nguoiDK);

        $thongBao = $ketQua ? "✅ Đặt lịch khám thành công!" : "❌ Đặt lịch thất bại. Vui lòng thử lại!";
        $dsChuyenKhoa = $this->model->layDanhSachChuyenKhoa();
        $VIEW = './views/LichKham/DatLichKham.php';
        include './template/Template.php';
    }

    public function xacNhanLichPage() {
        $ngay = $_GET['ngay'] ?? '';
        $dsLichKham = $this->model->layLichKhamChuaXacNhan($ngay);
        $VIEW = './views/LichKham/XacNhan.php';
        include './template/Template.php';
    }

    public function locLichKhamTheoNgay() {
        $ngay = $_GET['ngay'] ?? '';
        $dsLichKham = $this->model->layLichKhamChuaXacNhan($ngay);
        $VIEW = './views/LichKham/XacNhan.php';
        include './template/Template.php';
    }

    public function xacNhanLich($maLich) {
        if ($maLich) {
            $this->model->capNhatTrangThaiLichKham($maLich, 'xac_nhan');
            alert('Lịch Khám đã được xác nhận');
        }
        
        exit();
    }

    public function huyLich($maLich) {
        if ($maLich) {
            $this->model->capNhatTrangThaiLichKham($maLich, 'huy');
            alert('Hủy thành công');
        }
        
        exit();
    }
}

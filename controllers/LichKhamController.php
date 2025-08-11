<?php
require_once 'models/LichKhamModel.php';

class LichKhamController {
    private $model;

    public function __construct() {
        $this->model = new LichKhamModel();
    }

    /**
     * Trang đặt lịch khám (hiển thị form ban đầu)
     */
    public function datLichPage() {
        // Lấy danh sách chuyên khoa
        $chuyenKhoaList = $this->model->layDanhSachChuyenKhoa();
        $VIEW = './views/LichKham/DatLichKham.php';
        include './template/Template.php';
    }

    /**
     * Lấy danh sách bác sĩ theo khoa (AJAX)
     */
    public function layBacSiTheoKhoa() {
        $maKhoa = $_POST['maKhoa'] ?? '';
        $bacSiList = $this->model->layDanhSachBacSiTheoKhoa($maKhoa);
        include 'views/LichKham/ComboBox_BacSi.php';
    }

    /**
     * Lấy danh sách ca khám của bác sĩ (AJAX)
     */
    public function layCaKhamTheoBacSi() {
        $maBS = $_POST['maBS'] ?? '';
        $caList = $this->model->layDanhSachCaKhamTheoBacSi($maBS);
        include 'views/LichKham/DanhSachCa.php';
    }

    /**
     * Xử lý đặt lịch khám
     */
    public function datLichKham() {
        $maBS    = $_POST['maBS'] ?? '';
        $ngay    = $_POST['ngay'] ?? '';
        $gio     = $_POST['gio'] ?? '';
        $nguoiDK = $_SESSION['user_id'] ?? '';

        $ketQua = $this->model->datLichKham($maBS, $ngay, $gio, $nguoiDK);

        if ($ketQua) {
            $thongBao = "Đặt lịch khám thành công!";
        } else {
            $thongBao = "Đặt lịch thất bại. Vui lòng thử lại!";
        }

        $chuyenKhoaList = $this->model->layDanhSachChuyenKhoa();
        $VIEW = './views/LichKham/DatLichKham.php';
        include './template/Template.php';
    }
}

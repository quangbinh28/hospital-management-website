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
        $dsChuyenKhoa = $this->model->layDanhSachChuyenKhoa();

        // Truyền dữ liệu ra view
        $VIEW = './views/LichKham/DatLichKham.php';
        include './template/Template.php';
    }

    /**
     * Lấy danh sách bác sĩ theo mã khoa (AJAX)
     */
    public function layBacSiTheoKhoa() {
        $maKhoa = $_POST['maKhoa'] ?? '';
        $bacSiList = $this->model->layDanhSachBacSiTheoKhoa($maKhoa);

        // Có thể trả JSON nếu gọi bằng fetch()
        header('Content-Type: application/json');
        echo json_encode($bacSiList);
    }

    /**
     * Lấy danh sách ca khám của bác sĩ (AJAX)
     */
    public function layCaKhamTheoBacSi() {
        $maBS = $_POST['maBS'] ?? '';
        $caList = $this->model->layDanhSachCaKhamTheoBacSi($maBS);

        header('Content-Type: application/json');
        echo json_encode($caList);
    }

    /**
     * Xử lý đặt lịch khám
     */
    public function datLichKham() {
        $maBS        = $_POST['maBS'] ?? '';
        $ngay        = $_POST['ngay'] ?? '';
        $gio         = $_POST['gio'] ?? '';
        $nguyenNhan  = $_POST['nguyen_nhan'] ?? '';
        $nguoiDK     = $_SESSION['user_id'] ?? '';

        // Gọi model để lưu vào DB
        $ketQua = $this->model->datLichKham($maBS, $ngay, $gio, $nguyenNhan, $nguoiDK);

        if ($ketQua) {
            $thongBao = "✅ Đặt lịch khám thành công!";
        } else {
            $thongBao = "❌ Đặt lịch thất bại. Vui lòng thử lại!";
        }

        // Load lại trang đặt lịch với thông báo
        $dsChuyenKhoa = $this->model->layDanhSachChuyenKhoa();
        $VIEW = './views/LichKham/DatLichKham.php';
        include './template/Template.php';
    }
}

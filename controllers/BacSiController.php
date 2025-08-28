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

    public function chiTiet() {
        $maBS = $_GET['maBS'] ?? '';

        if (!$maBS) {
            http_response_code(400);
            echo json_encode(['error' => 'Thiếu mã bác sĩ']);
            return;
        }

        $bacSi = $this->model->chiTiet($maBS);

        if ($bacSi) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($bacSi);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Không tìm thấy bác sĩ']);
        }
    }

    public function uploadAvatarPage(){
        $VIEW = 'views/BacSi/CapNhatAnhDaiDien.php';
        include './template/Template.php';
    }

    public function uploadAvatar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
            $file = $_FILES['avatar'];

            if ($file['error'] === UPLOAD_ERR_OK) {
                // Truyền file sang model xử lý upload
                $result = $this->model->uploadAvatar($file);

                if (isset($result['error'])) {
                    echo "❌ Upload thất bại: " . $result['error'];
                } else {
                    echo "✅ Upload avatar thành công!";
                }
            } else {
                echo "❌ Lỗi upload file: " . $file['error'];
            }
        } else {
            echo "❌ Không có file avatar nào được gửi!";
        }
    }
}

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
        $maDT    = $_POST['maDT'] ?? '';
        $maBN   = $_POST['maBN'] ?? '';
        $tuNgay  = $_POST['tuNgay'] ?? '';
        $denNgay = $_POST['denNgay'] ?? '';
        $page    = ($_POST['page'] ?? 1) - 1; // API thường bắt đầu từ 0
        $size    = 10; // Số bản ghi mỗi trang

        // Gọi model lấy dữ liệu từ API
        $result = $this->model->timKiemDonThuoc($maDT, $maBN, $tuNgay, $denNgay, $page, $size);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $donThuocList = $result['content'] ?? [];
            $totalPages   = $result['totalPages'] ?? 1;
            $currentPage  = ($result['number'] ?? 0) + 1; // cộng lại để hiển thị 1-based
            $totalRecords = $result['totalElements'] ?? 0;

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
        $ghiChu = $_POST['ghiChu'] ?? '';
        $thuocList = $_POST['thuoc'] ?? [];

        if (empty($maBN) || empty($thuocList)) {
            echo "<script>alert('Thiếu thông tin bệnh nhân hoặc thuốc.');</script>";
            return;
        }

        $result = $this->model->taoDonThuoc($maBN, $ghiChu, $thuocList);

        if ($result['status'] == 200 || $result['status'] == 201) {
            echo "<script>
                alert('Đơn thuốc đã được tạo thành công.');
                window.location.href = 'http://localhost/ProjectUDPT/Website/index.php?controller=donthuoc&action=taopage';
            </script>";
        } else {
            $errorMsg = $result['response']['message'] ?? 'Không thể tạo đơn thuốc.';
            $errorMsg = addslashes($errorMsg); // tránh lỗi khi có dấu '
            echo "<script>
                alert('Lỗi: {$errorMsg}');
                window.location.href = 'http://localhost/ProjectUDPT/Website/index.php?controller=donthuoc&action=taopage';
            </script>";
        }

    }

}

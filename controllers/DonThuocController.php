<?php
require_once 'models/DonThuocModel.php';
require_once 'models/BenhNhanModel.php';

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
        $maBS    = $_POST['maBS'] ?? '';
        $maBN   = $_POST['maBN'] ?? '';
        $tuNgay  = $_POST['tuNgay'] ?? '';
        $denNgay = $_POST['denNgay'] ?? '';
        $trangThai = $_POST['trangThai'] ?? '';
        $page    = ($_POST['page'] ?? 1) - 1; // API thường bắt đầu từ 0
        $size    = 10; // Số bản ghi mỗi trang

        // Gọi model lấy dữ liệu từ API
        $result = $this->model->timKiemDonThuoc($maBN, $tuNgay, $denNgay, $page, $size, $trangThai, $maBS);

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

        $result = $this->model->layChiTietDonThuoc($maDT);

        if ($result['status'] == 200) {
            // Lấy dữ liệu đơn thuốc
            $donThuoc = $result['data'];
            $VIEW = './views/Thuoc/DonThuoc_ChiTiet.php';
            include './template/Template.php';
        } else {
            $err = $result['error'] ?? 'Không lấy được chi tiết đơn thuốc.';
            echo "<div class='alert alert-danger'>Lỗi: {$err}</div>";
        }
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

    /**
     * Đặt trạng thái đơn thuốc thành "Sẵn sàng"
     */
    public function sanSang($maDT) {
        if (!$maDT) {
            echo "<div class='alert alert-danger'>Mã đơn thuốc không hợp lệ.</div>";
            return;
        }

        $result = $this->model->sanSang($maDT);

        if ($result['status'] == 200) {
            echo "<script>
                alert('Đơn thuốc #{$maDT} đã được đặt trạng thái Sẵn sàng.');
                window.location.href = 'index.php?controller=donthuoc&action=tracuu';
            </script>";
        } else {
            $errorMsg = $result['error'] ?? 'Không thể cập nhật trạng thái.';
            $errorMsg = addslashes($errorMsg);
            echo "<script>
                alert('Lỗi: {$errorMsg}');
                window.location.href = 'index.php?controller=donthuoc&action=tracuu';
            </script>";
        }
    }

    /**
     * Đặt trạng thái đơn thuốc thành "Đã lấy"
     */
    public function daLay($maDT) {
        if (!$maDT) {
            echo "<div class='alert alert-danger'>Mã đơn thuốc không hợp lệ.</div>";
            return;
        }

        $result = $this->model->daLay($maDT);

        if ($result['status'] == 200) {
            echo "<script>
                alert('Đơn thuốc #{$maDT} đã được đặt trạng thái Đã lấy.');
                window.location.href = 'index.php?controller=donthuoc&action=tracuu';
            </script>";
        } else {
            $errorMsg = $result['error'] ?? 'Không thể cập nhật trạng thái.';
            $errorMsg = addslashes($errorMsg);
            echo "<script>
                alert('Lỗi: {$errorMsg}');
                window.location.href = 'index.php?controller=donthuoc&action=tracuu';
            </script>";
        }
    }
}

<?php
require_once 'models/LichKhamModel.php';

class LichKhamController {
    private $model;

    public function __construct() {
        $this->model = new LichKhamModel();
    }

    public function datLichPage() {
        // Gọi model lấy danh sách chuyên khoa từ API
        $result = $this->model->layDanhSachChuyenKhoa();

        // Nếu có lỗi, hiển thị mảng rỗng để dropdown không bị lỗi
        if (isset($result['error'])) {
            $dsChuyenKhoa = [];
            $errorMsg = $result['error'];
            echo "<div class='alert alert-warning'>Lỗi khi tải danh sách chuyên khoa: {$errorMsg}</div>";
        } else {
            $dsChuyenKhoa = $result; // dữ liệu trả về từ API
        }

        // Xác định mã bệnh nhân
        if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'BENHNHAN') {
            $maBN = $_SESSION['user']['id'];
        } else {
            // Nếu là bác sĩ hoặc admin, bạn có thể truyền từ request hoặc để rỗng
            $maBN = $_GET['maBN'] ?? '';
        }

        $VIEW = './views/LichKham/DatLichKham.php';
        include './template/Template.php';
    }


    public function layBacSiTheoKhoa() {
        $maKhoa = $_GET['maKhoa'] ?? '';

        if (!$maKhoa) {
            echo json_encode(['error' => 'Mã khoa không hợp lệ']);
            return;
        }

        $bacSiList = $this->model->layDanhSachBacSiTheoKhoa($maKhoa);

        // Nếu API trả về lỗi, giữ nguyên lỗi
        if (isset($bacSiList['error'])) {
            header('Content-Type: application/json');
            echo json_encode(['error' => $bacSiList['error']]);
            return;
        }

        // Trả về dữ liệu bác sĩ
        header('Content-Type: application/json');
        echo json_encode($bacSiList);
    }


    public function layCaKhamTheoBacSi() {
        // Lấy mã bác sĩ từ POST hoặc GET
        $maBS = $_GET['maBS'] ?? '';

        if (!$maBS) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Mã bác sĩ không hợp lệ']);
            return;
        }

        // Gọi model lấy danh sách ca khám
        $caList = $this->model->layDanhSachCaKhamTheoBacSi($maBS);

        header('Content-Type: application/json');

        // Nếu có lỗi từ model
        if (isset($caList['error'])) {
            echo json_encode(['error' => $caList['error']]);
            return;
        }

        // Trả về dữ liệu ca khám
        echo json_encode($caList);
    }

    public function datLichKham() {
        // Lấy dữ liệu từ form (camelCase)
        $maBS       = $_POST['bacSi'] ?? '';
        $ngay       = $_POST['ngayKham'] ?? '';
        $gio        = $_POST['gioKham'] ?? '';
        $nguyenNhan = $_POST['nguyenNhan'] ?? '';
        $maBN       = $_POST['maBenhNhan'] ?? ''; 

        // Gọi model để đặt lịch
        $result = $this->model->datLichKham($maBS, $ngay, $gio, $nguyenNhan, $maBN);

        // Xử lý kết quả và alert
        if (!empty($result['error'])) {
            $thongBao = "❌ Lỗi khi đặt lịch: " . htmlspecialchars($result['error']);
        } 
        echo "<script>alert('{$thongBao}');</script>";

        // Load lại danh sách chuyên khoa để hiển thị form
        $dsChuyenKhoa = $this->model->layDanhSachChuyenKhoa();

        // Xác định mã bệnh nhân hiển thị trên form
        if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'BENHNHAN') {
            $maBN = $_SESSION['user']['id']; // readonly
        } else {
            $maBN = $_POST['maBenhNhan'] ?? ''; // admin/tiếp tân có thể nhập
        }

        $VIEW = './views/LichKham/DatLichKham.php';
        include './template/Template.php';
    }


    public function traCuuPage() {
        $ngay = $_GET['ngay'] ?? '';
        $VIEW = './views/LichKham/LichKham_TraCuu.php';
        include './template/Template.php';
    }

    public function traCuuLichKham() {
        // Lấy các tiêu chí từ form
        $maBS    = $_POST['maBS'] ?? '';
        $maBN    = $_POST['maBN'] ?? '';
        $ngayTu  = $_POST['ngayTu'] ?? '';
        $ngayDen = $_POST['ngayDen'] ?? '';
        $tinhTrang = $_POST['tinhTrang'] ?? '';
        $page    = ($_POST['page'] ?? 1) - 1; // API thường bắt đầu từ 0
        $size    = 10; // số bản ghi mỗi trang

        // Gọi model lấy dữ liệu từ API
        $result = $this->model->timKiemLichKham($maBS, $maBN, $ngayTu, $ngayDen, $tinhTrang, $page, $size);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Dữ liệu hiển thị trong bảng kết quả
            $dsLichKham   = $result['content'] ?? [];
            $totalPages   = $result['totalPages'] ?? 1;
            $currentPage  = ($result['number'] ?? 0) + 1; // API trả 0-based, hiển thị 1-based
            $totalRecords = $result['totalElements'] ?? 0;

            include './views/LichKham/LichKham_KetQua.php';
        } else {
            // Khi load lần đầu, hiển thị form
            $VIEW = './views/LichKham/LichKham_TraCuu.php';
            include './template/Template.php';
        }
    }


    public function locLichKhamTheoNgay() {
        $ngay = $_GET['ngay'] ?? '';
        $dsLichKham = $this->model->layLichKhamChuaXacNhan($ngay);
        $VIEW = './views/LichKham/LichKham_TraCuu.php';
        include './template/Template.php';
    }

    public function xacNhanLich($maLich) {
        if (!$maLich) {
            echo "<div class='alert alert-danger'>Mã lịch khám không hợp lệ.</div>";
            return;
        }

        $result = $this->model->xacNhanLich($maLich);

        if ($result['status'] == 200) {
            echo "<script>
                alert('Lịch khám #{$maLich} đã được xác nhận thành công.');
                window.location.href = 'index.php?controller=lichkham&action=tracuu';
            </script>";
        } else {
            $errorMsg = $result['error'] ?? 'Không thể xác nhận lịch khám.';
            $errorMsg = addslashes($errorMsg);
            echo "<script>
                alert('Lỗi: {$errorMsg}');
                window.location.href = 'index.php?controller=lichkham&action=tracuu';
            </script>";
        }
    }

    public function huyLich($maLich) {
        if (!$maLich) {
            echo "<div class='alert alert-danger'>Mã lịch khám không hợp lệ.</div>";
            return;
        }

        $result = $this->model->huyLich($maLich);

        if ($result['status'] == 200) {
            echo "<script>
                alert('Lịch khám #{$maLich} đã được hủy thành công.');
                window.location.href = 'index.php?controller=lichkham&action=tracuu';
            </script>";
        } else {
            $errorMsg = $result['error'] ?? 'Không thể hủy lịch khám.';
            $errorMsg = addslashes($errorMsg);
            echo "<script>
                alert('Lỗi: {$errorMsg}');
                window.location.href = 'index.php?controller=lichkham&action=tracuu';
            </script>";
        }
    }


    /**
     * Xem lịch khám đã xác nhận của người dùng đang đăng nhập
     */
    public function xemLichKham() {
        // $maTaiKhoan = $_SESSION['MaTaiKhoan'] ?? null;
        $maTaiKhoan = 'BN123';
        if (!$maTaiKhoan) {
            echo "Vui lòng đăng nhập để xem lịch khám.";
            return;
        }
        

        require_once 'models/LichKhamModel.php';
        $model = new LichKhamModel();

        // Nếu có bộ lọc thời gian
        $tuNgay = $_POST['tu_ngay'] ?? null;
        $denNgay = $_POST['den_ngay'] ?? null;

        $lichKham = $model->layDanhSachLichKham();

        $VIEW = './views/LichKham/XemLichKham.php';
        include './template/Template.php';
    }
}

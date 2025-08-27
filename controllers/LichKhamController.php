<?php
require_once 'models/LichKhamModel.php';
require_once __DIR__ . '/../libs/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

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
        $phong       = $_POST['phong'] ?? ''; 

        // Gọi model để đặt lịch
        $result = $this->model->datLichKham($maBS, $ngay, $gio, $nguyenNhan, $maBN, $phong);

        $thongBao = "Đặt lịch thành công";
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

    // public function xacNhanLich($maLich) {
    //     if (!$maLich) {
    //         echo "<div class='alert alert-danger'>Mã lịch khám không hợp lệ.</div>";
    //         return;
    //     }

    //     $result = $this->model->xacNhanLich($maLich);

    //     if ($result['status'] == 200) {
    //         echo "<script>
    //             alert('Lịch khám #{$maLich} đã được xác nhận thành công.');
    //             window.location.href = 'index.php?controller=lichkham&action=tracuu';
    //         </script>";
    //     } else {
    //         $errorMsg = $result['error'] ?? 'Không thể xác nhận lịch khám.';
    //         $errorMsg = addslashes($errorMsg);
    //         echo "<script>
    //             alert('Lỗi: {$errorMsg}');
    //             window.location.href = 'index.php?controller=lichkham&action=tracuu';
    //         </script>";
    //     }
    // }
    public function xacNhanLich($maLich) {
        if (!$maLich) {
            echo "<div class='alert alert-danger'>Mã lịch khám không hợp lệ.</div>";
            return;
        }

        $result = $this->model->xacNhanLich($maLich);

        if ($result['status'] == 200) {
            $data = $result['data'];


            $options = new Options();
            $options->set('defaultFont', 'DejaVu Sans');
            $dompdf = new Dompdf($options);

            $html = "
            <h2 style='text-align:center;'>XÁC NHẬN LỊCH KHÁM</h2>
            <p><strong>Mã phiếu:</strong> {$data['maPhieu']}</p>
            <p><strong>Bác sĩ:</strong> {$data['tenBacSi']}</p>
            <p><strong>Bệnh nhân:</strong> {$data['tenBenhNhan']}</p>
            <p><strong>Ngày:</strong> {$data['ngay']}</p>
            <p><strong>Giờ:</strong> {$data['gio']}</p>
            <p><strong>Số phòng:</strong> {$data['soPhong']}</p>
            <p><strong>Số thứ tự:</strong> {$data['soThuTu']}</p>
            <hr>
            <p style='text-align:center;'>Xin vui lòng đến đúng giờ hẹn!</p>
            ";

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A5', 'portrait');
            $dompdf->render();

            // Xóa buffer cũ nếu có
            if (ob_get_length()) ob_end_clean();

            // Xuất PDF
            $dompdf->stream("lich_kham_{$maLich}.pdf", ["Attachment" => true]);
            exit; // 🚨 Bắt buộc để không in thêm gì ra ngoài
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

    public function chiDinhDichVuPage(){
        // Gọi model lấy danh sách chuyên khoa từ API
        $result = $this->model->layDanhSachDichVu();

        // Nếu có lỗi, hiển thị mảng rỗng để dropdown không bị lỗi
        if (isset($result['error'])) {
            $dsDichVu = [];
            $errorMsg = $result['error'];
            echo "<div class='alert alert-warning'>Lỗi khi tải danh sách dịch vụ: {$errorMsg}</div>";
        } else {
            $dsDichVu = $result; // dữ liệu trả về từ API
        }

        $tenBN = $_GET['tenBenhNhan'] ?? '';
        $maLichKham = $_GET['maLich'] ?? '';

        $VIEW = './views/LichKham/ChiDinhDichVu.php';
        include './template/Template.php';
    }

    public function chiDinhDichVu() {
        // Lấy dữ liệu từ form
        $maLichKham = $_POST['maLichKham'] ?? '';
        $maDichVu   = $_POST['dichVu'] ?? '';
        $phong      = $_POST['phong'] ?? '';
        $ghiChu     = $_POST['ghiChu'] ?? '';

        // Gọi model để chỉ định dịch vụ
        $result = $this->model->chiDinhDichVu($maLichKham, $maDichVu, $phong, $ghiChu);

        $thongBao = "✅ Chỉ định dịch vụ thành công!";
        if (!empty($result['error'])) {
            $thongBao = "❌ Lỗi khi chỉ định dịch vụ: " . htmlspecialchars($result['error']);
        }
        echo "<script>alert('{$thongBao}');</script>";

        // Sau khi lưu -> load lại danh sách dịch vụ
        $dsDichVu = $this->model->layDanhSachDichVu();

        // Vẫn giữ lại thông tin bệnh nhân và lịch khám từ form
        $tenBN = $_POST['tenBenhNhan'] ?? ''; 
        $maLichKham = $_POST['maLichKham'] ?? '';

        $VIEW = './views/LichKham/ChiDinhDichVu.php';
        include './template/Template.php';
    }

}

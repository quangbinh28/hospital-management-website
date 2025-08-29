<?php
require_once 'models/HoSoBenhAnModel.php';
require_once 'models/BenhNhanModel.php';


class HoSoBenhAnController {
    private $model;

    public function __construct() {
        $this->model = new HoSoBenhAnModel();
    }

    /**
     * Hiển thị form thêm hồ sơ mới cho bệnh nhân
     */
    public function them($maBN) {
        $benhNhanModel = new BenhNhanModel();
        $benhNhan = $benhNhanModel->layThongTinBenhNhan($maBN);
        if (!$benhNhan) {
            echo "<div class='alert alert-danger'>Không tìm thấy bệnh nhân</div>";
            return;
        }

        $VIEW = './views/BenhNhan/BenhNhan_ThemBenhAn.php';
        include './template/Template.php';

    }

    /**
     * Xử lý lưu hồ sơ mới
     */
    public function luu() {
        $maBenhNhan = $_POST['maBenhNhan'];
        $data = [
            'maBenhNhan' => $_POST['maBenhNhan'],
            'chanDoan'   => $_POST['chanDoan'],
            'trieuChung' => $_POST['trieuChung'],
            'ghiChu'     => $_POST['ghiChu'],
            'maBacSi'    => $_SESSION['user']['id'],
            'ngayKham'   => date('Y-m-d H:i:s'), // ✅ Thêm ngày khám
        ];
        
        // Gọi API
        $result = $this->model->taoHoSo($data);

        if ($result['status'] >= 200 && $result['status'] < 300) {
            $msg = $result['response']['message'] ?? "Thêm hồ sơ bệnh án thành công!";
            echo "<script>
                alert('{$msg}');
                window.location.href = 'index.php?controller=benhnhan&action=chitiet&id={$maBenhNhan}';
            </script>";
        } else {
            $errorMsg = $result['response']['error'] 
                        ?? $result['response']['message'] 
                        ?? 'Không thể lưu hồ sơ bệnh án.';
            $errorMsg = addslashes($errorMsg);
            echo "<script>
                alert('Lỗi: {$errorMsg}');
                window.location.href = 'index.php?controller=benhnhan&action=chitiet&id={$maBenhNhan}';
            </script>";
        }
    }
}

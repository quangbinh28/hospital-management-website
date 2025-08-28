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


    /**
     * Hiển thị form cập nhật 1 hồ sơ (nếu cần cho mục đích đặc biệt)
     */
    public function capNhatPage($maHS) {
        $hoso = $this->model->getHoSoById($maHS);
        if (!$hoso) {
            echo "<div class='alert alert-danger'>Không tìm thấy hồ sơ bệnh án.</div>";
            return;
        }

        $benhNhan = $this->model->getBenhNhanById($hoso['MaBN']);
        include 'views/HoSoBenhAn/update_hoso.php';
    }

    /**
     * Cập nhật hồ sơ (nếu được cho phép cập nhật hồ sơ cũ)
     */
    public function luuCapNhat() {
        $maHS = $_POST['ma_hs'];
        $data = [
            'ChanDoanBanDau' => $_POST['chan_doan'],
            'TinhTrangNhapVien' => $_POST['tinh_trang'],
            'NgayNhapVien' => $_POST['ngay_nhap'],
            'NgayRaVien' => $_POST['ngay_ra'] ?? null,
            'GhiChu' => $_POST['ghi_chu']
        ];

        $this->model->updateHoSo($maHS, $data);

        header('Location: index.php?controller=benhnhan&action=chitiet&id=' . $_POST['ma_bn']);
    }

    /**
     * Xem chi tiết 1 hồ sơ bệnh án cụ thể
     */
    public function chiTiet($maHS) {
        $hoso = $this->model->getHoSoById($maHS);
        if (!$hoso) {
            echo "<div class='alert alert-warning'>Không tìm thấy hồ sơ</div>";
            return;
        }

        $ketQua = $this->model->getKetQuaKhamByMaHS($maHS);
        include 'views/HoSoBenhAn/detail_hoso.php';
    }
}

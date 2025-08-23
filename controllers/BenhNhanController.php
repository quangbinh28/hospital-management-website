<?php
require_once 'models/BenhNhanModel.php';

class BenhNhanController {
    private $model;

    public function __construct() {
        $this->model = new BenhNhanModel();
    }

    public function timKiemPage() {
        $VIEW = './views/BenhNhan/BenhNhan_TraCuu.php';
        include './template/Template.php';
    }
    /**
     * Trang tìm kiếm bệnh nhân (giao diện)
     */
    public function timKiem() {
        $maBN = $_POST['maBN'] ?? '';
        $cmnd = $_POST['cmnd'] ?? '';
        $ten  = $_POST['ten'] ?? '';
        $sdt  = $_POST['sdt'] ?? '';
        $page = ($_POST['page'] ?? 1) - 1; // API pageNumber bắt đầu từ 0
        $size = 10;

        $result = $this->model->timKiemBenhNhan($maBN, $ten, $sdt, $page, $size);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patients     = $result['content'] ?? [];
            $totalPages   = $result['totalPages'] ?? 1;
            $currentPage  = ($result['number'] ?? 0) + 1; // cộng lại để hiển thị 1-based
            $totalRecords = $result['totalElements'] ?? 0;

            include 'views/BenhNhan/BenhNhan_KetQua.php';
        } else {
            include 'views/BenhNhan/BenhNhan_TraCuu.php';
        }
    }



    /**
     * Trang chi tiết bệnh nhân
     */
    public function chiTiet($maBN) {
        $benhNhan = $this->model->layThongTinBenhNhan($maBN);
        $hoSoList = $this->model->layHoSoBenhNhan($maBN);

        // mỗi hồ sơ có thể có 1 kết quả khám
        foreach ($hoSoList as &$hs) {
            $hs['KetQuaKham'] = $this->model->layKetQuaKhamTheoMaHS($hs['MaHS']);
        }

        $VIEW ='views/BenhNhan/BenhNhan_ChiTiet.php';
        include './template/Template.php';
    }

    /**
     * Trang hiển thị form thêm bệnh nhân
     */
    public function themPage() {
        $VIEW = './views/BenhNhan/BenhNhan_ThemBenhNhan.php';
        include './template/Template.php';
    }

    /**
     * Xử lý thêm bệnh nhân
     */
    public function them() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $data = [
                'maBN'   => $_POST['maBN']   ?? '',
                'ten'    => $_POST['ten']    ?? '',
                'sdt'    => $_POST['sdt']    ?? '',
                'ngaySinh' => $_POST['ngaySinh'] ?? '',
                'gioiTinh' => $_POST['gioiTinh'] ?? '',
                'diaChi' => $_POST['diaChi'] ?? ''
            ];

            // Gọi model để lưu
            $result = $this->model->themBenhNhan($data);

            if ($result) {
                // Chuyển về trang tra cứu
                header("Location: index.php?controller=BenhNhan&action=timKiemPage&success=1");
                exit;
            } else {
                $error = "Không thể thêm bệnh nhân. Vui lòng thử lại.";
                $VIEW = './views/BenhNhan/BenhNhan_ThemBenhNhan.php';
                include './template/Template.php';
            }
        }
    }
    
}

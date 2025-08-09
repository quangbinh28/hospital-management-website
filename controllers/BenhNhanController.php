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
        // lấy dữ liệu từ form tìm kiếm 
        $maBN   = $_POST['maBN'] ?? '';
        $cmnd   = $_POST['cmnd'] ?? '';
        $ten    = $_POST['ten'] ?? '';
        $sdt    = $_POST['sdt'] ?? '';
        $page   = $_POST['page'] ?? 1;

        // xử lý tìm kiếm (gọi model)
        $result = $this->model->timKiemBenhNhan($maBN, $cmnd, $ten, $sdt, $page);

        // trả kết quả HTML (nếu là AJAX) hoặc hiển thị view
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patients = $result['data'];
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

        include 'views/BenhNhan/BenhNhan_ChiTiet.php';
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
                'cmnd'   => $_POST['cmnd']   ?? '',
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

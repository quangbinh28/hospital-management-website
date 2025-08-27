<?php
require_once 'models/ThongKeModel.php';

class ThongKeController {
    private $model;

    public function __construct() {
        $this->model = new ThongKeModel(); // Lưu ý sửa tên model cho đúng
    }

    // Hiển thị trang form thống kê
    public function thongKePage() {
        $VIEW = "./views/ThongKe/ThongKe.php";
        include './template/Template.php';
    }

    // Xử lý form thống kê
    public function thongKe() {
        // Lấy năm từ POST, mặc định là năm hiện tại nếu chưa nhập
        $nam = $_POST['nam'] ?? date('Y');

        // Gọi model để lấy dữ liệu thống kê
        $thongKeData = $this->model->thongKe($nam); 

        // Chuyển dữ liệu xuống view
        include './views/ThongKe/ThongKe_KetQua.php';
    }
}

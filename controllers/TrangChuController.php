<?php
class TrangChuController {
    /**
     * Hiển thị trang chủ (giới thiệu bệnh viện ABC)
     */
    public function trangChuPage() {
        $VIEW = 'views/TrangChu.php';
        include './template/Template.php';
    }
}
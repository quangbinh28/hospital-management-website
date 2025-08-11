<?php
class LichKhamModel {
    public function __construct() {
        // Kết nối DB
    }

    public function layDanhSachChuyenKhoa() {
        // TODO: Truy vấn bảng Khoa
        return [];
    }

    public function layDanhSachBacSiTheoKhoa($maKhoa) {
        // TODO: Truy vấn bảng Bác Sĩ join Nhân Viên theo MaKhoa
        return [];
    }

    public function layDanhSachCaKhamTheoBacSi($maBS) {
        // TODO: Truy vấn bảng Ca Làm Việc & Lịch Khám
        return [];
    }

    public function datLichKham($maBS, $ngay, $gio, $nguoiDK) {
        // TODO: Insert vào bảng Lịch Khám
        return true;
    }
}

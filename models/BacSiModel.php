<?php
class BacSiModel {
    public function __construct() {
        // Khởi tạo, có thể kết nối API hoặc DB nếu cần
    }

    /**
     * Thêm bác sĩ
     */
    public function themBacSi($maChungChi, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $kinhNghiem) {
        // TODO: Thêm logic lưu bác sĩ
        return [];
    }

    /**
     * Lấy danh sách bác sĩ
     */
    public function layDanhSachBacSi($page = 1) {
        // TODO: Thêm logic lấy danh sách bác sĩ
        return [
            'data' => [],
            'total' => 0
        ];
    }

    /**
     * Lấy thông tin chi tiết của một bác sĩ
     */
    public function layThongTinBacSi($maNV) {
        // TODO: Thêm logic lấy thông tin chi tiết
        return [];
    }
}

<?php
class LichKhamModel {
    // Thuộc tính lịch khám
    public $id;
    public $benh_nhan_id;
    public $chuyen_khoa_id;
    public $bac_si_id;
    public $ngay_kham;
    public $gio_kham;
    public $nguyen_nhan;
    public $trang_thai; // ví dụ: đã đặt, đã khám, hủy

    public function __construct($id = null, $benh_nhan_id = null, $chuyen_khoa_id = null, $bac_si_id = null, $ngay_kham = null, $gio_kham = null, $nguyen_nhan = null, $trang_thai = null) {
        $this->id = $id;
        $this->benh_nhan_id = $benh_nhan_id;
        $this->chuyen_khoa_id = $chuyen_khoa_id;
        $this->bac_si_id = $bac_si_id;
        $this->ngay_kham = $ngay_kham;
        $this->gio_kham = $gio_kham;
        $this->nguyen_nhan = $nguyen_nhan;
        $this->trang_thai = $trang_thai;
    }

    // Lấy danh sách chuyên khoa
    public function getAllChuyenKhoa() {
        // TODO: Gọi API hoặc query DB để lấy danh sách chuyên khoa
    }

    // Lấy danh sách bác sĩ theo chuyên khoa
    public function getBacSiByChuyenKhoa($chuyen_khoa_id) {
        // TODO: Gọi API hoặc query DB để lấy danh sách bác sĩ
    }

    // Lấy lịch trống của bác sĩ
    public function getLichTrongByBacSi($bac_si_id) {
        // TODO: Gọi API hoặc query DB để lấy danh sách ngày/giờ còn trống
    }

    // Đặt lịch khám mới
    public function datLichKham($benh_nhan_id, $chuyen_khoa_id, $bac_si_id, $ngay_kham, $gio_kham, $nguyen_nhan) {
        // TODO: Gọi API hoặc query DB để lưu lịch khám
    }

    // Lấy danh sách lịch khám của bệnh nhân
    public function getLichKhamByBenhNhan($benh_nhan_id) {
        // TODO: Gọi API hoặc query DB để lấy danh sách lịch khám
    }

    // Hủy lịch khám
    public function huyLichKham($lich_kham_id) {
        // TODO: Gọi API hoặc query DB để hủy lịch khám
    }
}

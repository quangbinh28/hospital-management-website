<?php
class BenhNhanModel {
    public function __construct() {
        // Khởi tạo, có thể kết nối API hoặc DB nếu cần
    }

    /**
     * Tìm kiếm bệnh nhân theo các tiêu chí
     */
    public function timKiemBenhNhan($maBN, $cmnd, $ten, $sdt, $page) {
        // TODO: Thêm logic tìm kiếm bệnh nhân (gọi API hoặc DB)
        return [
            'data' => [
                [
                    'MaBN' => 'BN001',
                    'cmnd' => '012356744',
                    'HoTenBN' => 'NVA',
                    'GioiTinhBN' => 'Nam',
                    'NgaySinhBN' => '0123567',
                    'EmailBN' => 'a@gmail.com'
                ]
            ],
            'total' => 1
        ];
    }

    /**
     * Lấy thông tin chi tiết của một bệnh nhân
     */
    public function layThongTinBenhNhan($maBN) {
        // TODO: Thêm logic lấy thông tin bệnh nhân
        return [];
    }

    /**
     * Lấy danh sách hồ sơ bệnh án của bệnh nhân
     */
    public function layHoSoBenhNhan($maBN) {
        // TODO: Thêm logic lấy danh sách hồ sơ
        return [];
    }

    /**
     * Lấy kết quả khám theo mã hồ sơ
     */
    public function layKetQuaKhamTheoMaHS($maHS) {
        // TODO: Thêm logic lấy kết quả khám
        return [];
    }

    /**
     * Thêm bệnh nhân
     */
    public function themBenhNhan($data) {
        // TODO: Thêm logic lấy kết quả khám
        return [];
    }
}

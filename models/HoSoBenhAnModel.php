<?php

class HoSoBenhAnModel {
    /**
     * Lấy danh sách tất cả hồ sơ bệnh án của một bệnh nhân
     */
    public function getHoSoByMaBN($maBN) {

    }

    /**
     * Lấy 1 hồ sơ theo mã hồ sơ
     */
    public function getHoSoById($maHS) {

    }

    /**
     * Thêm mới một hồ sơ bệnh án
     */
    public function insertHoSo($data) {

    }

    /**
     * Cập nhật hồ sơ bệnh án (nếu cho phép chỉnh sửa)
     */
    public function updateHoSo($maHS, $data) {

    }

    /**
     * Lấy thông tin bệnh nhân (phục vụ hiển thị hồ sơ)
     */
    public function getBenhNhanById($maBN) {
        return 

                [
                    'MaBN' => 'BN001',
                    'cmnd' => '012356744',
                    'HoTenBN' => 'NVA',
                    'GioiTinhBN' => 'Nam',
                    'NgaySinhBN' => '0123567',
                    'DiaChi' => 'a@gmail.com'
                ]
                ;
    }

    /**
     * (Tuỳ chọn) Lấy các kết quả khám lâm sàng, CLS, điều trị... nếu có
     */
    public function getKetQuaKhamByMaHS($maHS) {

    }
}

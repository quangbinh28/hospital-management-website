<?php
class DonThuocModel {
    public function taoDonThuoc($maBN, $chanDoan, $ghiChu, $thuocList) {
        // Lưu vào bảng DonThuoc
        $maDT = rand(1000, 9999); // giả lập
        // Thực tế sẽ INSERT vào DB và lấy ID
        // Sau đó lưu từng thuốc vào bảng ChiTietDonThuoc
        return $maDT;
    }
}

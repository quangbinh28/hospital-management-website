<?php
class DonThuocModel {
    public function taoDonThuoc($maBN, $chanDoan, $ghiChu, $thuocList) {
        // Lưu vào bảng DonThuoc
        $maDT = rand(1000, 9999); // giả lập
        // Thực tế sẽ INSERT vào DB và lấy ID
        // Sau đó lưu từng thuốc vào bảng ChiTietDonThuoc
        return $maDT;
    }

    public function timKiemDonThuoc($maDT, $tenBN, $ngayLap, $page = 1) {
        // Demo dữ liệu, thực tế truy vấn DB
        $data = [
            ['MaDT' => 'DT001', 'TenBN' => 'Nguyễn Văn A', 'NgayLap' => '2025-08-01', 'TinhTrang' => 'Đã cấp'],
            ['MaDT' => 'DT002', 'TenBN' => 'Trần Thị B',   'NgayLap' => '2025-08-02', 'TinhTrang' => 'Đang xử lý']
        ];

        return ['data' => $data];
    }

    public function layChiTietDonThuoc($maDT) {
        // Demo dữ liệu
        return [
            'MaDT' => $maDT,
            'TenBN' => 'Nguyễn Văn A',
            'NgayLap' => '2025-08-01',
            'TinhTrang' => 'Đã cấp',
            'Thuoc' => [
                ['TenThuoc' => 'Paracetamol', 'SoLuong' => 10, 'LieuLuong' => '500mg', 'ChiDinh' => 'Giảm đau'],
                ['TenThuoc' => 'Amoxicillin', 'SoLuong' => 20, 'LieuLuong' => '500mg', 'ChiDinh' => 'Kháng sinh']
            ]
        ];
    }
}

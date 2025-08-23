<?php
class DonThuocModel {
    public function taoDonThuoc($maBN, $chanDoan, $ghiChu, $thuocList) {
        // Lấy mã bác sĩ từ session
        $maBS = $_SESSION['id'] ?? '';
        $token = $_SESSION['accessToken'] ?? '';

        // Chuẩn bị dữ liệu gửi đi
        $data = [
            "maBacSi" => $maBS,
            "maBenhNhan" => $maBN,
            "chanDoan" => $chanDoan, // nếu API có field chẩn đoán
            "ghiChu" => $ghiChu,
            "prescriptionDetails" => $thuocList
        ];

        $url = "http://localhost:8080/api/v1/prescriptions/create";

        // Khởi tạo cURL
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));

        // Thực thi
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return [
                "error" => "Curl error: " . curl_error($ch)
            ];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            "status" => $httpCode,
            "response" => json_decode($response, true)
        ];
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
                ['TenThuoc' => 'Paracetamol', 'SoLuong' => 10, 'LieuLuong' => '500mg', 'ChiDinh' => '5 vien/ ngay'],
                ['TenThuoc' => 'Amoxicillin', 'SoLuong' => 20, 'LieuLuong' => '500mg', 'ChiDinh' => '5 vien/ ngay']
            ]
        ];
    }
}

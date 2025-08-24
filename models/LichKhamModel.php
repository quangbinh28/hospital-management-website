<?php
class LichKhamModel {
    private $lichKhamMau;

    public function __construct() {
        // Dữ liệu mẫu (thay cho CSDL)
        $this->lichKhamMau = [
            [
                'maLichKham' => 1,
                'tenBenhNhan' => 'Nguyễn Văn A',
                'ngayKham' => '2025-08-15',
                'gioKham' => '08:00',
                'bacSi' => 'BS. Trần Thị B',
                'trangThai' => 'Chưa xác nhận'
            ],
            [
                'maLichKham' => 2,
                'tenBenhNhan' => 'Trần Văn C',
                'ngayKham' => '2025-08-15',
                'gioKham' => '09:00',
                'bacSi' => 'BS. Lê Văn D',
                'trangThai' => 'Chưa xác nhận'
            ],
            [
                'maLichKham' => 3,
                'tenBenhNhan' => 'Phạm Thị E',
                'ngayKham' => '2025-08-16',
                'gioKham' => '10:00',
                'bacSi' => 'BS. Nguyễn Văn F',
                'trangThai' => 'Chưa xác nhận'
            ]
        ];
    }

    public function layDanhSachChuyenKhoa() {
        $url = "http://localhost:8080/api/v1/departments/all-departments";
        $token = $_SESSION['accessToken'] ?? '';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return ['error' => 'cURL Error: ' . curl_error($ch)];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            $data = json_decode($response, true);
            return $data ?: [];
        } else {
            return ['error' => "HTTP {$httpCode}: {$response}"];
        }
    }

    public function layDanhSachBacSiTheoKhoa($maKhoa) {
        $url = "http://localhost:8080/api/v1/departments/doctors/" . urlencode($maKhoa);
        $token = $_SESSION['accessToken'] ?? '';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return ['error' => 'cURL Error: ' . curl_error($ch)];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            $data = json_decode($response, true);
            return $data ?: [];
        } else {
            return ['error' => "HTTP {$httpCode}: {$response}"];
        }
    }


    public function layDanhSachCaKhamTheoBacSi($maBS) {
        $url = "http://localhost:8080/api/v1/schedules/" . urlencode($maBS);
        $token = $_SESSION['accessToken'] ?? '';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return ['error' => 'cURL Error: ' . curl_error($ch)];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            $data = json_decode($response, true);
            return $data ?: [];
        } else {
            return ['error' => "HTTP {$httpCode}: {$response}"];
        }
    }

    public function datLichKham($maBS, $ngay, $gio, $nguyenNhan, $maBN) {
        $token = $_SESSION['accessToken'] ?? '';

        $url = "http://localhost:8080/api/v1/appointments/create";

        $data = [
            "ngayKham"   => $ngay,
            "maBenhNhan" => $maBN,
            "maBacSi"    => $maBS,
            "gioKham"    => $gio,
            "ghiChu"     => $nguyenNhan
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $err = curl_error($ch);
            curl_close($ch);
            return [
                "status" => 0,
                "error"  => $err
            ];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Giải mã JSON trả về thành mảng PHP
        $respArray = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                "status" => $httpCode,
                "error"  => "JSON Decode Error: " . json_last_error_msg(),
                "raw"    => $response
            ];
        }

        return [
            "status"   => $httpCode,
            "response" => $respArray
        ];
    }


    public function layLichKhamChuaXacNhan($ngay = '') {
        if (empty($ngay)) {
            return $this->lichKhamMau;
        }
        // Lọc theo ngày
        return array_filter($this->lichKhamMau, function($lich) use ($ngay) {
            return $lich['ngayKham'] === $ngay;
        });
    }

    public function capNhatTrangThaiLichKham($maLich, $trangThai) {
        // Hiện tại chưa lưu vào DB, chỉ mô phỏng thành công
        return true;
    }

    public function layLichKhamDaXacNhan($maTaiKhoan, $tuNgay = null, $denNgay = null) {
        // Dữ liệu mẫu
        $data = [
            ['NgayKham' => '2025-08-15', 'GioKham' => '08:00', 'BacSi' => 'Nguyễn Văn A', 'Phong' => '101'],
            ['NgayKham' => '2025-08-18', 'GioKham' => '09:30', 'BacSi' => 'Trần Thị B', 'Phong' => '202'],
            ['NgayKham' => '2025-08-20', 'GioKham' => '14:00', 'BacSi' => 'Phạm Văn C', 'Phong' => '303'],
        ];

        // Lọc theo ngày nếu có chọn
        if ($tuNgay && $denNgay) {
            $data = array_filter($data, function ($item) use ($tuNgay, $denNgay) {
                return $item['NgayKham'] >= $tuNgay && $item['NgayKham'] <= $denNgay;
            });
        }

        return $data;
    }
}

<?php
class LichKhamModel {

    public function __construct() {
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
        $url = "http://localhost:8080/api/v1/schedules/doctor/" . urlencode($maBS);

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

    public function datLichKham($maBS, $ngay, $gio, $nguyenNhan, $maBN, $phong) {
        $token = $_SESSION['accessToken'] ?? '';

        $url = "http://localhost:8080/api/v1/appointments/create";
        $data = [
            "ngayKham"   => $ngay,
            "maBenhNhan" => $maBN,
            "maBacSi"    => $maBS,
            "gioKham"    => $gio,
            "ghiChu"     => $nguyenNhan,
            "phong"     => $phong
        ];

        if ($_SESSION['user']['sub'] == 'BENHNHAN') {
            $url = "http://localhost:8080/api/v1/appointments/book";
            $data = [
                "ngayKham"   => $ngay,
                "maBacSi"    => $maBS,
                "gioKham"    => $gio,
                "ghiChu"     => $nguyenNhan,
                "phong"     => $phong
            ];
        }

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
    
    public function xacNhanLich($maLich) {
        $url = "http://localhost:8080/api/v1/appointments/checkin/" . urlencode($maLich);
        $token = $_SESSION['accessToken'] ?? '';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // PUT cho checkin
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json",
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return ['status' => $httpCode, 'data' => json_decode($response, true)];
        } else {
            return ['status' => $httpCode, 'error' => $response];
        }
    }

    public function huyLich($maLich) {
        $url = "http://localhost:8080/api/v1/appointments/cancel/" . urlencode($maLich);
        $token = $_SESSION['accessToken'] ?? '';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // DELETE cho hủy lịch
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json",
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return ['status' => $httpCode, 'data' => json_decode($response, true)];
        } else {
            return ['status' => $httpCode, 'error' => $response];
        }
    }


    public function timKiemLichKham(
        $maBS = '', 
        $maBN = '', 
        $ngayTu = '', 
        $ngayDen = '', 
        $tinhTrang = '', 
        $page = 0, 
        $size = 10
    ) {
        $token = $_SESSION['accessToken'] ?? '';

        $url = "http://localhost:8080/api/v1/appointments/search";
    
        if ($_SESSION['user']['sub'] == 'BENHNHAN') {
            $url = "http://localhost:8080/api/v1/appointments/my-appointments";
        }

        // Chỉ giữ các param không rỗng
        $params = array_filter([
            'maBS'       => $maBS,
            'maBN'       => $maBN,
            'ngayKhamTu' => $ngayTu,
            'ngayKhamDen'=> $ngayDen,
            'tinhTrang'  => $tinhTrang,
            'page'       => $page,
            'size'       => $size
        ]);

        $fullUrl = $url . '?' . http_build_query($params);

        $ch = curl_init($fullUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return [
                'content'       => [],
                'totalPages'    => 0,
                'number'        => 0,
                'totalElements' => 0,
                'error'         => curl_error($ch)
            ];
        }

        curl_close($ch);

        $data = json_decode($response, true);
        if (!$data) {
            return [
                'content'       => [],
                'totalPages'    => 0,
                'number'        => 0,
                'totalElements' => 0,
                'error'         => "JSON Decode Error: " . json_last_error_msg()
            ];
        }

        return [
            'content'       => $data['content'] ?? [],
            'totalPages'    => $data['totalPages'] ?? 1,
            'number'        => $data['number'] ?? 0,
            'totalElements' => $data['totalElements'] ?? count($data['content'] ?? [])
        ];
    }

    public function layDanhSachDichVu() {
        $url = "http://localhost:8080/api/v1/services/all";
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

    public function chiDinhDichVu($maLichKham, $maDichVu, $phong, $ghiChu) {
        $token = $_SESSION['accessToken'] ?? '';

        $url = "http://localhost:8080/api/v1/service-designation/create";
        $data = [
            "maDichVu"   => $maDichVu,
            "maLichKham" => $maLichKham,
            "moTa"       => $ghiChu,
            "soPhong"    => $phong
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

        // Giải mã JSON trả về
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

}

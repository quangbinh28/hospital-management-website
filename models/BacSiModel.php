<?php
class BacSiModel {
    public function __construct() {
        // Khởi tạo, có thể kết nối API hoặc DB nếu cần
    }

    /**
     * Thêm bác sĩ
     */
    public function themBacSi($maChungChi, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $kinhNghiem) {
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
    public function chiTiet($maNV) {
        // Ghép URL API
        $url = "http://localhost:8080/api/v1/employees/doctor/" . urlencode($maNV);

        // Nếu API yêu cầu Bearer Token
        $token = $_SESSION['accessToken'] ?? '';

        // Gọi API bằng cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $token",
            "Accept: application/json"
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return [
                'error' => curl_error($ch)
            ];
        }

        curl_close($ch);

        // Parse JSON trả về thành mảng PHP
        $result = json_decode($response, true);

        return $result ?? [];
    }

    public function uploadAvatar($file) {
        $token = $_SESSION['accessToken'] ?? '';

        $url = "http://localhost:8080/api/v1/employees/doctor/upload-image";

        // Chuẩn bị multipart/form-data
        $cfile = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
        $postFields = [
            "file" => $cfile   // đổi "file" nếu backend yêu cầu tên param khác
        ];

        // Khởi tạo cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        // Thực thi
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $err = "Curl error: " . curl_error($ch);
            echo "<script>alert('{$err}');</script>";
            return ["error" => $err];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $respJson = json_decode($response, true);

        return [
            "status" => $httpCode,
            "response" => $respJson
        ];
    }


}

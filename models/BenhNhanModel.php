<?php
class BenhNhanModel {
    public function __construct() {
    }

    /**
     * Tìm kiếm bệnh nhân theo các tiêu chí
     */
    public function timKiemBenhNhan($maBN, $ten, $sdt, $page, $size = 10) {
        $url = "http://localhost:8080/api/v1/patients/search";

        // Gắn query params vào URL
        $query = http_build_query([
            'maBN'  => $maBN,
            'hoTen' => $ten,
            'soDT'  => $sdt,
            'page'  => $page,
            'size'  => $size,
        ]);

        $fullUrl = $url . '?' . $query;

        // Token (nếu API yêu cầu)
        $token = $_SESSION['accessToken'] ?? '';

        // Gọi API bằng cURL
        $ch = curl_init($fullUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json",
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);

            return [
                'error' => "cURL Error: {$error}"
            ];
        }

        curl_close($ch);

        // Giải mã JSON trả về thành mảng PHP
        $result = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'error' => "JSON Decode Error: " . json_last_error_msg(),
                'raw'   => $response,
            ];
        }

        return $result ?? [];
    }


    /**
     * Lấy thông tin chi tiết của một bệnh nhân
     */
    public function layThongTinBenhNhan($maBN) {
        // Ghép URL API
        $url = "http://localhost:8080/api/v1/patients/details/" . urlencode($maBN);

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


    /**
     * Lấy danh sách hồ sơ bệnh án của bệnh nhân
     */
    public function layHoSoBenhNhan($maBN) {
        // Lấy token từ session (nếu API cần xác thực)
        $token = $_SESSION['accessToken'] ?? '';

        // URL API chi tiết hồ sơ bệnh nhân
        $url = "http://localhost:8080/api/v1/records/details/" . urlencode($maBN);

        // Khởi tạo cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$token}",
            "Accept: application/json",
        ]);

        // Thực hiện gọi API
        $response = curl_exec($ch);

        // Xử lý lỗi cURL
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return [
                'error' => "cURL Error: {$error}"
            ];
        }

        curl_close($ch);

        // Giải mã JSON trả về
        $data = json_decode($response, true);

        return $data ?: [];
    }
}

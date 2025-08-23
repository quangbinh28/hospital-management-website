<?php
class ThuocModel {

    /**
     * Gọi API để tìm thuốc theo tên
     */
    public function timThuocTheoTen($q) {
        if ($q === "") {
            return [];
        }

        $url = "http://localhost:8080/api/v1/medications?tenThuoc=" . urlencode($q);

        // Lấy token từ session (sau khi đăng nhập đã lưu)
        $token = $_SESSION['accessToken'] ?? '';

        // gọi API bằng cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // timeout 10s

        // Thêm Authorization header nếu có token
        $headers = ["Accept: application/json"];
        if (!empty($token)) {
            $headers[] = "Authorization: Bearer $token";
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if ($response === false) {
            curl_close($ch);
            return [
                "error" => curl_error($ch)
            ];
        }

        curl_close($ch);

        // parse JSON
        $data = json_decode($response, true);
        if (!is_array($data)) {
            return [];
        }

        // 🚀 Trả nguyên dữ liệu từ API
        return $data;
    }
}

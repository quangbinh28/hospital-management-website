<?php

class HoSoBenhAnModel {
    /**
     * Thêm mới một hồ sơ bệnh án
     */
    public function taoHoSo($data) {
        $url = "http://localhost:8080/api/v1/patients/add-record";
        $token = $_SESSION['accessToken'] ?? '';

        // Chuẩn bị cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ]);

        // Gửi dữ liệu JSON
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));

        // Thực thi
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Xử lý lỗi cURL
            $error = curl_error($ch);
            curl_close($ch);
            return [
                'error' => "cURL Error: {$error}"
            ];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Trả về kết quả giải mã JSON
        return [
            'status' => $httpCode,
            'response' => json_decode($response, true)
        ];
    }
}

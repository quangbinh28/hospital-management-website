<?php


class UserModel {
    public function handleLogin($username, $password) {
        // URL API (thay baseURL bằng giá trị thật)
        $url = "http://localhost:8080/api/v1/auth/login";

        // Gắn query string (nếu API yêu cầu query param thay vì body)
        $url .= "?email=" . urlencode($username) . "&password=" . urlencode($password);

        // Khởi tạo cURL
        $ch = curl_init();

        // Thiết lập tùy chọn
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true); // POST method
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);

        // Thực thi request
        $response = curl_exec($ch);

        // Bắt lỗi nếu có
        if (curl_errno($ch)) {
            return [
                "success" => false,
                "error" => curl_error($ch)
            ];
        }

        // Đóng kết nối
        curl_close($ch);

        // Giải mã JSON response
        $data = json_decode($response, true);

        return $data;
    }
}
?>    
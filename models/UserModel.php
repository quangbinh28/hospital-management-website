<?php
class UserModel {
    public function handleLogin($username, $password) {
        $url = "http://localhost:8080/api/v1/auth/login";
        $url .= "?email=" . urlencode($username) . "&password=" . urlencode($password);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return [
                "success" => false,
                "error" => curl_error($ch)
            ];
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if ($data['accessToken'] !== '') {
            // Giải mã JWT payload
            $payload = $this->decodeJwt($data['accessToken']);

            // Lưu thông tin vào session
            $_SESSION['accessToken']  = $data['accessToken'];
            $_SESSION['refreshToken'] = $data['refreshToken'];
            $_SESSION['user'] = $payload;
            $_SESSION['user']['sub']  = $payload['role'];
            $_SESSION['IsLogined'] = true;
            $_SESSION['user']['ten']  = $data['username'];
            $_SESSION['user']['id']  = $data['id'];

            // ✅ chuyển hướng sang trang mong muốn
            header("Location: http://localhost/ProjectUDPT/Website/index.php?controller=trangchu&action=trangchupage");
            exit(); 
        }

        $_SESSION['IsLogined'] = false;
    
        echo "<script> alert('Thông tin đăng nhập không hợp lệ'); </script>";
        header("Location: http://localhost/ProjectUDPT/Website/index.php?controller=auth&action=loginpage");
        return [
            "success" => false,
            "error" => "Login failed"
        ];
    }

    private function decodeJwt($jwt) {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) {
            return null;
        }
        $payload = $parts[1];
        $decoded = base64_decode(strtr($payload, '-_', '+/'));
        return json_decode($decoded, true);
    }

    public function handleRegister($data) {
        $url = "http://localhost:8080/api/v1/register/create";

        // Khởi tạo cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Thực hiện request
        $response = curl_exec($ch);

        // Kiểm tra lỗi cURL
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return [
                "success" => false,
                "error" => $error
            ];
        }

        curl_close($ch);

        // Giải mã JSON trả về
        $result = json_decode($response, true);

        if (!$result) {
            return [
                "success" => false,
                "error" => "Không thể giải mã phản hồi từ API"
            ];
        }

        // Kiểm tra kết quả từ API
        if (isset($result['statusCode']) && $result['statusCode'] === "201") {
            return [
                "success" => true,
                "data" => $result
            ];
        } else {
            return [
                "success" => false,
                "error" => $result['statusMessage'] ?? "Đăng ký thất bại"
            ];
        }
    }

}

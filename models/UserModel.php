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

        if ($data['accessToken'] != '') {
            // Giải mã JWT payload
            $payload = $this->decodeJwt($data['accessToken']);

            // Lưu thông tin vào session
            $_SESSION['accessToken']  = $data['accessToken'];
            $_SESSION['refreshToken'] = $data['refreshToken'];
            $_SESSION['user'] = $payload;
            $_SESSION['IsLogined'] = true;
            $_SESSION['user']['ten']  = $data['usernam'];

            // ✅ chuyển hướng sang trang mong muốn
            header("Location: http://localhost/ProjectUDPT/Website/index.php?controller=benhnhan&action=timkiempage");
            exit(); // quan trọng: dừng hẳn sau redirect
        }

        $_SESSION['IsLogined'] = false;
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
}

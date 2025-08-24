<?php
class DonThuocModel {
    public function taoDonThuoc($maBN, $ghiChu, $thuocList) {
        // Lấy mã bác sĩ từ session
        $maBS =  $_SESSION['user']['id'];
        $token = $_SESSION['accessToken'] ?? '';

        // Chuẩn bị dữ liệu gửi đi
        $data = [
            "maBacSi" => $maBS,
            "maBenhNhan" => $maBN,
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
            $err = "Curl error: " . curl_error($ch);
            echo "<script>alert('{$err}');</script>";
            return ["error" => $err];
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $respJson = json_decode($response, true);
        $respString = addslashes(json_encode($respJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        // In alert ra browser
        return [
            "status" => $httpCode,
            "response" => $respJson
        ];
    }


    public function timKiemDonThuoc($maDT = '', $maBN = '', $tuNgay = '', $denNgay = '', $page = 0, $size = 10, $maBS = '') {
        // Lấy mã bác sĩ từ session (nếu cần)
        $maBS = $_SESSION['id'] ?? '';
        $token = $_SESSION['accessToken'] ?? '';

        $url = "http://localhost:8080/api/v1/prescriptions/search";

        // Gắn query params
        $query = http_build_query([
            'maBS'   => $maBS,
            'maBN'   => $maBN,
            'tuNgay' => $tuNgay,
            'denNgay'=> $denNgay,
            'page'   => $page,
            'size'   => $size,
        ]);

        $fullUrl = $url . '?' . $query;

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

        // Giải mã JSON trả về
        $data = json_decode($response, true);

        return $data ?: [];
    }


    public function layChiTietDonThuoc($maDT) {
        $url = "http://localhost:8080/api/v1/prescriptions/details/" . urlencode($maDT);

        // Lấy token từ session
        $token = $_SESSION['accessToken'] ?? '';

        $ch = curl_init($url);
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

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'status' => $httpCode,
                'error'  => "JSON Decode Error: " . json_last_error_msg(),
                'raw'    => $response,
            ];
        }

        return [
            'status' => $httpCode,
            'data'   => $result
        ];
    }

    public function sanSang($maDT) {
        $url = "http://localhost:8080/api/v1/prescriptions/ready/" . urlencode($maDT);
        $token = $_SESSION['accessToken'] ?? '';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Dùng PUT
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

    public function daLay($maDT) {
        $url = "http://localhost:8080/api/v1/prescriptions/checkout/" . urlencode($maDT);
        $token = $_SESSION['accessToken'] ?? '';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Dùng PUT
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
}

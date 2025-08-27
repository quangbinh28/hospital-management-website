<?php

class ThongKeModel {

    private $apiUrl = "http://localhost:8080/api/v1/statistics/all";

    /**
     * Lấy thống kê số bệnh nhân và đơn thuốc theo năm
     *
     * @param int|string $nam Năm cần thống kê
     * @return array Mảng dữ liệu thống kê [month, totalPatients, totalPrescriptions]
     */
    public function thongKe($nam) {
        // Lấy token từ session
        $token = $_SESSION['accessToken'] ?? '';

        // Gắn query param
        $query = http_build_query(['year' => $nam]);
        $fullUrl = $this->apiUrl . '?' . $query;

        // Khởi tạo cURL
        $ch = curl_init($fullUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Header bắt buộc gồm Authorization và Accept
        $headers = [
            "Authorization: Bearer {$token}",
            "Accept: application/json"
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Thực hiện request
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

        // Nếu dữ liệu không hợp lệ, trả về mảng rỗng
        return is_array($data) ? $data : [];
    }
}

<?php

class HoSoBenhAnModel {
    /**
     * Lấy danh sách tất cả hồ sơ bệnh án của một bệnh nhân
     */
    public function getHoSoByMaBN($maBN) {

    }

    /**
     * Lấy 1 hồ sơ theo mã hồ sơ
     */
    public function getHoSoById($maHS) {

    }

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


    /**
     * Cập nhật hồ sơ bệnh án (nếu cho phép chỉnh sửa)
     */
    public function updateHoSo($maHS, $data) {

    }

    /**
     * Lấy thông tin bệnh nhân (phục vụ hiển thị hồ sơ)
     */
    public function getBenhNhanById($maBN) {
        return 

                [
                    'MaBN' => 'BN001',
                    'cmnd' => '012356744',
                    'HoTenBN' => 'NVA',
                    'GioiTinhBN' => 'Nam',
                    'NgaySinhBN' => '0123567',
                    'DiaChi' => 'a@gmail.com'
                ]
                ;
    }

    /**
     * (Tuỳ chọn) Lấy các kết quả khám lâm sàng, CLS, điều trị... nếu có
     */
    public function getKetQuaKhamByMaHS($maHS) {

    }
}

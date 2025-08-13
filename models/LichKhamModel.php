<?php
class LichKhamModel {
    private $lichKhamMau;

    public function __construct() {
        // Dữ liệu mẫu (thay cho CSDL)
        $this->lichKhamMau = [
            [
                'maLichKham' => 1,
                'tenBenhNhan' => 'Nguyễn Văn A',
                'ngayKham' => '2025-08-15',
                'gioKham' => '08:00',
                'bacSi' => 'BS. Trần Thị B',
                'trangThai' => 'Chưa xác nhận'
            ],
            [
                'maLichKham' => 2,
                'tenBenhNhan' => 'Trần Văn C',
                'ngayKham' => '2025-08-15',
                'gioKham' => '09:00',
                'bacSi' => 'BS. Lê Văn D',
                'trangThai' => 'Chưa xác nhận'
            ],
            [
                'maLichKham' => 3,
                'tenBenhNhan' => 'Phạm Thị E',
                'ngayKham' => '2025-08-16',
                'gioKham' => '10:00',
                'bacSi' => 'BS. Nguyễn Văn F',
                'trangThai' => 'Chưa xác nhận'
            ]
        ];
    }

    public function layDanhSachChuyenKhoa() {
        return []; // Dữ liệu mẫu, cần query DB thật khi triển khai
    }

    public function layDanhSachBacSiTheoKhoa($maKhoa) {
        return [];
    }

    public function layDanhSachCaKhamTheoBacSi($maBS) {
        return [];
    }

    public function datLichKham($maBS, $ngay, $gio, $nguyenNhan, $nguoiDK) {
        // Ở đây chỉ trả về true, chưa insert vào DB
        return true;
    }

    public function layLichKhamChuaXacNhan($ngay = '') {
        if (empty($ngay)) {
            return $this->lichKhamMau;
        }
        // Lọc theo ngày
        return array_filter($this->lichKhamMau, function($lich) use ($ngay) {
            return $lich['ngayKham'] === $ngay;
        });
    }

    public function capNhatTrangThaiLichKham($maLich, $trangThai) {
        // Hiện tại chưa lưu vào DB, chỉ mô phỏng thành công
        return true;
    }

    public function layLichKhamDaXacNhan($maTaiKhoan, $tuNgay = null, $denNgay = null) {
        // Dữ liệu mẫu
        $data = [
            ['NgayKham' => '2025-08-15', 'GioKham' => '08:00', 'BacSi' => 'Nguyễn Văn A', 'Phong' => '101'],
            ['NgayKham' => '2025-08-18', 'GioKham' => '09:30', 'BacSi' => 'Trần Thị B', 'Phong' => '202'],
            ['NgayKham' => '2025-08-20', 'GioKham' => '14:00', 'BacSi' => 'Phạm Văn C', 'Phong' => '303'],
        ];

        // Lọc theo ngày nếu có chọn
        if ($tuNgay && $denNgay) {
            $data = array_filter($data, function ($item) use ($tuNgay, $denNgay) {
                return $item['NgayKham'] >= $tuNgay && $item['NgayKham'] <= $denNgay;
            });
        }

        return $data;
    }
}

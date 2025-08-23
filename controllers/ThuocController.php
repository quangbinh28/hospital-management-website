<?php
require_once "models/ThuocModel.php";
class ThuocController {
    public function goiYThuoc() {
        // Lấy từ khóa từ query string
        $q = isset($_GET['q']) ? trim($_GET['q']) : '';


        $model = new ThuocModel();
        $result = $model->timThuocTheoTen($q);

        // Trả JSON về cho frontend
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($result);
    }
}

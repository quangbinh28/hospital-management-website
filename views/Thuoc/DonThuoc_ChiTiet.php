<div class="container my-4" style="max-width: 900px;">
    <h2 class="text-primary mb-4">📄 Chi tiết đơn thuốc</h2>

    <!-- Thông tin đơn thuốc -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>Mã đơn thuốc:</strong> <?= htmlspecialchars($maDT) ?></p>
            <p><strong>Mã bệnh nhân:</strong> <?= htmlspecialchars($donThuoc['maBenhNhan']) ?></p>
            <p><strong>Mã bệnh nhân:</strong> <?= htmlspecialchars($donThuoc['maBacSi']) ?></p>
            <p><strong>Ngày cấp:</strong> <?= htmlspecialchars($donThuoc['ngayCap']) ?></p>
            <p><strong>Tình trạng:</strong> <?= htmlspecialchars($donThuoc['tinhTrang']) ?></p>
        </div>
    </div>

    <!-- Danh sách thuốc -->
    <h5 class="mb-3">💊 Danh sách thuốc</h5>
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered align-middle mb-4">
            <thead class="table-light">
                <tr>
                    <th>Tên thuốc</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Liều lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donThuoc['prescriptionDetails'] as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['tenThuoc']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($t['soLuong']) ?></td>
                        <td><?= htmlspecialchars($t['chiDinh']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Nút quay lại -->
    <div class="text-end">
        <a href="index.php?controller=donthuoc&action=tracuupage" class="btn btn-secondary">⬅ Quay lại</a>
    </div>
</div>

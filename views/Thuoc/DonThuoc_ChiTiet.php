<div class="container my-4" style="max-width: 900px;">
    <h2 class="text-primary mb-4">📄 Chi tiết đơn thuốc</h2>

    <!-- Thông tin đơn thuốc -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>Mã đơn thuốc:</strong> <?= htmlspecialchars($donThuoc['MaDT']) ?></p>
            <p><strong>Tên bệnh nhân:</strong> <?= htmlspecialchars($donThuoc['TenBN']) ?></p>
            <p><strong>Ngày lập:</strong> <?= htmlspecialchars($donThuoc['NgayLap']) ?></p>
            <p><strong>Tình trạng:</strong> <?= htmlspecialchars($donThuoc['TinhTrang']) ?></p>
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
                    <th>Chỉ định</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donThuoc['Thuoc'] as $t): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['TenThuoc']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($t['SoLuong']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($t['LieuLuong']) ?></td>
                        <td><?= htmlspecialchars($t['ChiDinh']) ?></td>
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

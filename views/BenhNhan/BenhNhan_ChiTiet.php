<div class="container my-4">
    <!-- Thông tin bệnh nhân -->
    <h3 class="text-primary mb-3">🧍 Thông tin bệnh nhân</h3>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr><th>Mã BN:</th><td><?= htmlspecialchars($benhNhan['maBenhNhan']) ?></td></tr>
                    <tr><th>Họ tên:</th><td><?= htmlspecialchars($benhNhan['hoTen']) ?></td></tr>
                    <tr><th>Ngày sinh:</th><td><?= htmlspecialchars($benhNhan['ngaySinh']) ?></td></tr>
                    <tr><th>Giới tính:</th><td><?= htmlspecialchars($benhNhan['gioiTinh']) ?></td></tr>
                    <tr><th>Email:</th><td><?= htmlspecialchars($benhNhan['soDienThoai']) ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Nút Thêm hồ sơ -->
    <div class="text-end mb-4">
        <a href="index.php?controller=hoso&action=them&maBN=<?= urlencode($benhNhan['maBenhNhan']) ?>" class="btn btn-primary">
            ➕ Thêm hồ sơ bệnh án mới
        </a>
    </div>

    <!-- Hồ sơ bệnh án -->
    <h4 class="text-secondary mb-3">🗂 Hồ sơ bệnh án</h4>
    <?php if (!empty($hoSoList)): ?>
        <?php foreach ($hoSoList as $hs): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-header fw-bold">
                    Mã HS: <?= htmlspecialchars($hs['MaHS']) ?>
                </div>
                <div class="card-body">
                    <p><strong>Ngày khám:</strong> <?= htmlspecialchars($hs['ngayKham']) ?></p>
                    <p><strong>Chẩn đoán:</strong> <?= htmlspecialchars($hs['chanDoan']) ?></p>
                    <p><strong>Triệu chứng:</strong> <?= htmlspecialchars($hs['trieuChung']) ?></p>
                    <p><strong>Ghi chú điều trị:</strong> <?= htmlspecialchars($hs['ghiChu']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-secondary">Chưa có hồ sơ bệnh án nào.</div>
    <?php endif; ?>
</div>

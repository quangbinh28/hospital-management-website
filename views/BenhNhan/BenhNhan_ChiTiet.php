<div class="container my-4">
    <!-- Thông tin bệnh nhân -->
    <h3 class="text-primary mb-3">🧍 Thông tin bệnh nhân</h3>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tbody>
                    <tr><th>Mã BN:</th><td><?= htmlspecialchars($patient['MaBN']) ?></td></tr>
                    <tr><th>Họ tên:</th><td><?= htmlspecialchars($patient['HoTenBN']) ?></td></tr>
                    <tr><th>Ngày sinh:</th><td><?= htmlspecialchars($patient['NgaySinhBN']) ?></td></tr>
                    <tr><th>Giới tính:</th><td><?= htmlspecialchars($patient['GioiTinhBN']) ?></td></tr>
                    <tr><th>Email:</th><td><?= htmlspecialchars($patient['EmailBN']) ?></td></tr>
                    <tr><th>Địa chỉ:</th><td><?= htmlspecialchars($patient['DiaChiBN']) ?></td></tr>
                    <tr><th>Mã BHYT:</th><td><?= htmlspecialchars($patient['MaBHYT']) ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Nút Thêm hồ sơ -->
    <div class="text-end mb-4">
        <a href="index.php?controller=hoso&action=them&maBN=<?= urlencode($patient['MaBN']) ?>" class="btn btn-primary">
            ➕ Thêm hồ sơ bệnh án mới
        </a>
    </div>

    <!-- Hồ sơ bệnh án -->
    <h4 class="text-secondary mb-3">🗂 Hồ sơ bệnh án</h4>
    <?php if (!empty($hosos)): ?>
        <?php foreach ($hosos as $hs): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-header fw-bold">
                    Mã HS: <?= htmlspecialchars($hs['MaHS']) ?>
                </div>
                <div class="card-body">
                    <p><strong>Chẩn đoán ban đầu:</strong> <?= htmlspecialchars($hs['ChanDoanBanDau']) ?></p>
                    <p><strong>Ngày tạo:</strong> <?= htmlspecialchars($hs['NgayTaoHS']) ?></p>
                    <p><strong>Trạng thái nhập viện:</strong> <?= htmlspecialchars($hs['TinhTrangNhapVien']) ?></p>
                    <p><strong>Ngày nhập viện:</strong> <?= htmlspecialchars($hs['NgayNhapVien']) ?></p>
                    <p><strong>Ngày ra viện:</strong> <?= htmlspecialchars($hs['NgayRaVien']) ?></p>

                    <?php if (!empty($hs['KetQuaKham'])): ?>
                        <hr>
                        <h5 class="text-success">📋 Kết quả khám</h5>
                        <p><strong>Triệu chứng:</strong> <?= htmlspecialchars($hs['KetQuaKham']['TrieuChung']) ?></p>
                        <p><strong>Chẩn đoán:</strong> <?= htmlspecialchars($hs['KetQuaKham']['ChanDoan']) ?></p>
                        <p><strong>Ghi chú:</strong> <?= htmlspecialchars($hs['KetQuaKham']['GhiChu']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-secondary">Chưa có hồ sơ bệnh án nào.</div>
    <?php endif; ?>
</div>

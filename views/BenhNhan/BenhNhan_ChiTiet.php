<h3>Thông tin bệnh nhân</h3>
<ul>
    <li><strong>Mã BN:</strong> <?= $patient['MaBN'] ?></li>
    <li><strong>Họ tên:</strong> <?= $patient['HoTenBN'] ?></li>
    <li><strong>Ngày sinh:</strong> <?= $patient['NgaySinhBN'] ?></li>
    <li><strong>Giới tính:</strong> <?= $patient['GioiTinhBN'] ?></li>
    <li><strong>Email:</strong> <?= $patient['EmailBN'] ?></li>
    <li><strong>Địa chỉ:</strong> <?= $patient['DiaChiBN'] ?></li>
    <li><strong>Mã BHYT:</strong> <?= $patient['MaBHYT'] ?></li>
</ul>

<!-- Nút Thêm hồ sơ -->
<div class="text-end mb-3">
    <a href="index.php?controller=hoso&action=them&maBN=<?= $patient['MaBN'] ?>" class="btn btn-primary">
        ➕ Thêm hồ sơ bệnh án mới
    </a>
</div>

<h4>Hồ sơ bệnh án</h4>
<?php if (!empty($hosos)): ?>
    <?php foreach ($hosos as $hs): ?>
        <div class="card mb-3">
            <div class="card-header">🗂 Mã HS: <?= $hs['MaHS'] ?></div>
            <div class="card-body">
                <p><strong>Chẩn đoán ban đầu:</strong> <?= $hs['ChanDoanBanDau'] ?></p>
                <p><strong>Ngày tạo:</strong> <?= $hs['NgayTaoHS'] ?></p>
                <p><strong>Trạng thái nhập viện:</strong> <?= $hs['TinhTrangNhapVien'] ?></p>
                <p><strong>Ngày nhập viện:</strong> <?= $hs['NgayNhapVien'] ?></p>
                <p><strong>Ngày ra viện:</strong> <?= $hs['NgayRaVien'] ?></p>

                <?php if (!empty($hs['KetQuaKham'])): ?>
                    <hr>
                    <h5>Kết quả khám:</h5>
                    <p><strong>Triệu chứng:</strong> <?= $hs['KetQuaKham']['TrieuChung'] ?></p>
                    <p><strong>Chẩn đoán:</strong> <?= $hs['KetQuaKham']['ChanDoan'] ?></p>
                    <p><strong>Ghi chú:</strong> <?= $hs['KetQuaKham']['GhiChu'] ?></p>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach ?>
<?php else: ?>
    <div class="alert alert-secondary">Chưa có hồ sơ bệnh án nào.</div>
<?php endif ?>

<?php if (!empty($patients)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã BN</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Điện thoại / Email</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $bn): ?>
                <tr>
                    <td><?= htmlspecialchars($bn['MaBN']) ?></td>
                    <td><?= htmlspecialchars($bn['HoTenBN']) ?></td>
                    <td><?= htmlspecialchars($bn['NgaySinhBN']) ?></td>
                    <td><?= htmlspecialchars($bn['GioiTinhBN']) ?></td>
                    <td><?= htmlspecialchars($bn['EmailBN']) ?></td>
                    <td>
                        <a href="index.php?controller=benhnhan&action=chitiet&id=<?= $bn['MaBN'] ?>" class="btn btn-sm btn-info">
                            Xem
                        </a>
                        <a href="index.php?controller=hoso&action=them&maBN=<?= $bn['MaBN'] ?>" class="btn btn-sm btn-info">
                            Thêm bệnh án
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-warning">Không tìm thấy bệnh nhân nào phù hợp.</div>
<?php endif ?>

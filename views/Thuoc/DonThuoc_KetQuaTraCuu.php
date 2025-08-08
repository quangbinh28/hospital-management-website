<?php if (!empty($donThuocList)): ?>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Mã đơn thuốc</th>
                <th>Tên bệnh nhân</th>
                <th>Ngày lập</th>
                <th>Tình trạng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donThuocList as $dt): ?>
                <tr>
                    <td><?= htmlspecialchars($dt['MaDT']) ?></td>
                    <td><?= htmlspecialchars($dt['TenBN']) ?></td>
                    <td><?= htmlspecialchars($dt['NgayLap']) ?></td>
                    <td><?= htmlspecialchars($dt['TinhTrang']) ?></td>
                    <td>
                        <a href="index.php?controller=donthuoc&action=chitiet&maDT=<?= urlencode($dt['MaDT']) ?>" 
                           class="btn btn-sm btn-info">📄 Xem</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-warning">Không tìm thấy đơn thuốc nào.</div>
<?php endif; ?>

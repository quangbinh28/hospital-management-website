<h2 class="text-primary mb-4">📄 Chi tiết đơn thuốc</h2>

<p><strong>Mã đơn thuốc:</strong> <?= htmlspecialchars($donThuoc['MaDT']) ?></p>
<p><strong>Tên bệnh nhân:</strong> <?= htmlspecialchars($donThuoc['TenBN']) ?></p>
<p><strong>Ngày lập:</strong> <?= htmlspecialchars($donThuoc['NgayLap']) ?></p>
<p><strong>Tình trạng:</strong> <?= htmlspecialchars($donThuoc['TinhTrang']) ?></p>

<h5 class="mt-4">Danh sách thuốc</h5>
<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Tên thuốc</th>
            <th>Số lượng</th>
            <th>Liều lượng</th>
            <th>Chỉ định</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($donThuoc['Thuoc'] as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t['TenThuoc']) ?></td>
                <td><?= htmlspecialchars($t['SoLuong']) ?></td>
                <td><?= htmlspecialchars($t['LieuLuong']) ?></td>
                <td><?= htmlspecialchars($t['ChiDinh']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?controller=donthuoc&action=tracuupage" class="btn btn-secondary">⬅ Quay lại</a>

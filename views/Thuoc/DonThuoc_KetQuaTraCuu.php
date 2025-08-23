<?php if (!empty($donThuocList)): ?>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <strong>Tổng số bản ghi:</strong> <?= $totalRecords ?? count($donThuocList) ?>  
        </div>
        <div>
            <strong>Trang:</strong> <?= $currentPage ?? 1 ?>/<?= $totalPages ?? 1 ?>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Mã bác sĩ</th>
                <th>Mã bệnh nhân</th>
                <th>Ghi chú</th>
                <th>Ngày cấp</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donThuocList as $dt): ?>
                <tr>
                    <td><?= htmlspecialchars($dt['maBacSi'] ?? '') ?></td>
                    <td><?= htmlspecialchars($dt['maBenhNhan'] ?? '') ?></td>
                    <td><?= htmlspecialchars($dt['ghiChu'] ?? '') ?></td>
                    <td><?= htmlspecialchars($dt['ngayCap'] ?? '') ?></td>
                    <td>
                        <a href="index.php?controller=donthuoc&action=chitiet&maDT=<?= urlencode($dt['MaDT'] ?? '') ?>" 
                           class="btn btn-sm btn-info">📄 Xem</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- PHÂN TRANG -->
    <?php if (!empty($totalPages) && $totalPages > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">
                <!-- Nút Prev -->
                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a href="#" class="page-link page-btn" data-page="<?= $currentPage - 1 ?>">«</a>
                    </li>
                <?php endif; ?>

                <!-- Các số trang -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                        <a href="#" class="page-link page-btn" data-page="<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <!-- Nút Next -->
                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a href="#" class="page-link page-btn" data-page="<?= $currentPage + 1 ?>">»</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-warning">Không tìm thấy đơn thuốc nào.</div>
<?php endif; ?>

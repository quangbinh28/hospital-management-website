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
                <th>Mã đơn thuốc</th>
                <th>Mã bác sĩ</th>
                <th>Mã bệnh nhân</th>
                <th>Ghi chú</th>
                <th>Tình trạng</th>
                <th>Ngày cấp</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donThuocList as $dt): ?>
                <tr>
                    <td><?= htmlspecialchars($dt['maDonThuoc'] ?? '') ?></td>
                    <td><?= htmlspecialchars($dt['maBacSi'] ?? '') ?></td>
                    <td><?= htmlspecialchars($dt['maBenhNhan'] ?? '') ?></td>
                    <td><?= htmlspecialchars($dt['ghiChu'] ?? '') ?></td>
                    <td><?= htmlspecialchars($dt['tinhTrang'] ?? '') ?></td>
                    <td><?= htmlspecialchars($dt['ngayCap'] ?? '') ?></td>
                    <td>
                        <!-- Luôn có nút xem -->
                        <a href="index.php?controller=donthuoc&action=chitiet&maDT=<?= urlencode($dt['maDonThuoc'] ?? '') ?>" 
                           class="btn btn-sm btn-info mb-1">📄 Xem</a>

                        <!-- Nếu là dược sĩ thì hiện thêm nút -->
                        <?php if (!empty($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'DUOCSI'): ?>
                            <a href="index.php?controller=donthuoc&action=sansang&maDT=<?= urlencode($dt['maDonThuoc']) ?>&status=sansang" 
                               class="btn btn-sm btn-success mb-1">✅ Sẵn sàng</a>

                            <a href="index.php?controller=donthuoc&action=dalay&maDT=<?= urlencode($dt['maDonThuoc']) ?>&status=dalay" 
                               class="btn btn-sm btn-warning mb-1">📦 Đã gửi</a>
                        <?php endif; ?>
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

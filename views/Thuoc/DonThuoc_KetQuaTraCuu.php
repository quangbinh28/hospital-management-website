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
                        <a href="index.php?controller=donthuoc&action=chitiet&maDT=<?= urlencode($dt['maDonThuoc'] ?? '') ?>" 
                           class="btn btn-sm btn-info mb-1">📄 Xem</a>

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

    <!-- PHÂN TRANG THÔNG MINH -->
    <?php if (!empty($totalPages) && $totalPages > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">

                <!-- Nút Prev -->
                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a href="#" class="page-link page-btn" data-page="<?= $currentPage - 1 ?>">«</a>
                    </li>
                <?php endif; ?>

                <?php
                $range = 2; // số trang hiển thị trước và sau trang hiện tại
                $start = max(1, $currentPage - $range);
                $end = min($totalPages, $currentPage + $range);

                // Trang đầu
                if ($start > 1) {
                    echo '<li class="page-item"><a href="#" class="page-link page-btn" data-page="1">1</a></li>';
                    if ($start > 2) {
                        echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
                    }
                }

                // Các trang chính giữa
                for ($i = $start; $i <= $end; $i++): ?>
                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                        <a href="#" class="page-link page-btn" data-page="<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php
                if ($end < $totalPages) {
                    if ($end < $totalPages - 1) {
                        echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
                    }
                    echo '<li class="page-item"><a href="#" class="page-link page-btn" data-page="' . $totalPages . '">' . $totalPages . '</a></li>';
                }
                ?>

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

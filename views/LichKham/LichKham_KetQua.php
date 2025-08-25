<?php if (!empty($dsLichKham)): ?>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <strong>Tổng số bản ghi:</strong> <?= $totalRecords ?? count($dsLichKham) ?>  
        </div>
        <div>
            <strong>Trang:</strong> <?= $currentPage ?? 1 ?>/<?= $totalPages ?? 1 ?>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Mã lịch</th>
                <th>Bệnh nhân</th>
                <th>Bác sĩ</th>
                <th>Ngày</th>
                <th>Giờ</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dsLichKham as $lich): ?>
                <tr id="row-<?= htmlspecialchars($lich['maLichKham']) ?>">
                    <td><?= htmlspecialchars($lich['maLichKham'] ?? '') ?></td>
                    <td><?= htmlspecialchars($lich['tenBenhNhan'] ?? '') ?></td>
                    <td><?= htmlspecialchars($lich['bacSi'] ?? '') ?></td>
                    <td><?= htmlspecialchars($lich['ngayKham'] ?? '') ?></td>
                    <td><?= htmlspecialchars($lich['gioKham'] ?? '') ?></td>
                    <td class="status"><?= htmlspecialchars($lich['tinhTrang'] ?? '') ?></td>
                    <td>
                        <!-- Ẩn mã bệnh nhân -->
                        <input type="hidden" name="maBenhNhan" value="<?= htmlspecialchars($lich['maBenhNhan'] ?? '') ?>">

                        <?php if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'TIEPTAN'): ?>
                            <a href="index.php?controller=lichkham&action=xacnhanlich&maLich=<?= urlencode($lich['maLichKham']) ?>&status=xacnhan" 
                               class="btn btn-sm btn-success mb-1">✅ Xác nhận</a>

                            <a href="index.php?controller=lichkham&action=huylich&maLich=<?= urlencode($lich['maLichKham']) ?>&status=huy" 
                               class="btn btn-sm btn-danger mb-1">❌ Hủy</a>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'BACSI'): ?>
                            <a href="index.php?controller=donthuoc&action=taoPage&maBN=<?= urlencode($lich['maBenhNhan'] ?? '') ?>" 
                               class="btn btn-sm btn-primary mb-1">💊 Tạo đơn thuốc</a>
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
    <div class="alert alert-secondary">Không có lịch khám phù hợp</div>
<?php endif; ?>

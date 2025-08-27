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
                    <td><?= htmlspecialchars($lich['tenBacSi'] ?? '') ?></td>
                    <td><?= htmlspecialchars($lich['ngayKham'] ?? '') ?></td>
                    <td><?= htmlspecialchars($lich['gioKham'] ?? '') ?></td>
                    <td class="status"><?= htmlspecialchars($lich['tinhTrang'] ?? '') ?></td>
                    <td>
                        <input type="hidden" name="maBenhNhan" value="<?= htmlspecialchars($lich['maBenhNhan'] ?? '') ?>">

                        <?php if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'TIEPTAN'): ?>
                            <a href="index.php?controller=lichkham&action=xacnhanlich&maLich=<?= urlencode($lich['maLichKham']) ?>&status=xacnhan" 
                               class="btn btn-sm btn-success mb-1">✅ Xác nhận</a>

                            <a href="index.php?controller=lichkham&action=huylich&maLich=<?= urlencode($lich['maLichKham']) ?>&status=huy" 
                               class="btn btn-sm btn-danger mb-1">❌ Hủy</a>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'BACSI'): ?>
                            <a href="index.php?controller=donthuoc&action=taoPage&maBN=<?= urlencode($lich['maBenhNhan'] ?? '') ?>" 
                               class="btn btn-sm btn-primary mb-1">Tạo đơn thuốc</a>

                            <a href="index.php?controller=benhnhan&action=chitiet&id=<?= urlencode($lich['maBenhNhan'] ?? '') ?>"
                               class="btn btn-sm btn-info mb-1">Xem thông tin bệnh nhân</a>

                            <a href="index.php?controller=lichkham&action=chidinhdichvupage&maLich=<?= urlencode($lich['maLichKham'] ?? '') ?>&tenBenhNhan=<?= urlencode($lich['tenBenhNhan'] ?? '') ?> "
                               class="btn btn-sm btn-warning">Chỉ định dịch vụ</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


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

                // Hiển thị trang đầu
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
    <div class="alert alert-secondary">Không có lịch khám phù hợp</div>
<?php endif; ?>

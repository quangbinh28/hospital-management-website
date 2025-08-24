<?php if (!empty($patients)): ?>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <strong>Tổng số bản ghi:</strong> <?= $totalRecords ?? count($patients) ?>  
        </div>
        <div>
            <strong>Trang:</strong> <?= $currentPage ?? 1 ?>/<?= $totalPages ?? 1 ?>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã BN</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Điện thoại</th>
                <th>Chi tiết</th>
                <?php if (isset($_SESSION['user']['sub']) && 
                        ($_SESSION['user']['sub'] === 'TIEPTAN' || $_SESSION['user']['sub'] === 'ADMIN')): ?>
                    <th>Hành động</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $bn): ?>
                <tr>
                    <td><?= htmlspecialchars($bn['maBenhNhan'] ?? '') ?></td>
                    <td><?= htmlspecialchars($bn['hoTen'] ?? '') ?></td>
                    <td><?= htmlspecialchars($bn['ngaySinh'] ?? '') ?></td>
                    <td><?= htmlspecialchars($bn['gioiTinh'] ?? '') ?></td>
                    <td><?= htmlspecialchars($bn['soDienThoai'] ?? '') ?></td>
                    <td>
                        <a href="index.php?controller=benhnhan&action=chitiet&id=<?= urlencode($bn['maBenhNhan'] ?? '') ?>"
                           class="btn btn-sm btn-info">
                            Xem
                        </a>
                        <a href="index.php?controller=hoso&action=them&maBN=<?= urlencode($bn['maBenhNhan'] ?? '') ?>"
                           class="btn btn-sm btn-success">
                            Thêm bệnh án
                        </a>
                    </td>
                    <?php if (isset($_SESSION['user']['sub']) && 
                            ($_SESSION['user']['sub'] === 'TIEPTAN' || $_SESSION['user']['sub'] === 'ADMIN')): ?>
                        <td>
                            <a href="index.php?controller=lichkham&action=datlichpage&maBN=<?= urlencode($bn['maBenhNhan'] ?? '') ?>"
                               class="btn btn-sm btn-primary">
                               Đặt lịch khám
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- PHÂN TRANG -->
    <?php if (!empty($totalPages) && $totalPages > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a href="#" class="page-link page-btn" data-page="<?= $currentPage - 1 ?>">«</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                        <a href="#" class="page-link page-btn" data-page="<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a href="#" class="page-link page-btn" data-page="<?= $currentPage + 1 ?>">»</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-warning">
        Không tìm thấy bệnh nhân nào phù hợp.
    </div>
<?php endif ?>

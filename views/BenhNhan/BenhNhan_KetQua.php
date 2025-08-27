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

                <?php if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'BACSI'): ?>
                    <th>Chi tiết</th>
                <?php endif; ?>

                <?php if (isset($_SESSION['user']['sub']) && 
                        ($_SESSION['user']['sub'] === 'TIEPTAN' || $_SESSION['user']['sub'] === 'ADMIN')): ?>
                    <th>Hành động</th>
                <?php endif; ?>

                <?php if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'BACSI'): ?>
                    <th>Đơn thuốc</th>
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

                    <?php if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'BACSI'): ?>
                        <td>
                            <a href="index.php?controller=benhnhan&action=chitiet&id=<?= urlencode($bn['maBenhNhan'] ?? '') ?>"
                               class="btn btn-sm btn-info">Xem</a>
                            <a href="index.php?controller=hoso&action=them&maBN=<?= urlencode($bn['maBenhNhan'] ?? '') ?>"
                               class="btn btn-sm btn-success">Thêm bệnh án</a>
                        </td>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user']['sub']) && 
                            ($_SESSION['user']['sub'] === 'TIEPTAN' || $_SESSION['user']['sub'] === 'ADMIN')): ?>
                        <td>
                            <a href="index.php?controller=lichkham&action=datlichpage&maBN=<?= urlencode($bn['maBenhNhan'] ?? '') ?>"
                               class="btn btn-sm btn-primary">Đặt lịch khám</a>
                        </td>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user']['sub']) && $_SESSION['user']['sub'] === 'BACSI'): ?>
                        <td>
                            <a href="index.php?controller=donthuoc&action=taopage&maBN=<?= urlencode($bn['maBenhNhan'] ?? '') ?>"
                               class="btn btn-sm btn-warning">Tạo đơn thuốc</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach ?>
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
    <div class="alert alert-warning">
        Không tìm thấy bệnh nhân nào phù hợp.
    </div>
<?php endif; ?>

<div class="container mt-4">
    <h2 class="text-primary mb-4">📅 Danh sách lịch khám đã xác nhận</h2>

    <!-- Form lọc -->
    <form method="POST" action="?controller=lichkham&action=xem" class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label for="tu_ngay" class="form-label">Từ ngày:</label>
            <input type="date" name="tu_ngay" id="tu_ngay" 
                   value="<?= htmlspecialchars($_POST['tu_ngay'] ?? '') ?>" 
                   class="form-control">
        </div>
        <div class="col-md-3">
            <label for="den_ngay" class="form-label">Đến ngày:</label>
            <input type="date" name="den_ngay" id="den_ngay" 
                   value="<?= htmlspecialchars($_POST['den_ngay'] ?? '') ?>" 
                   class="form-control">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">
                🔍 Lọc
            </button>
        </div>
    </form>

    <!-- Bảng lịch khám -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Ngày khám</th>
                    <th>Giờ khám</th>
                    <th>Bác sĩ</th>
                    <th>Phòng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lichKham)): ?>
                    <?php foreach ($lichKham as $lk): ?>
                        <tr>
                            <td><?= htmlspecialchars($lk['NgayKham']) ?></td>
                            <td><?= htmlspecialchars($lk['GioKham']) ?></td>
                            <td><?= htmlspecialchars($lk['BacSi']) ?></td>
                            <td><?= htmlspecialchars($lk['Phong']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">Không có lịch khám nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

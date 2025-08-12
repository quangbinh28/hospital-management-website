<!-- views/LichKham/XacNhan.php -->
<div class="container mt-4">
    <h2 class="mb-4 text-primary">📋 Xác nhận lịch khám</h2>

    <!-- Form lọc theo ngày -->
    <form method="GET" action="" class="row g-2 align-items-center mb-3">
        <input type="hidden" name="controller" value="lichkham">
        <input type="hidden" name="action" value="xacnhanpage">

        <div class="col-auto">
            <label for="ngay" class="form-label mb-0">Chọn ngày:</label>
        </div>
        <div class="col-auto">
            <input type="date" name="ngay" id="ngay" 
                   value="<?= htmlspecialchars($_GET['ngay'] ?? '') ?>" 
                   class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">🔍 Lọc</button>
        </div>
    </form>

    <hr>

    <!-- Danh sách lịch khám chưa xác nhận -->
    <?php if (!empty($dsLichKham)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã lịch</th>
                        <th>Bệnh nhân</th>
                        <th>Bác sĩ</th>
                        <th>Ngày</th>
                        <th>Giờ</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dsLichKham as $lich) : ?>
                        <tr id="row-<?= htmlspecialchars($lich['maLichKham']) ?>">
                            <td><?= htmlspecialchars($lich['maLichKham']) ?></td>
                            <td><?= htmlspecialchars($lich['tenBenhNhan']) ?></td>
                            <td><?= htmlspecialchars($lich['bacSi']) ?></td>
                            <td><?= htmlspecialchars($lich['ngayKham']) ?></td>
                            <td><?= htmlspecialchars($lich['gioKham']) ?></td>
                            <td class="status"><?= htmlspecialchars($lich['trangThai']) ?></td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm btn-xacnhan" data-id="<?= htmlspecialchars($lich['maLichKham']) ?>">Xác nhận</button>
                                <button class="btn btn-danger btn-sm btn-huy" data-id="<?= htmlspecialchars($lich['maLichKham']) ?>">Hủy</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-secondary">Không có lịch khám nào cần xác nhận.</div>
    <?php endif; ?>
</div>

<!-- Script xử lý xác nhận và hủy -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Xác nhận
    document.querySelectorAll('.btn-xacnhan').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let maLich = this.dataset.id;
            fetch('index.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    controller: 'lichkham',
                    action: 'xacnhanlich',
                    maLich: maLich
                })
            })
            .then(res => res.text())
            .then(() => {
                let row = document.querySelector(`#row-${maLich} .status`);
                row.innerText = 'Đã xác nhận';
                row.classList.add('text-success', 'fw-bold');
            });
        });
    });

    // Hủy
    document.querySelectorAll('.btn-huy').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (!confirm('Bạn có chắc muốn hủy lịch này?')) return;
            let maLich = this.dataset.id;
            fetch('index.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    controller: 'lichkham',
                    action: 'huylich',
                    maLich: maLich
                })
            })
            .then(res => res.text())
            .then(() => {
                document.querySelector(`#row-${maLich}`).remove();
            });
        });
    });
});
</script>

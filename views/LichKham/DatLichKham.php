<div class="container my-4" style="max-width: 700px;">
    <h2 class="text-primary mb-4">📅 Đặt lịch khám</h2>

    <?php if (!empty($thongBao)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($thongBao) ?></div>
    <?php endif; ?>

    <form id="formDatLich" method="post" action="index.php?controller=LichKham&action=datLichKham" class="p-4 border rounded shadow-sm bg-light">
        
        <!-- Chuyên khoa -->
        <div class="mb-3">
            <label for="maKhoa" class="form-label">Chuyên khoa</label>
            <select class="form-select" id="maKhoa" name="maKhoa" required>
                <option value="">-- Chọn chuyên khoa --</option>
                <?php foreach ($chuyenKhoaList as $ck): ?>
                    <option value="<?= $ck['MaKhoa'] ?>"><?= htmlspecialchars($ck['TenKhoa']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Bác sĩ -->
        <div class="mb-3">
            <label class="form-label">Bác sĩ</label>
            <div id="comboBacSi">
                <select class="form-select" name="maBS" required>
                    <option value="">-- Chọn bác sĩ --</option>
                </select>
            </div>
        </div>

        <!-- Ca khám -->
        <div class="mb-3">
            <label class="form-label">Ca khám</label>
            <div id="danhSachCa">
                <select class="form-select" name="gio" required>
                    <option value="">-- Chọn ngày giờ --</option>
                </select>
            </div>
        </div>

        <!-- Nút đặt lịch -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">✅ Đặt lịch khám</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const maKhoaSelect = document.getElementById('maKhoa');
    const comboBacSiDiv = document.getElementById('comboBacSi');
    const danhSachCaDiv = document.getElementById('danhSachCa');

    maKhoaSelect.addEventListener('change', () => {
        fetch('index.php?controller=LichKham&action=layBacSiTheoKhoa', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'maKhoa=' + encodeURIComponent(maKhoaSelect.value)
        })
        .then(res => res.text())
        .then(html => {
            comboBacSiDiv.innerHTML = html;
            comboBacSiDiv.querySelector('select').addEventListener('change', loadCaKham);
        });
    });

    function loadCaKham() {
        fetch('index.php?controller=LichKham&action=layCaKhamTheoBacSi', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'maBS=' + encodeURIComponent(this.value)
        })
        .then(res => res.text())
        .then(html => {
            danhSachCaDiv.innerHTML = html;
        });
    }
});
</script>

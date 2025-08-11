<div class="container mt-4">
    <h2 class="mb-4 text-primary">📅 Đặt Lịch Khám</h2>

    <form method="post" action="index.php?controller=lichkham&action=dat" class="border p-4 rounded shadow-sm bg-light">
        
        <!-- Chuyên khoa -->
        <div class="mb-3">
            <label for="chuyen_khoa" class="form-label">Chuyên khoa</label>
            <select name="chuyen_khoa" id="chuyen_khoa" class="form-select" required>
                <option value="">-- Chọn chuyên khoa --</option>
                <?php foreach ($dsChuyenKhoa as $ck): ?>
                    <option value="<?= htmlspecialchars($ck['id']) ?>">
                        <?= htmlspecialchars($ck['ten_chuyen_khoa']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Bác sĩ -->
        <div class="mb-3">
            <label for="bac_si" class="form-label">Bác sĩ</label>
            <select name="bac_si" id="bac_si" class="form-select" required>
                <option value="">-- Chọn bác sĩ --</option>
            </select>
        </div>

        <!-- Ngày khám -->
        <div class="mb-3">
            <label for="ngay_kham" class="form-label">Ngày khám</label>
            <select name="ngay_kham" id="ngay_kham" class="form-select" required>
                <option value="">-- Chọn ngày --</option>
            </select>
        </div>

        <!-- Giờ khám -->
        <div class="mb-3">
            <label for="gio_kham" class="form-label">Giờ khám</label>
            <select name="gio_kham" id="gio_kham" class="form-select" required>
                <option value="">-- Chọn giờ --</option>
            </select>
        </div>

        <!-- Nguyên nhân -->
        <div class="mb-3">
            <label for="nguyen_nhan" class="form-label">Nguyên nhân khám</label>
            <textarea name="nguyen_nhan" id="nguyen_nhan" rows="3" 
                      class="form-control" placeholder="Nhập lý do bạn muốn khám..." required></textarea>
        </div>

        <!-- Nút -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">💾 Đặt lịch khám</button>
        </div>
    </form>
</div>

<!-- Script load danh sách bác sĩ và lịch -->
<script>
document.getElementById('chuyen_khoa').addEventListener('change', function () {
    let idCK = this.value;
    let bacSiSelect = document.getElementById('bac_si');
    bacSiSelect.innerHTML = '<option value="">-- Đang tải bác sĩ --</option>';

    fetch('index.php?controller=lichkham&action=layBacSiTheoChuyenKhoa&id=' + idCK)
        .then(response => response.json())
        .then(data => {
            bacSiSelect.innerHTML = '<option value="">-- Chọn bác sĩ --</option>';
            data.forEach(bacSi => {
                bacSiSelect.innerHTML += `<option value="${bacSi.id}">${bacSi.ho_ten}</option>`;
            });
        });
});

document.getElementById('bac_si').addEventListener('change', function () {
    let idBS = this.value;

    fetch('index.php?controller=lichkham&action=layLichBacSi&id=' + idBS)
        .then(response => response.json())
        .then(data => {
            let ngaySelect = document.getElementById('ngay_kham');
            let gioSelect = document.getElementById('gio_kham');

            ngaySelect.innerHTML = '<option value="">-- Chọn ngày --</option>';
            gioSelect.innerHTML = '<option value="">-- Chọn giờ --</option>';

            data.ngay.forEach(ngay => {
                ngaySelect.innerHTML += `<option value="${ngay}">${ngay}</option>`;
            });
            data.gio.forEach(gio => {
                gioSelect.innerHTML += `<option value="${gio}">${gio}</option>`;
            });
        });
});
</script>

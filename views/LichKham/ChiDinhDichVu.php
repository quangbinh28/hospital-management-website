<div class="container mt-4">
    <h2 class="mb-4 text-primary">🩺 Chỉ Định Dịch Vụ</h2>

    <form method="post" action="index.php?controller=lichkham&action=chidinhdichvu" 
          class="border p-4 rounded shadow-sm bg-light">

        <!-- Tên bệnh nhân (chỉ hiển thị, không submit) -->
        <div class="mb-3">
            <label class="form-label">Tên bệnh nhân</label>
            <input type="text"  name="tenBenhNhan" class="form-control" 
                   value="<?= htmlspecialchars($tenBN) ?>" readonly>
        </div>

        <!-- Mã lịch khám -->
        <div class="mb-3">
            <label for="maLichKham" class="form-label">Mã lịch khám</label>
            <input type="text" name="maLichKham" id="maLichKham" 
                   class="form-control" value="<?= htmlspecialchars($maLichKham) ?>" readonly>
        </div>

        <!-- Dịch vụ -->
        <div class="mb-3">
            <label for="dichVu" class="form-label">Dịch vụ</label>
            <select name="dichVu" id="dichVu" class="form-select" required>
                <option value="">-- Chọn dịch vụ --</option>
                <?php foreach ($dsDichVu as $dv): ?>
                    <option value="<?= htmlspecialchars($dv['maDichVu']) ?>" 
                            data-phong="<?= htmlspecialchars($dv['soPhong'] ?? '') ?>">
                        <?= htmlspecialchars($dv['tenDichVu']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Phòng (readonly) -->
        <div class="mb-3">
            <label for="phong" class="form-label">Phòng</label>
            <input type="text" name="phong" id="phong" 
                   class="form-control" readonly placeholder="Sẽ tự động hiển thị">
        </div>

        <!-- Ghi chú -->
        <div class="mb-3">
            <label for="ghiChu" class="form-label">Ghi chú</label>
            <textarea name="ghiChu" id="ghiChu" rows="3" 
                      class="form-control" placeholder="Nhập thêm ghi chú nếu cần..."></textarea>
        </div>

        <!-- Nút -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">💾 Lưu chỉ định</button>
        </div>
    </form>
</div>

<script>
const dichVuSelect = document.getElementById('dichVu');
const phongInput   = document.getElementById('phong');

// Khi chọn dịch vụ thì hiển thị phòng
dichVuSelect.addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    phongInput.value = selected.getAttribute('data-phong') || 'Chưa có phòng';
});
</script>

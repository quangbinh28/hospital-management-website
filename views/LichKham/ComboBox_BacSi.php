<select class="form-control" name="maBS" required>
    <option value="">-- Chọn bác sĩ --</option>
    <?php foreach ($bacSiList as $bs): ?>
        <option value="<?= $bs['MaNV'] ?>">
            <?= htmlspecialchars($bs['HoTenNV']) ?>
        </option>
    <?php endforeach; ?>
</select>
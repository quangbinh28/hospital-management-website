<select class="form-control" name="maBS" required>
    <option value="">-- Chọn bác sĩ --</option>
    <?php foreach ($bacSiList as $bs): ?>
        <option value="<?= $bs['maNV'] ?>">
            <?= htmlspecialchars($bs['hoTen']) ?>
        </option>
    <?php endforeach; ?>
</select>
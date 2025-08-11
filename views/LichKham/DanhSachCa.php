<select class="form-control" name="gio" required>
    <option value="">-- Chọn ngày giờ --</option>
    <?php foreach ($caList as $ca): ?>
        <option value="<?= $ca['NgayKham'] . ' ' . $ca['GioKham'] ?>">
            <?= htmlspecialchars($ca['NgayKham']) ?> - <?= htmlspecialchars($ca['GioKham']) ?>
        </option>
    <?php endforeach; ?>
</select>

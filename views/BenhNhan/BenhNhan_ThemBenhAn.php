<div class="container my-4" style="max-width: 900px;">
    <h2 class="mb-4 text-primary">➕ Thêm hồ sơ bệnh án mới</h2>

    <!-- Thông tin bệnh nhân -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">🧍‍♂️ Thông tin bệnh nhân</div>
        <div class="card-body row">
            <div class="col-md-4"><strong>Mã BN:</strong> <?= htmlspecialchars($benhNhan['MaBN']) ?></div>
            <div class="col-md-4"><strong>Họ tên:</strong> <?= htmlspecialchars($benhNhan['HoTenBN']) ?></div>
            <div class="col-md-4"><strong>Ngày sinh:</strong> <?= htmlspecialchars($benhNhan['NgaySinhBN']) ?></div>
            <div class="col-md-4"><strong>Giới tính:</strong> <?= $benhNhan['GioiTinhBN'] == 'M' ? 'Nam' : 'Nữ' ?></div>
            <div class="col-md-8"><strong>Địa chỉ:</strong> <?= htmlspecialchars($benhNhan['DiaChi']) ?></div>
        </div>
    </div>

    <!-- Form thêm hồ sơ -->
    <form action="index.php?controller=hoso&action=luu" method="post" class="row g-3">
        <input type="hidden" name="ma_bn" value="<?= $benhNhan['MaBN'] ?>">

        <div class="col-md-6">
            <label class="form-label">Chẩn đoán ban đầu:</label>
            <input type="text" class="form-control" name="ChanDoanBanDau" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Triệu chứng:</label>
            <input type="text" class="form-control" name="TrieuChung" required>
        </div>
        
        <div class="col-12">
            <label class="form-label">Ghi chú điều trị:</label>
            <textarea name="GhiChu" rows="3" class="form-control"></textarea>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">💾 Thêm hồ sơ</button>
            <a href="index.php?controller=benhnhan&action=chitiet&id=<?= $benhNhan['MaBN'] ?>" class="btn btn-secondary">↩️ Quay lại</a>
        </div>
    </form>
</div>

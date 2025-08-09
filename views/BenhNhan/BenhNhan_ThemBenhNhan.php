<div class="container my-4" style="max-width: 800px;">
    <h2 class="text-primary mb-4">➕ Thêm bệnh nhân mới</h2>

    <form action="index.php?controller=benhnhan&action=them" method="POST" 
          class="border p-4 rounded shadow-sm bg-light">

        <div class="mb-3">
            <label for="HoTenBN" class="form-label">Họ và tên:</label>
            <input type="text" name="HoTenBN" id="HoTenBN" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="NgaySinhBN" class="form-label">Ngày sinh:</label>
            <input type="date" name="NgaySinhBN" id="NgaySinhBN" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="EmailBN" class="form-label">Email:</label>
            <input type="email" name="EmailBN" id="EmailBN" class="form-control">
        </div>

        <div class="mb-3">
            <label for="DiaChiBN" class="form-label">Địa chỉ:</label>
            <textarea name="DiaChiBN" id="DiaChiBN" rows="2" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="GioiTinhBN" class="form-label">Giới tính:</label>
            <select name="GioiTinhBN" id="GioiTinhBN" class="form-select" required>
                <option value="">-- Chọn giới tính --</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="MaBHYT" class="form-label">Mã BHYT:</label>
            <input type="text" name="MaBHYT" id="MaBHYT" class="form-control">
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">💾 Lưu bệnh nhân</button>
            <a href="/benhnhan" class="btn btn-secondary">❌ Hủy</a>
        </div>
    </form>
</div>

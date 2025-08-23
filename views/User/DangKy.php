<h2 class="text-center mb-4">Đăng ký</h2>
<div class="d-flex justify-content-center">
    <form method="post" action="index.php?controller=auth&action=register" style="width: 400px;">
        <!-- Email -->
        <div class="mb-3">
            <label for="EmailBN" class="form-label">Email:</label>
            <div class="input-group">
                <input type="email" name="EmailBN" id="EmailBN" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary">Xác nhận</button>
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="Password" class="form-label">Mật khẩu:</label>
            <input type="password" name="Password" id="Password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ConfirmPassword" class="form-label">Nhập lại mật khẩu:</label>
            <input type="password" name="ConfirmPassword" id="ConfirmPassword" class="form-control" required>
        </div>

        <!-- Họ và tên -->
        <div class="mb-3">
            <label for="HoTenBN" class="form-label">Họ và tên:</label>
            <input type="text" name="HoTenBN" id="HoTenBN" class="form-control" required>
        </div>

        <!-- Ngày sinh -->
        <div class="mb-3">
            <label for="NgaySinhBN" class="form-label">Ngày sinh:</label>
            <input type="date" name="NgaySinhBN" id="NgaySinhBN" class="form-control" required>
        </div>

        <!-- Mã BHYT -->
        <div class="mb-3">
            <label for="MaBHYT" class="form-label">Mã BHYT:</label>
            <input type="text" name="MaBHYT" id="MaBHYT" class="form-control">
        </div>

        <!-- Địa chỉ -->
        <div class="mb-3">
            <label for="DiaChiBN" class="form-label">Địa chỉ:</label>
            <textarea name="DiaChiBN" id="DiaChiBN" rows="2" class="form-control"></textarea>
        </div>

        <!-- Giới tính -->
        <div class="mb-3">
            <label for="GioiTinhBN" class="form-label">Giới tính:</label>
            <select name="GioiTinhBN" id="GioiTinhBN" class="form-select" required>
                <option value="">-- Chọn giới tính --</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-primary w-100 mb-2">Đăng ký</button>
        <a href="index.php?controller=auth&action=loginpage" class="btn btn-secondary w-100">Quay lại đăng nhập</a>
    </form>
</div>

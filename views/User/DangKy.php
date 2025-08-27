<h2 class="text-center mb-4">Đăng ký</h2>
<div class="d-flex justify-content-center">
    <form method="post" action="index.php?controller=auth&action=register" style="width: 400px;">
        
        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <div class="input-group">
                <input type="email" name="email" id="email" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" onclick="sendOtp()">Lấy mã OTP</button>
            </div>
        </div>

        <!-- OTP -->
        <div class="mb-3" id="otpSection" style="display:none;">
            <label for="otp" class="form-label">Mã OTP:</label>
            <div class="input-group">
                <input type="text" id="otp" class="form-control" placeholder="Nhập mã OTP">
                <button type="button" class="btn btn-outline-success" onclick="verifyOtp()">Xác nhận</button>
            </div>
        </div>

        <!-- Thông tin đăng ký (ẩn trước khi xác thực OTP) -->
        <div id="registerSection" style="display:none;">
            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Nhập lại mật khẩu:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
            </div>

            <!-- Họ và tên -->
            <div class="mb-3">
                <label for="hoTen" class="form-label">Họ và tên:</label>
                <input type="text" name="hoTen" id="hoTen" class="form-control" required>
            </div>

            <!-- Số điện thoại -->
            <div class="mb-3">
                <label for="soDT" class="form-label">Số điện thoại:</label>
                <input type="tel" name="soDT" id="soDT" class="form-control" pattern="[0-9]{9,11}" placeholder="Nhập số điện thoại" required>
            </div>

            <!-- Ngày sinh -->
            <div class="mb-3">
                <label for="ngaySinh" class="form-label">Ngày sinh:</label>
                <input type="date" name="ngaySinh" id="ngaySinh" class="form-control" required>
            </div>

            <!-- Giới tính -->
            <div class="mb-3">
                <label for="gioiTinh" class="form-label">Giới tính:</label>
                <select name="gioiTinh" id="gioiTinh" class="form-select" required>
                    <option value="">-- Chọn giới tính --</option>
                    <option value="NAM">Nam</option>
                    <option value="NU">Nữ</option>
                </select>
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary w-100 mb-2" onclick="return checkPassword()">Đăng ký</button>
            <a href="index.php?controller=auth&action=loginpage" class="btn btn-secondary w-100">Quay lại đăng nhập</a>
        </div>
    </form>
</div>

<script>
async function sendOtp() {
    let emailValue = document.getElementById("email").value;
    if (!emailValue) {
        alert("Vui lòng nhập email trước!");
        return;
    }

    try {
        let response = await fetch(`http://localhost:8080/api/v1/register?email=${encodeURIComponent(emailValue)}`, {
            method: "POST"
        });

        let data = await response.json();

        if (data.statusCode === "200") {
            alert("✅ " + data.statusMessage);
            document.getElementById("otpSection").style.display = "block";
        } else {
            alert("❌ Lỗi: " + data.statusMessage);
        }
    } catch (err) {
        alert("Lỗi kết nối API: " + err);
    }
}

async function verifyOtp() {
    let emailValue = document.getElementById("email").value;
    let otpValue = document.getElementById("otp").value;

    if (!otpValue) {
        alert("Vui lòng nhập mã OTP!");
        return;
    }

    try {
        let response = await fetch(`http://localhost:8080/api/v1/register/verify?email=${encodeURIComponent(emailValue)}&otp=${encodeURIComponent(otpValue)}`, {
            method: "POST"
        });

        let data = await response.json();

        if (data.statusCode === "200") {
            alert("✅ " + data.statusMessage);
            document.getElementById("registerSection").style.display = "block";
        } else {
            alert("❌ OTP không hợp lệ: " + data.statusMessage);
        }
    } catch (err) {
        alert("Lỗi kết nối API: " + err);
    }
}

function checkPassword() {
    let pass = document.getElementById("password").value;
    let confirm = document.getElementById("confirmPassword").value;
    if (pass !== confirm) {
        alert("Mật khẩu xác nhận không khớp!");
        return false;
    }
    return true;
}
</script>

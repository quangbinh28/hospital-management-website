<h2 class="text-center mb-4">Login</h2>
<div class="d-flex justify-content-center">
    <form method="post" action="index.php?controller=auth&action=login" style="width: 300px;">
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu:</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-2">Đăng nhập</button>
        <a href="index.php?controller=auth&action=registerpage" class="btn btn-secondary w-100">Đăng ký</a>
    </form>
</div>

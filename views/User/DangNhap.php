<h2 class="text-center mb-4">Login</h2>
<div class="d-flex justify-content-center">
    <form method="post" action="index.php?controller=auth&action=login" style="width: 300px;">
        <div class="mb-3">
            <label class="form-label">Username:</label>
            <input type="text" name="username" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Password:</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-2">Đăng nhập</button>
    </form>
</div>

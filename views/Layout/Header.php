<!-- Header (full width, nằm trên cùng) -->
<nav class="navbar navbar-light bg-light border-bottom px-3">
  <?php if (!empty($_SESSION['IsLogined']) && $_SESSION['IsLogined'] === true): ?>
    <div class="d-flex align-items-center ms-auto">
      <span class="me-2">👨‍⚕️ Xin chào, <strong><?= htmlspecialchars($_SESSION['user']['ten']) ?></strong></span>
      <a class="btn btn-outline-danger btn-sm" href="index.php?controller=auth&action=logout">Đăng xuất</a>
    </div>
  <?php else: ?>
    <a class="btn btn-outline-primary btn-sm ms-auto" href="index.php?controller=auth&action=loginpage">Đăng nhập</a>
  <?php endif; ?>
</nav>

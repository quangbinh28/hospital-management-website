<!-- Header (full width, nằm trên cùng) -->
<nav class="navbar bg-white shadow-sm border-bottom px-4 py-2">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Logo / Tên bệnh viện -->
    <span class="fw-bold text-primary fs-5">
      🏥 Bệnh viện ABC
    </span>

    <!-- User info -->
    <?php if (!empty($_SESSION['IsLogined']) && $_SESSION['IsLogined'] === true): ?>
      <div class="d-flex align-items-center">
        <span class="me-3 text-secondary">
          👨‍⚕️ Xin chào, 
          <strong class="text-dark"><?= htmlspecialchars($_SESSION['user']['ten']) ?></strong>
        </span>
        <a class="btn btn-sm btn-outline-danger rounded-pill px-3" 
           href="index.php?controller=auth&action=logout">Đăng xuất</a>
      </div>
    <?php else: ?>
      <a class="btn btn-sm btn-outline-primary rounded-pill px-3" 
         href="index.php?controller=auth&action=loginpage">Đăng nhập</a>
    <?php endif; ?>

  </div>
</nav>

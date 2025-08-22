<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'trangchu' ? ' active' : '' ?>" 
       href="index.php?controller=trangchu&action=index">🏥 Trang chủ</a>

    <?php if (!empty($_SESSION['IsLogined']) && $_SESSION['IsLogined'] === true): ?>
      
      <?php if ($_SESSION['user']['sub'] === 'TIEPTAN'): ?>
        <!-- Quyền của TIẾP TÂN -->
        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'benhnhan' && ($_GET['action'] ?? '') === 'timkiempage' ? ' active' : '' ?>" 
          href="index.php?controller=benhnhan&action=timkiempage">🔍 Tra cứu bệnh nhân</a>

        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'benhnhan' && ($_GET['action'] ?? '') === 'thempage' ? ' active' : '' ?>" 
          href="index.php?controller=benhnhan&action=thempage">➕ Thêm bệnh nhân</a>

        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'datlichpage' ? ' active' : '' ?>" 
          href="index.php?controller=lichkham&action=datlichpage">📅 Đặt lịch khám</a>

        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'xacnhanpage' ? ' active' : '' ?>" 
          href="index.php?controller=lichkham&action=xacnhanpage">📅 Xác nhận lịch khám</a>
      <?php endif; ?>


      <?php if ($_SESSION['user']['sub'] === 'BACSI'): ?>
        <!-- Quyền của BÁC SĨ -->
        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'benhnhan' && ($_GET['action'] ?? '') === 'timkiempage' ? ' active' : '' ?>" 
          href="index.php?controller=benhnhan&action=timkiempage">🔍 Tra cứu bệnh nhân</a>

        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'donthuoc' && ($_GET['action'] ?? '') === 'taopage' ? ' active' : '' ?>" 
          href="index.php?controller=donthuoc&action=taopage">💊 Tạo đơn thuốc</a>

        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'xem' ? ' active' : '' ?>" 
          href="index.php?controller=lichkham&action=xem">📅 Xem lịch khám</a>
      <?php endif; ?>


      <?php if ($_SESSION['user']['sub'] === 'DUOCSI'): ?>
        <!-- Quyền của DƯỢC SĨ -->
        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'donthuoc' && ($_GET['action'] ?? '') === 'tracuupage' ? ' active' : '' ?>" 
          href="index.php?controller=donthuoc&action=tracuupage">📄 Tra cứu đơn thuốc</a>
      <?php endif; ?>


      <?php if ($_SESSION['user']['sub'] === 'ADMIN'): ?>
        <!-- Quyền của ADMIN -->
        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'bacsi' && ($_GET['action'] ?? '') === 'thempage' ? ' active' : '' ?>" 
          href="index.php?controller=bacsi&action=thempage">📅 Thêm bác sĩ</a>
      <?php endif; ?>


      <?php if ($_SESSION['user']['sub'] === 'BENHNHAN'): ?>
        <!-- Quyền của BỆNH NHÂN -->
        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'datlichpage' ? ' active' : '' ?>" 
          href="index.php?controller=lichkham&action=datlichpage">📅 Đặt lịch khám</a>

        <a class="nav-link<?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'xem' ? ' active' : '' ?>" 
          href="index.php?controller=lichkham&action=xem">📅 Xem lịch khám</a>
      <?php endif; ?>


      <!-- Chào user và nút đăng xuất -->
      <div class="d-flex ms-auto">
        <span class="navbar-text me-3">
          👨‍⚕️ Xin chào, <strong><?= htmlspecialchars($_SESSION['user']['sub']) ?></strong>
        </span>
        <a class="btn btn-outline-danger btn-sm" href="index.php?controller=auth&action=logout">Đăng xuất</a>
      </div>
    <?php else: ?>
      <!-- Nếu chưa đăng nhập -->
      <a class="btn btn-outline-primary btn-sm ms-auto" href="index.php?controller=auth&action=loginpage">Đăng nhập</a>
    <?php endif; ?>
  </div>
</nav>

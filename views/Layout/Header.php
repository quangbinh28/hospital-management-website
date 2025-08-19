<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'trangchu' ? ' active' : '' ?>" 
       href="index.php?controller=trangchu&action=index">🏥 Trang chủ</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'benhnhan' ? ' active' : '' ?>" 
       href="index.php?controller=benhnhan&action=timkiempage">🔍 Tra cứu bệnh nhân</a>
    
    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'benhnhan' && ($_GET['action'] ?? '') === 'thempage' ? ' active' : '' ?>" 
       href="index.php?controller=benhnhan&action=thempage">➕ Thêm bệnh nhân</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'donthuoc' && ($_GET['action'] ?? '') === 'taopage' ? ' active' : '' ?>" 
       href="index.php?controller=donthuoc&action=taopage">💊 Tạo đơn thuốc</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'donthuoc' && ($_GET['action'] ?? '') === 'tracuupage' ? ' active' : '' ?>" 
       href="index.php?controller=donthuoc&action=tracuupage">📄 Tra cứu đơn thuốc</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'datlichpage' ? ' active' : '' ?>" 
       href="index.php?controller=lichkham&action=datlichpage">📅 Đặt lịch khám</a>
    
    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'xacnhanpage' ? ' active' : '' ?>" 
       href="index.php?controller=lichkham&action=xacnhanpage">📅 Xác nhận lịch khám</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'xem' ? ' active' : '' ?>" 
       href="index.php?controller=lichkham&action=xem">📅 Xem lịch khám</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'bacsi' && ($_GET['action'] ?? '') === 'thempage' ? ' active' : '' ?>" 
       href="index.php?controller=bacsi&action=thempage">📅 Thêm bác sĩ</a>

    <?php if (!empty($_SESSION['IsLogined']) && $_SESSION['IsLogined'] === true): ?>
      <div class="d-flex ms-auto">
        <span class="navbar-text me-3">
          👨‍⚕️ Xin chào, <strong><?= htmlspecialchars($_SESSION['User']['full_name']) ?></strong>
        </span>
        <a class="btn btn-outline-danger btn-sm" href="index.php?controller=xacthuc&action=dangxuat">Đăng xuất</a>
      </div>
    <?php else: ?>
      <a class="btn btn-outline-primary btn-sm ms-auto" href="index.php?controller=xacthuc&action=dangnhap">Đăng nhập</a>
    <?php endif; ?>
  </div>
</nav>

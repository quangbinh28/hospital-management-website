<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand<?= ($_GET['controller'] ?? '') === 'trangchu' ? ' active' : '' ?>" 
       href="index.php?controller=trangchu&action=index">🏥 Trang chủ</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'benhnhan' ? ' active' : '' ?>" 
       href="index.php?controller=benhnhan&action=timkiempage">🔍 Tra cứu bệnh nhân</a>
    
    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'donthuoc' && ($_GET['action'] ?? '') === 'tracuu' ? ' active' : '' ?>" 
       href="index.php?controller=benhnhan&action=thempage">📄 Thêm bệnh nhân</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'donthuoc' && ($_GET['action'] ?? '') === 'taopage' ? ' active' : '' ?>" 
       href="index.php?controller=donthuoc&action=taopage">💊 Tạo đơn thuốc</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'donthuoc' && ($_GET['action'] ?? '') === 'tracuu' ? ' active' : '' ?>" 
       href="index.php?controller=donthuoc&action=tracuupage">📄 Tra cứu đơn thuốc</a>

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

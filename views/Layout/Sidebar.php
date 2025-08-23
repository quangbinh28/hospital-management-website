<!-- Sidebar -->
<div class="bg-light border-end" style="width: 220px; min-height: calc(100vh - 56px);">
  <div class="list-group list-group-flush">
    <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'trangchu' ? 'active' : '' ?>" 
       href="index.php?controller=trangchu&action=index">🏥 Trang chủ</a>

    <?php if (!empty($_SESSION['IsLogined']) && $_SESSION['IsLogined'] === true): ?>

      <?php if ($_SESSION['user']['sub'] === 'TIEPTAN'): ?>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'benhnhan' ? 'active' : '' ?>" 
           href="index.php?controller=benhnhan&action=timkiempage">🔍 Tra cứu bệnh nhân</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'benhnhan' && ($_GET['action'] ?? '') === 'thempage' ? 'active' : '' ?>" 
           href="index.php?controller=benhnhan&action=thempage">➕ Thêm bệnh nhân</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'datlichpage' ? 'active' : '' ?>" 
           href="index.php?controller=lichkham&action=datlichpage">📅 Đặt lịch khám</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'xacnhanpage' ? 'active' : '' ?>" 
           href="index.php?controller=lichkham&action=xacnhanpage">📅 Xác nhận lịch khám</a>
      <?php endif; ?>

      <?php if ($_SESSION['user']['sub'] === 'BACSI'): ?>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'benhnhan' ? 'active' : '' ?>" 
           href="index.php?controller=benhnhan&action=timkiempage">🔍 Tra cứu bệnh nhân</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'donthuoc' ? 'active' : '' ?>" 
           href="index.php?controller=donthuoc&action=taopage">💊 Tạo đơn thuốc</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'lichkham' ? 'active' : '' ?>" 
           href="index.php?controller=lichkham&action=xem">📅 Xem lịch khám</a>
      <?php endif; ?>

      <?php if ($_SESSION['user']['sub'] === 'DUOCSI'): ?>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'donthuoc' ? 'active' : '' ?>" 
           href="index.php?controller=donthuoc&action=tracuupage">📄 Tra cứu đơn thuốc</a>
      <?php endif; ?>

      <?php if ($_SESSION['user']['sub'] === 'ADMIN'): ?>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'bacsi' ? 'active' : '' ?>" 
           href="index.php?controller=bacsi&action=thempage">👨‍⚕️ Thêm bác sĩ</a>

        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'benhnhan' ? 'active' : '' ?>" 
           href="index.php?controller=benhnhan&action=timkiempage">🔍 Tra cứu bệnh nhân</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'benhnhan' && ($_GET['action'] ?? '') === 'thempage' ? 'active' : '' ?>" 
           href="index.php?controller=benhnhan&action=thempage">➕ Thêm bệnh nhân</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'datlichpage' ? 'active' : '' ?>" 
           href="index.php?controller=lichkham&action=datlichpage">📅 Đặt lịch khám</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'xacnhanpage' ? 'active' : '' ?>" 
           href="index.php?controller=lichkham&action=xacnhanpage">📅 Xác nhận lịch khám</a>
      <?php endif; ?>

      <?php if ($_SESSION['user']['sub'] === 'BENHNHAN'): ?>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'datlichpage' ? 'active' : '' ?>" 
           href="index.php?controller=lichkham&action=datlichpage">📅 Đặt lịch khám</a>
        <a class="list-group-item list-group-item-action <?= ($_GET['controller'] ?? '') === 'lichkham' && ($_GET['action'] ?? '') === 'xem' ? 'active' : '' ?>" 
           href="index.php?controller=lichkham&action=xem">📅 Xem lịch khám</a>
      <?php endif; ?>

    <?php endif; ?>
  </div>
</div>

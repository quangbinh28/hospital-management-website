<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Bệnh viện</title>
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand<?= ($_GET['controller'] ?? '') === 'trangchu' ? ' active' : '' ?>" href="index.php?controller=trangchu&action=index">🏥 Trang chủ</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'benhnhan' ? ' active' : '' ?>" href="index.php?controller=benhnhan&action=timkiempage">🔍 Tra cứu bệnh nhân</a>

    <a class="nav-link<?= ($_GET['controller'] ?? '') === 'hoso' ? ' active' : '' ?>" href="index.php?controller=hoso&action=them">📝 Thêm hồ sơ</a>

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

<div class="container mt-4">

<!DOCTYPE html>
<html>
<head>
  <!-- ✅ Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
  <div id="wrapper">
    <!-- Header -->
    <?php include 'views/layout/Header.php'; ?>

    <!-- Layout chính: Sidebar + Content -->
    <div class="d-flex">
      <?php include 'views/layout/Sidebar.php'; ?>

      <!-- Content -->
      <div class="flex-grow-1 p-4">
        <?php require($VIEW); ?>
      </div>
    </div>

    <!-- Footer -->
    <?php include 'views/layout/Footer.php'; ?>
  </div>
</body>
</html>

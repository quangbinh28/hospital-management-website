<?php
$thongKeData = $thongKeData ?? [];

// Chuẩn bị dữ liệu cho Chart.js
$labels = [];
$patients = [];
$prescriptions = [];

foreach ($thongKeData as $row) {
    $labels[] = "Tháng " . $row['month'];
    $patients[] = $row['totalPatients'];
    $prescriptions[] = $row['totalPrescriptions'];
}
?>

<h4>Kết quả thống kê năm <?= htmlspecialchars($_POST['nam'] ?? date('Y')) ?></h4>

<?php if(empty($thongKeData)): ?>
    <p>Chưa có dữ liệu thống kê.</p>
<?php else: ?>
<!-- Gán dữ liệu cho Chart.js qua data-* attribute -->
<div id="chartData"
     data-labels='<?= json_encode($labels) ?>'
     data-patients='<?= json_encode($patients) ?>'
     data-prescriptions='<?= json_encode($prescriptions) ?>'>
</div>

<table class="table table-bordered mt-3">
    <thead class="table-light">
        <tr>
            <th>Tháng</th>
            <th>Số bệnh nhân</th>
            <th>Số đơn thuốc</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($thongKeData as $row): ?>
            <tr>
                <td><?= $row['month'] ?></td>
                <td><?= $row['totalPatients'] ?></td>
                <td><?= $row['totalPrescriptions'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<canvas id="thongKeChart" height="100"></canvas>

<script>
    // Lưu dữ liệu vào #thongKeResults để JS trong view chính lấy
    const chartDiv = document.getElementById('chartData');
    const resultDiv = document.getElementById('thongKeResults');
    if(chartDiv && resultDiv) {
        resultDiv.dataset.labels = chartDiv.dataset.labels;
        resultDiv.dataset.patients = chartDiv.dataset.patients;
        resultDiv.dataset.prescriptions = chartDiv.dataset.prescriptions;
    }
</script>
<?php endif; ?>

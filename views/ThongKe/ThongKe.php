<div class="container my-4" style="max-width: 95%;">
    <h2 class="text-success mb-4">📊 Thống kê theo năm</h2>

    <form id="formThongKe" class="row g-3 mb-4" method="post"
          action="index.php?controller=thongke&action=thongKe">

        <div class="col-md-3">
            <label for="nam" class="form-label">Nhập năm:</label>
            <input type="number" id="nam" name="nam" class="form-control"
                   value="<?= htmlspecialchars($_POST['nam'] ?? date('Y')) ?>"
                   min="2000" max="<?= date('Y') ?>"
                   placeholder="VD: 2025">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="button" id="btnThongKe" class="btn btn-success w-100">
                📈 Thống kê
            </button>
        </div>
    </form>

    <hr>

    <div id="thongKeResults" class="mt-4">
        <!-- AJAX sẽ load kết quả vào đây -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function () {

    function thongKe() {
        const form = $('#formThongKe');
        const data = form.serialize();

        $('#thongKeResults').html('<p>Đang tải thống kê...</p>');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            success: function(response) {
                // Chèn HTML vào div
                $('#thongKeResults').html(response);

                // Lấy dữ liệu JSON từ các data-* attribute
                const labels = $('#thongKeResults').data('labels');
                const patients = $('#thongKeResults').data('patients');
                const prescriptions = $('#thongKeResults').data('prescriptions');

                // Vẽ Chart nếu dữ liệu tồn tại
                const ctx = document.getElementById('thongKeChart');
                if(ctx && labels && patients && prescriptions) {
                    new Chart(ctx.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Bệnh nhân',
                                    data: patients,
                                    borderColor: 'blue',
                                    backgroundColor: 'rgba(0,0,255,0.1)',
                                    tension: 0.3
                                },
                                {
                                    label: 'Đơn thuốc',
                                    data: prescriptions,
                                    borderColor: 'green',
                                    backgroundColor: 'rgba(0,128,0,0.1)',
                                    tension: 0.3
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { position: 'top' } },
                            scales: { y: { beginAtZero: true } }
                        }
                    });
                }
            },
            error: function() {
                $('#thongKeResults').html('<div class="alert alert-danger">Lỗi khi tải thống kê.</div>');
            }
        });
    }

    $('#btnThongKe').off('click').on('click', () => thongKe());
    $('#nam').off('keyup').on('keyup', function(e) {
        if (e.keyCode === 13) thongKe();
    });
});
</script>

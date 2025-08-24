<!-- views/LichKham/LichKham_TraCuu.php -->
<div class="container my-4" style="max-width: 95%;">
    <h2 class="text-primary mb-4">📋 Tra cứu lịch khám</h2>

    <form id="searchLichKhamForm" class="row g-3 mb-4" method="post"
          action="index.php?controller=lichkham&action=tracuu">

        <div class="col-md-3">
            <label for="maBS" class="form-label">Mã bác sĩ:</label>
            <input type="text" id="maBS" name="maBS" class="form-control"
                   value="<?= htmlspecialchars($_POST['maBS'] ?? '') ?>" placeholder="VD: BS-2508114ROHDGI">
        </div>

        <div class="col-md-3">
            <label for="maBN" class="form-label">Mã bệnh nhân:</label>
            <input type="text" id="maBN" name="maBN" class="form-control"
                   value="<?= htmlspecialchars($_POST['maBN'] ?? '') ?>" placeholder="VD: BN-250818QESRHVJ">
        </div>

        <div class="col-md-3">
            <label for="tỉnhTrang" class="form-label">Trạng thái:</label>
            <select id="tỉnhTrang" name="tinhTrang" class="form-select">
                <option value="">-- Chọn trạng thái --</option>
                <option value="DA_DAT" <?= (($_POST['trangThai'] ?? '') === 'DA_DAT') ? 'selected' : '' ?>>ĐÃ ĐẶT</option>
                <option value="DA_THANH_TOAN" <?= (($_POST['trangThai'] ?? '') === 'DA_THANH_TOAN') ? 'selected' : '' ?>>ĐÃ THANH TOÁN</option>
                <option value="DA_HUY" <?= (($_POST['trangThai'] ?? '') === 'DA_HUY') ? 'selected' : '' ?>>ĐÃ HỦY</option>
            </select>
        </div>

        <div class="col-md-3">
            <div class="row g-2">
                <div class="col-6">
                    <label for="ngayTu" class="form-label small">Từ ngày</label>
                    <input type="date" id="ngayTu" name="ngayTu" class="form-control"
                           value="<?= htmlspecialchars($_POST['ngayTu'] ?? '') ?>">
                </div>
                <div class="col-6">
                    <label for="ngayDen" class="form-label small">Đến ngày</label>
                    <input type="date" id="ngayDen" name="ngayDen" class="form-control"
                           value="<?= htmlspecialchars($_POST['ngayDen'] ?? '') ?>">
                </div>
            </div>
        </div>

        <div class="col-md-12 text-end d-flex align-items-end justify-content-end">
            <button type="button" id="btnSearchLichKham" class="btn btn-primary w-25">🔍 Tìm kiếm</button>
        </div>
    </form>

    <hr>

    <div id="searchLichKhamResults" class="mt-4">
        <?php include './views/LichKham/LichKham_KetQua.php'; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function search(page = 1) {
        const form = $('#searchLichKhamForm');
        const data = form.serialize() + '&page=' + page;

        $('#searchLichKhamResults').html('<p>Đang tải kết quả...</p>');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            success: function (response) {
                $('#searchLichKhamResults').html(response);
            },
            error: function () {
                $('#searchLichKhamResults').html('<div class="alert alert-danger">Lỗi khi tải kết quả.</div>');
            }
        });
    }

    $('#btnSearchLichKham').click(() => search());

    // Enter để search hoặc đổi trạng thái thì search luôn
    $('#maBS, #maBN, #ngayTu, #ngayDen, #trangThai').on('keyup change', function (e) {
        if (e.keyCode === 13 || e.type === 'change') search();
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('page-btn')) {
            e.preventDefault();
            const page = e.target.getAttribute('data-page');
            search(page);
        }
    });
});
</script>

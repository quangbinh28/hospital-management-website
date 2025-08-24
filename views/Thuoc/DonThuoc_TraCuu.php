<div class="container my-4" style="max-width: 95%;">
    <h2 class="text-primary mb-4">💊 Tra cứu đơn thuốc</h2>

    <form id="searchDonThuocForm" class="row g-3 mb-4" method="post" 
          action="index.php?controller=donthuoc&action=tracuu">

        <div class="col-md-3">
            <label for="maBS" class="form-label">Mã bác sĩ:</label>
            <input type="text" id="maBS" name="maBS" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="maBN" class="form-label">Mã bệnh nhân:</label>
            <input type="text" id="maBN" name="maBN" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="trangThai" class="form-label">Trạng thái:</label>
            <select id="trangThai" name="trangThai" class="form-select">
                <option value="">-- Chọn trạng thái --</option>
                <option value="DOI_LAY_THUOC">ĐỢI LẤY THUỐC</option>
                <option value="DA_SAN_SANG">ĐÃ SẴN SÀNG</option>
                <option value="DA_NHAN">ĐÃ NHẬN</option>
            </select>
        </div>

        <div class="col-md-3">
            <div class="row g-2">
                <div class="col-6">
                    <label for="tuNgay" class="form-label small">Từ ngày</label>
                    <input type="date" id="tuNgay" name="tuNgay" class="form-control">
                </div>
                <div class="col-6">
                    <label for="denNgay" class="form-label small">Đến ngày</label>
                    <input type="date" id="denNgay" name="denNgay" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-md-12 text-end d-flex align-items-end justify-content-end">
            <button type="button" id="btnSearchDonThuoc" class="btn btn-primary w-25">🔍 Tìm kiếm</button>
        </div>
    </form>

    <hr>

    <div id="searchDonThuocResults" class="mt-4">
        <?php include './views/Thuoc/DonThuoc_KetQuaTraCuu.php'; ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function search(page = 1) {
        const form = $('#searchDonThuocForm');
        const data = form.serialize() + '&page=' + page;

        $('#searchDonThuocResults').html('<p>Đang tải kết quả...</p>');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            success: function (response) {
                $('#searchDonThuocResults').html(response);
            },
            error: function () {
                $('#searchDonThuocResults').html('<div class="alert alert-danger">Lỗi khi tải kết quả.</div>');
            }
        });
    }

    $('#btnSearchDonThuoc').click(() => search());

    $('#maDT, #maBN, #tuNgay, #denNgay, #trangThai').on('keyup change', function (e) {
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

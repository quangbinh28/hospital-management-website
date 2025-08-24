<div class="container my-4" style="max-width: 95%;">
    <h2 class="text-primary mb-4">💊 Tra cứu đơn thuốc</h2>

    <form id="searchDonThuocForm" class="row g-3 mb-4" method="post" 
          action="index.php?controller=donthuoc&action=tracuu">

        <div class="col-md-3">
            <label for="maDT" class="form-label">Mã đơn thuốc:</label>
            <input type="text" id="maDT" name="maDT" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="maBN" class="form-label">Mã bệnh nhân:</label>
            <input type="text" id="maBN" name="maBN" class="form-control">
        </div>

        <div class="col-md-4">
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

        <div class="col-md-2 text-end d-flex align-items-end">
            <button type="button" id="btnSearchDonThuoc" class="btn btn-primary w-100">🔍 Tìm kiếm</button>
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

    $('#maDT, #maBN, #tuNgay, #denNgay').keyup(function (e) {
        if (e.keyCode === 13) search();
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

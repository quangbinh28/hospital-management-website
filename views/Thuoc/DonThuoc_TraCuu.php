<h2 class="text-primary mb-4">💊 Tra cứu đơn thuốc</h2>

<form id="searchDonThuocForm" class="row g-3 mb-4" method="post" action="index.php?controller=donthuoc&action=tracuu">
    <div class="col-md-4">
        <label for="maDT" class="form-label">Mã đơn thuốc:</label>
        <input type="text" id="maDT" name="maDT" class="form-control">
    </div>

    <div class="col-md-4">
        <label for="tenBN" class="form-label">Tên bệnh nhân:</label>
        <input type="text" id="tenBN" name="tenBN" class="form-control">
    </div>

    <div class="col-md-4">
        <label for="ngayLap" class="form-label">Ngày lập:</label>
        <input type="date" id="ngayLap" name="ngayLap" class="form-control">
    </div>

    <div class="col-12 text-end">
        <button type="button" id="btnSearchDonThuoc" class="btn btn-primary">🔍 Tìm kiếm</button>
    </div>
</form>

<hr>

<div id="searchDonThuocResults" class="mt-4">
    <?php include './views/Thuoc/DonThuoc_KetQuaTraCuu.php'; ?>
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

    $('#maDT, #tenBN, #ngayLap').keyup(function (e) {
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

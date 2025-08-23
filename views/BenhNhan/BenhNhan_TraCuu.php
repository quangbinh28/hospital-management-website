<div class="container my-4" style="max-width: 900px;">
    <h2 class="text-primary mb-4">🔍 Tra cứu thông tin bệnh nhân</h2>

    <form id="searchForm" class="row g-3 mb-4" method="post" 
          action="index.php?controller=benhnhan&action=timkiem">

        <div class="col-md-4">
            <label for="maBN" class="form-label">Mã bệnh nhân:</label>
            <input type="text" id="maBN" name="maBN" class="form-control">
        </div>

        <div class="col-md-4">
            <label for="ten" class="form-label">Họ tên bệnh nhân:</label>
            <input type="text" id="ten" name="ten" class="form-control">
        </div>

        <div class="col-md-4">
            <label for="sdt" class="form-label">Số điện thoại:</label>
            <input type="text" id="sdt" name="sdt" class="form-control">
        </div>

        <div class="col-12 text-end">
            <button type="button" id="btnSearch" class="btn btn-primary">🔍 Tìm kiếm</button>
        </div>
    </form>

    <hr>

    <div id="searchResults" class="mt-4">
        <?php include './views/BenhNhan/BenhNhan_KetQua.php'; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function search(page = 1) {
        const form = $('#searchForm');
        const data = form.serialize() + '&page=' + page;

        $('#searchResults').html('<p>Đang tải kết quả...</p>');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            success: function (response) {
                $('#searchResults').html(response);
            },
            error: function () {
                $('#searchResults').html('<div class="alert alert-danger">Lỗi khi tải kết quả.</div>');
            }
        });
    }

    // Nút tìm kiếm
    $('#btnSearch').click(() => search());

    // Enter để tìm kiếm
    $('#maBN, #ten, #sdt').keyup(function (e) {
        if (e.keyCode === 13) search();
    });

    // Click phân trang
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('page-btn')) {
            e.preventDefault();
            const page = e.target.getAttribute('data-page');
            search(page);
        }
    });
});
</script>

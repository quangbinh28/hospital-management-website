<div class="container my-4" style="max-width: 900px;">
    <h2 class="text-primary mb-4">💊 Tạo đơn thuốc</h2>

    <form id="taoDonThuocForm" class="row g-3 mb-4" method="post" 
          action="index.php?controller=donthuoc&action=luu">

        <!-- Thông tin bệnh nhân -->
        <div class="col-md-4">
            <label for="maBN" class="form-label">Mã bệnh nhân:</label>
            <input type="text" id="maBN" name="maBN" class="form-control" required>
        </div>
        <div class="col-md-8">
            <label for="chanDoan" class="form-label">Chẩn đoán:</label>
            <input type="text" id="chanDoan" name="chanDoan" class="form-control" required>
        </div>

        <!-- Danh sách thuốc -->
        <div class="col-12">
            <h5 class="mt-4">📋 Danh sách thuốc</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="thuocTable">
                    <thead class="table-light">
                        <tr>
                            <th>Tên thuốc</th>
                            <th style="width:120px;">Số lượng</th>
                            <th>Chỉ định</th>
                            <th style="width:60px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="position-relative">
                                <input type="text" name="thuoc[0][ten]" class="form-control ten-thuoc" required>
                                <div class="suggestions"></div>
                            </td>
                            <td><input type="number" name="thuoc[0][soLuong]" class="form-control" required></td>
                            <td><input type="text" name="thuoc[0][chiDinh]" class="form-control"></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm xoaThuoc">🗑</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="button" id="themThuoc" class="btn btn-success btn-sm">➕ Thêm thuốc</button>
        </div>

        <!-- Ghi chú -->
        <div class="col-12">
            <label for="ghiChu" class="form-label">Ghi chú:</label>
            <textarea id="ghiChu" name="ghiChu" rows="3" class="form-control"></textarea>
        </div>

        <!-- Nút lưu -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">💾 Tạo đơn thuốc</button>
        </div>
    </form>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    let thuocIndex = 1;

    // debounce helper
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // gọi API gợi ý thuốc
    function goiYThuoc(input) {
        let keyword = $(input).val().trim();
        let $container = $(input).siblings(".suggestions");

        if (keyword.length < 2) {
            $container.empty();
            return;
        }

        $.getJSON("index.php", { controller: "thuoc", action: "goiYThuoc", q: keyword }, function(data) {
            let $list = $("<ul class='list-group position-absolute w-100' style='z-index:1000;'></ul>");
            (data || []).forEach(item => {
                $list.append(`<li class="list-group-item suggestion-item" style="cursor:pointer;">${item.ten_thuoc}</li>`);
            });

            $container.html($list);

            // khi chọn gợi ý
            $list.find(".suggestion-item").click(function() {
                $(input).val($(this).text());
                $container.empty();
            });
        });
    }

    const debouncedGoiY = debounce(function() {
        goiYThuoc(this);
    }, 400);

    // lắng nghe input trên tên thuốc (cả dòng mới thêm)
    $(document).on("input", ".ten-thuoc", debouncedGoiY);

    // thêm dòng thuốc mới
    $("#themThuoc").click(function () {
        let row = `
            <tr>
                <td class="position-relative">
                    <input type="text" name="thuoc[${thuocIndex}][ten]" class="form-control ten-thuoc" required>
                    <div class="suggestions"></div>
                </td>
                <td><input type="number" name="thuoc[${thuocIndex}][soLuong]" class="form-control" required></td>
                <td><input type="text" name="thuoc[${thuocIndex}][chiDinh]" class="form-control"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm xoaThuoc">🗑</button>
                </td>
            </tr>
        `;
        $("#thuocTable tbody").append(row);
        thuocIndex++;
    });

    // xóa dòng thuốc
    $(document).on("click", ".xoaThuoc", function () {
        $(this).closest("tr").remove();
    });
});
</script>

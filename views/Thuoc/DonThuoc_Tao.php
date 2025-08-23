<div class="container my-4" style="max-width: 900px;">
    <h2 class="text-primary mb-4">💊 Tạo đơn thuốc</h2>

    <form id="taoDonThuocForm" class="row g-3 mb-4" method="post" 
          action="index.php?controller=donthuoc&action=luu">

        <!-- Thông tin bệnh nhân -->
        <div class="col-md-4">
            <label for="maBN" class="form-label">Mã bệnh nhân:</label>
            <input type="text" id="maBN" name="maBN" class="form-control" required>
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
                                <input type="text" name="thuoc[0][tenThuoc]" class="form-control ten-thuoc" required>
                                <input type="hidden" name="thuoc[0][maThuoc]">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    let thuocIndex = $("#thuocTable tbody tr").length; // index tăng liên tục

    // ===== Debounce helper =====
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // ===== Gợi ý thuốc =====
    function goiYThuoc(input) {
        let keyword = $(input).val().trim();
        let $container = $(input).closest("td").find(".suggestions");

        if (keyword.length < 2) {
            $container.empty();
            return;
        }

        $.getJSON("index.php", { controller: "thuoc", action: "goiYThuoc", q: keyword }, function(data) {
            let $list = $("<ul class='list-group position-absolute w-100' style='z-index:1000;'></ul>");
            (data || []).forEach(item => {
                $list.append(`
                    <li class="list-group-item suggestion-item" 
                        data-ma="${item.maThuoc}" 
                        data-ten="${item.tenThuoc}" 
                        style="cursor:pointer;">
                        ${item.tenThuoc}
                    </li>
                `);
            });

            $container.html($list);

            // Khi chọn gợi ý
            $list.find(".suggestion-item").click(function() {
                let ten = $(this).data("ten");
                let ma = $(this).data("ma");

                $(input).val(ten);
                $(input).closest("td").find("input[type=hidden]").val(ma);

                $container.empty();
            });
        });
    }

    const debouncedGoiY = debounce(function(e) {
        goiYThuoc(e.target);
    }, 400);

    // Lắng nghe input trên tất cả ô tên thuốc
    $(document).on("input", ".ten-thuoc", function(e) {
        debouncedGoiY(e);
    });

    // ===== Thêm dòng thuốc mới =====
    $("#themThuoc").click(function () {
        let row = `
            <tr>
                <td class="position-relative">
                    <input type="text" name="thuoc[${thuocIndex}][tenThuoc]" class="form-control ten-thuoc" required>
                    <input type="hidden" name="thuoc[${thuocIndex}][maThuoc]">
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

    // ===== Xóa thuốc =====
    $(document).on("click", ".xoaThuoc", function () {
        $(this).closest("tr").remove();
    });

    // ===== Trước khi submit form: in ra payload =====
    $("#taoDonThuocForm").on("submit", function(e) {
        e.preventDefault(); // chặn submit để debug

        let thuocList = [];

        $("#thuocTable tbody tr").each(function() {
            let ten = $(this).find("input[name*='[tenThuoc]']").val();
            let ma = $(this).find("input[name*='[maThuoc]']").val();
            let soLuong = $(this).find("input[name*='[soLuong]']").val();
            let chiDinh = $(this).find("input[name*='[chiDinh]']").val();

            if (!ma && ten) {
                ma = ten; // fallback nếu không có mã thuốc
            }

            thuocList.push({
                maThuoc: ma,
                tenThuoc: ten,
                soLuong: parseInt(soLuong, 10) || 0,
                chiDinh: chiDinh
            });
        });

        let payload = {
            maBenhNhan: $("#maBN").val(),
            ghiChu: $("#ghiChu").val(),
            prescriptionDetails: thuocList
        };

        this.submit();
    });
});
</script>

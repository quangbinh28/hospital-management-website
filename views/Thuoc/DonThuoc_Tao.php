<h2 class="text-primary mb-4">💊 Tạo đơn thuốc</h2>

<form id="taoDonThuocForm" class="row g-3 mb-4" method="post" action="index.php?controller=donthuoc&action=luu">
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
        <h5 class="mt-4">Danh sách thuốc</h5>
        <table class="table table-bordered align-middle" id="thuocTable">
            <thead class="table-light">
                <tr>
                    <th>Tên thuốc</th>
                    <th>Số lượng</th>
                    <th>Chỉ định</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="thuoc[0][ten]" class="form-control" required></td>
                    <td><input type="number" name="thuoc[0][soLuong]" class="form-control" required></td>
                    <td><input type="text" name="thuoc[0][chiDinh]" class="form-control"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm xoaThuoc">🗑</button>
                    </td>
                </tr>
            </tbody>
        </table>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    let thuocIndex = 1;

    $("#themThuoc").click(function () {
        let row = `
            <tr>
                <td><input type="text" name="thuoc[${thuocIndex}][ten]" class="form-control" required></td>
                <td><input type="number" name="thuoc[${thuocIndex}][soLuong]" class="form-control" required></td>
                <td><input type="text" name="thuoc[${thuocIndex}][lieuLuong]" class="form-control"></td>
                <td><input type="text" name="thuoc[${thuocIndex}][chiDinh]" class="form-control"></td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm xoaThuoc">🗑</button>
                </td>
            </tr>
        `;
        $("#thuocTable tbody").append(row);
        thuocIndex++;
    });

    $(document).on("click", ".xoaThuoc", function () {
        $(this).closest("tr").remove();
    });
});
</script>

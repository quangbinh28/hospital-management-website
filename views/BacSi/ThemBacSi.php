<div class="container mt-4">
  <h2 class="mb-4 text-primary">➕ Thêm Bác Sĩ</h2>

  <form method="POST" action="?controller=bacsi&action=luu" class="row g-3">
    <!-- Mã chứng chỉ -->
    <div class="col-md-6">
      <label class="form-label">Mã chứng chỉ</label>
      <input type="text" name="maChungChi" class="form-control" required>
    </div>

    <!-- Họ tên -->
    <div class="col-md-6">
      <label class="form-label">Họ tên</label>
      <input type="text" name="hoTen" class="form-control" required>
    </div>

    <!-- Ngày sinh -->
    <div class="col-md-6">
      <label class="form-label">Ngày sinh</label>
      <input type="date" name="ngaySinh" class="form-control" required>
    </div>

    <!-- Giới tính -->
    <div class="col-md-6">
      <label class="form-label">Giới tính</label>
      <select name="gioiTinh" class="form-select">
        <option value="NAM">Nam</option>
        <option value="NU">Nữ</option>
      </select>
    </div>

    <!-- Địa chỉ -->
    <div class="col-12">
      <label class="form-label">Địa chỉ</label>
      <input type="text" name="diaChi" class="form-control" required>
    </div>

    <!-- Kinh nghiệm -->
    <div class="col-12">
      <h4 class="mt-4 text-secondary">🧾 Kinh nghiệm làm việc</h4>
      <div id="kinhNghiemContainer">
        <div class="card p-3 mb-3 kinhNghiemItem">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Bệnh viện</label>
              <input type="text" name="kinhNghiem[0][benhVien]" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Chuyên khoa</label>
              <input type="text" name="kinhNghiem[0][chuyenKhoa]" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Vị trí</label>
              <input type="text" name="kinhNghiem[0][viTri]" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Năm bắt đầu</label>
              <input type="number" name="kinhNghiem[0][namBatDau]" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Năm kết thúc</label>
              <input type="number" name="kinhNghiem[0][namKetThuc]" class="form-control" required>
            </div>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-outline-success btn-sm" onclick="themKinhNghiem()">➕ Thêm kinh nghiệm</button>
    </div>

    <!-- Submit -->
    <div class="col-12 text-end">
      <button type="submit" class="btn btn-primary">💾 Lưu bác sĩ</button>
    </div>
  </form>
</div>

<script>
let kinhNghiemIndex = 1;

function themKinhNghiem() {
  const container = document.getElementById('kinhNghiemContainer');
  const newItem = document.createElement('div');
  newItem.classList.add('card', 'p-3', 'mb-3', 'kinhNghiemItem');
  newItem.innerHTML = `
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Bệnh viện</label>
        <input type="text" name="kinhNghiem[${kinhNghiemIndex}][benhVien]" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Chuyên khoa</label>
        <input type="text" name="kinhNghiem[${kinhNghiemIndex}][chuyenKhoa]" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Vị trí</label>
        <input type="text" name="kinhNghiem[${kinhNghiemIndex}][viTri]" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Năm bắt đầu</label>
        <input type="number" name="kinhNghiem[${kinhNghiemIndex}][namBatDau]" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Năm kết thúc</label>
        <input type="number" name="kinhNghiem[${kinhNghiemIndex}][namKetThuc]" class="form-control" required>
      </div>
      <div class="col-12 text-end">
        <button type="button" class="btn btn-outline-danger btn-sm mt-2" onclick="xoaKinhNghiem(this)">🗑 Xóa</button>
      </div>
    </div>
  `;
  container.appendChild(newItem);
  kinhNghiemIndex++;
}

function xoaKinhNghiem(btn) {
  btn.closest('.kinhNghiemItem').remove();
}
</script>

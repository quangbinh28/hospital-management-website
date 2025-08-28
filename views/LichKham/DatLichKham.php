<div class="container mt-4">
    <h2 class="mb-4 text-primary">📅 Đặt Lịch Khám</h2>

    <form method="post" action="index.php?controller=lichkham&action=datLichKham" 
          class="border p-4 rounded shadow-sm bg-light">
        
        <!-- Mã bệnh nhân (readonly) -->
        <div class="mb-3">
            <label for="maBenhNhan" class="form-label">Mã bệnh nhân</label>
            <input type="text" name="maBenhNhan" id="maBenhNhan" class="form-control" 
                   value="<?= htmlspecialchars($maBN ?? '') ?>" readonly>
        </div>

        <!-- Chuyên khoa -->
        <div class="mb-3">
            <label for="chuyenKhoa" class="form-label">Chuyên khoa</label>
            <select name="chuyenKhoa" id="chuyenKhoa" class="form-select" required>
                <option value="">-- Chọn chuyên khoa --</option>
                <?php foreach ($dsChuyenKhoa as $ck): ?>
                    <option value="<?= htmlspecialchars($ck['maKhoa']) ?>">
                        <?= htmlspecialchars($ck['tenKhoa']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Bác sĩ -->
        <div class="mb-3">
            <label for="bacSi" class="form-label">Bác sĩ</label>
            <select name="bacSi" id="bacSi" class="form-select" required>
                <option value="">-- Chọn bác sĩ --</option>
            </select>
        </div>

        <!-- Thông tin bác sĩ -->
        <div id="thongTinBacSi" class="alert alert-info d-none">
            <h6>👨‍⚕️ Thông tin bác sĩ</h6>

            <!-- Avatar -->
            <div class="mb-2">
                <img id="tt-avatar" src="" alt="Avatar bác sĩ" 
                     class="img-thumbnail rounded shadow-sm" style="max-height:150px;">
            </div>

            <p><strong>Họ tên:</strong> <span id="tt-hoTen"></span></p>
            <p><strong>Ngày sinh:</strong> <span id="tt-ngaySinh"></span></p>
            <p><strong>Chuyên khoa:</strong> <span id="tt-chuyenKhoa"></span></p>
            <div>
                <strong>Kinh nghiệm:</strong>
                <ul id="tt-kinhNghiem"></ul>
            </div>
        </div>

        <!-- Ngày khám -->
        <div class="mb-3">
            <label for="ngayKham" class="form-label">Ngày khám</label>
            <select name="ngayKham" id="ngayKham" class="form-select" required>
                <option value="">-- Chọn ngày --</option>
            </select>
        </div>

        <!-- Giờ khám -->
        <div class="mb-3">
            <label for="gioKham" class="form-label">Giờ khám</label>
            <select name="gioKham" id="gioKham" class="form-select" required>
                <option value="">-- Chọn giờ --</option>
            </select>
        </div>

        <!-- Phòng khám (readonly) -->
        <div class="mb-3">
            <label for="phong" class="form-label">Phòng khám</label>
            <input type="text" name="phong" id="phong" 
                   class="form-control" readonly placeholder="Sẽ tự động hiển thị">
        </div>

        <!-- Nguyên nhân -->
        <div class="mb-3">
            <label for="nguyenNhan" class="form-label">Nguyên nhân khám</label>
            <textarea name="nguyenNhan" id="nguyenNhan" rows="3" 
                      class="form-control" placeholder="Nhập lý do bạn muốn khám..." required></textarea>
        </div>

        <!-- Nút -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">💾 Đặt lịch khám</button>
        </div>
    </form>
</div>

<script>
const chuyenKhoaSelect = document.getElementById('chuyenKhoa');
const bacSiSelect = document.getElementById('bacSi');
const ngayKhamSelect = document.getElementById('ngayKham');
const gioKhamSelect = document.getElementById('gioKham');
const phongInput = document.getElementById('phong');

chuyenKhoaSelect.addEventListener('change', function () {
    let maKhoa = this.value;
    bacSiSelect.innerHTML = '<option value="">-- Đang tải bác sĩ --</option>';
    ngayKhamSelect.innerHTML = '<option value="">-- Chọn ngày --</option>';
    gioKhamSelect.innerHTML = '<option value="">-- Chọn giờ --</option>';
    phongInput.value = '';

    fetch('index.php?controller=lichkham&action=layBacSiTheoKhoa&maKhoa=' + maKhoa)
        .then(res => res.json())
        .then(data => {
            bacSiSelect.innerHTML = '<option value="">-- Chọn bác sĩ --</option>';
            data.forEach(bacSi => {
                bacSiSelect.innerHTML += `<option value="${bacSi.maNV}">${bacSi.hoTen}</option>`;
            });
        });
});

bacSiSelect.addEventListener('change', function () {
    let maBS = this.value;

    // Reset hiển thị thông tin bác sĩ
    document.getElementById('thongTinBacSi').classList.add('d-none');

    if (!maBS) return;

    // Lấy thông tin chi tiết bác sĩ
    fetch('index.php?controller=bacsi&action=chitiet&maBS=' + maBS)
        .then(res => res.json())
        .then(data => {
            if (data) {
                document.getElementById('tt-hoTen').innerText = data.hoTen || '';
                document.getElementById('tt-ngaySinh').innerText = data.ngaySinh || '';
                document.getElementById('tt-chuyenKhoa').innerText = data.chuyenKhoa || '';

                // Hiển thị avatar
                if (data.avatar) {
                    document.getElementById('tt-avatar').src = "http://localhost/udpt/" + data.avatar;
                } else {
                    document.getElementById('tt-avatar').src = "";
                }

                // Kinh nghiệm
                const kinhNghiemList = document.getElementById('tt-kinhNghiem');
                kinhNghiemList.innerHTML = '';
                if (data.kinhNghiem && data.kinhNghiem.length > 0) {
                    data.kinhNghiem.forEach(kn => {
                        kinhNghiemList.innerHTML += `
                            <li>
                                <strong>${kn.benhVien}</strong> - ${kn.chuyenKhoa}<br>
                                ${kn.viTri} (${kn.namBatDau} - ${kn.namKetThuc})
                            </li>
                        `;
                    });
                }

                document.getElementById('thongTinBacSi').classList.remove('d-none');
            }
        });

    // Lấy lịch làm việc của bác sĩ
    fetch('index.php?controller=lichkham&action=layCaKhamTheoBacSi&maBS=' + maBS)
        .then(res => res.json())
        .then(data => {
            ngayKhamSelect.innerHTML = '<option value="">-- Chọn ngày --</option>';
            gioKhamSelect.innerHTML = '<option value="">-- Chọn giờ --</option>';
            phongInput.value = '';

            const lichLamViec = data.lichLamViec || [];
            const ngaySet = [...new Set(lichLamViec.map(item => item.ngayLamViec))];

            ngaySet.forEach(ngay => {
                ngayKhamSelect.innerHTML += `<option value="${ngay}">${ngay}</option>`;
            });

            const gioPhongMap = {};

            ngayKhamSelect.addEventListener('change', function () {
                const ngayChon = this.value;
                gioKhamSelect.innerHTML = '<option value="">-- Chọn giờ --</option>';
                phongInput.value = '';

                const caTrongNgay = lichLamViec.filter(ca => ca.ngayLamViec === ngayChon);

                caTrongNgay.forEach(ca => {
                    const start = ca.gioBatDau.split(':');
                    const end   = ca.gioKetThuc.split(':');

                    let startDate = new Date(0,0,0, parseInt(start[0]), parseInt(start[1]));
                    let endDate   = new Date(0,0,0, parseInt(end[0]), parseInt(end[1]));

                    while(startDate < endDate) {
                        let hh = String(startDate.getHours()).padStart(2,'0');
                        let mm = String(startDate.getMinutes()).padStart(2,'0');
                        let value = `${hh}:${mm}`;

                        gioKhamSelect.innerHTML += `<option value="${value}">${value}</option>`;
                        gioPhongMap[value] = ca.phong;

                        startDate.setMinutes(startDate.getMinutes() + 30);
                    }
                });
            });

            gioKhamSelect.addEventListener('change', function () {
                const gioChon = this.value;
                phongInput.value = gioPhongMap[gioChon] || '';
            });
        });
});
</script>

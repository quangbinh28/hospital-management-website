<div class="container my-4" style="max-width: 700px;">
    <h2 class="text-primary mb-4">🖼️ Upload ảnh</h2>

    <form id="uploadForm" class="row g-3 mb-4" 
          method="post" enctype="multipart/form-data"
          action="index.php?controller=bacsi&action=uploadavatar">

        <div class="col-12">
            <label for="fileAnh" class="form-label">Chọn ảnh từ máy tính:</label>
            <!-- name="avatar" để khớp với controller -->
            <input type="file" id="fileAnh" name="avatar" accept="image/*" class="form-control" required>
        </div>

        <div class="col-12">
            <div id="preview" class="mt-2"></div>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-success">📤 Upload</button>
        </div>
    </form>

    <hr>

    <div id="uploadResult" class="mt-4"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const fileInput = document.getElementById("fileAnh");
    const preview = document.getElementById("preview");
    const form = document.getElementById("uploadForm");
    const result = document.getElementById("uploadResult");

    // Xem trước ảnh khi chọn file
    fileInput.addEventListener("change", () => {
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML = `
                    <p><strong>Xem trước:</strong></p>
                    <img src="${e.target.result}" class="img-fluid rounded shadow" style="max-height:300px;">
                `;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = "";
        }
    });

    // Submit form bằng Fetch API
    form.addEventListener("submit", e => {
        e.preventDefault();

        const formData = new FormData(form);
        result.innerHTML = "<p>Đang upload...</p>";

        fetch(form.action, {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            result.innerHTML = `<div class="alert alert-success">${data}</div>`;
        })
        .catch(() => {
            result.innerHTML = '<div class="alert alert-danger">❌ Lỗi khi upload ảnh.</div>';
        });
    });
});
</script>

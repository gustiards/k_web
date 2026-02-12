{{-- resources/views/ba_ddr.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Berita Acara Penghitungan DDR Stock Take</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 50px;
    line-height: 1.6;
    font-size: 15px;
    color: #000;
}

/* HEADER */
.header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

.logo {
    width: 90px;
}

.header-title {
    font-size: 20px;
    font-weight: bold;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
}

td {
    padding: 6px;
}

/* INPUT STYLE */
input {
    font-size: 15px;
    border: none;
    border-bottom: 1px dotted #000;
    width: 100%;
    background: transparent;
}

.input-medium { width: 150px; }
.input-long { width: 220px; }

/* SIGNATURE */
.signature-table {
    width: 100%;
    margin-top: 80px;
    text-align: center;
}

/* UPLOAD SECTION */
.upload-wrapper {
    margin-top: 20px;
}

.image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.file-input-group {
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    background: #fafafa;
    transition: 0.2s;
}

.file-input-group:hover {
    border-color: #1976d2;
    background: #f4f9ff;
}

.preview-container img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* BUTTON */
.button-wrapper {
    display: flex;
    justify-content: center;
}

.add-file-btn {
    padding: 10px 25px;
    font-size: 14px;
    font-weight: 600;
    background: linear-gradient(135deg, #2196f3, #1976d2);
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.add-file-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

/* PRINT SETTING */
@media print {

    body {
        margin: 0;
    }

    .no-print {
        display: none !important;
    }

    input {
        border: none !important;
    }

    .file-input-group {
        border: none;
        background: transparent;
        padding: 0;
    }

    .preview-container img {
        page-break-inside: avoid;
        break-inside: avoid;
    }
}
</style>
</head>
<body>

{{-- PAGE 1 --}}
<div>

    <div class="header">
        <img src="https://1shamelin.com.my/wp-content/uploads/2020/09/MR-DIY-2-1.jpg" class="logo">
        <div class="header-title">
            BERITA ACARA PELAKSANAAN STOCK TAKE
        </div>
    </div>

    <p>Dengan Hormat,</p>
    <p>Saya yang bertanda tangan di bawah ini:</p>

    <table>
        <tr>
            <td width="200">Nama</td>
            <td><input type="text"></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td><input type="text"></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td><input type="text"></td>
        </tr>
        <tr>
            <td>Store</td>
            <td><input type="text"></td>
        </tr>
        <tr>
            <td>Hari / Tanggal Stock Take</td>
            <td><input type="text"></td>
        </tr>
    </table>

    <p contenteditable="true">
        Berikut data perhitungan barang DDR Periode Cut Off Store SS1008-XPLA berdasarkan
        Intruksi dan Approval dari Bpk Ignatius Ryan, dari IB 340523 & 340526.
        Data tersebut sudah kami masukan dalam perhitungan stock take tanggal 24 Juli 2025.
    </p>

    <p>
        Demikian berita acara ini saya buat, untuk dapat dipergunakan sebagaimana mestinya.
    </p>

</div>

<div style="page-break-before: always;"></div>

{{-- PAGE 2 --}}
<div>

    <h3 style="text-align:center;">Bukti Approval Pengajuan Penghitungan DDR</h3>

    <form class="upload-wrapper">

        <div id="file-inputs" class="image-grid">
            <div class="file-input-group">
                <input type="file"
                       accept="image/*"
                       class="no-print"
                       onchange="previewImage(this)">
                <div class="preview-container"></div>
            </div>
        </div>

        <div class="button-wrapper no-print">
            <button type="button"
                    class="add-file-btn"
                    onclick="addFileInput()">
                + Tambah Gambar
            </button>
        </div>

    </form>

</div>

<div style="page-break-before: always;"></div>

{{-- PAGE 3 --}}
<div>

    <div style="margin-top:30px;">
        Tempat, Tanggal :
        <input type="text" class="input-medium" placeholder="Kota">
        ,
        <input type="text" class="input-long" placeholder="Tanggal">
    </div>

    <table class="signature-table">
        <tr>
            <td>Branch Manager</td>
            <td>Division Manager</td>
        </tr>
        <tr style="height:100px;">
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>( <input type="text" style="text-align:center;"> )</td>
            <td>( <input type="text" style="text-align:center;"> )</td>
        </tr>
    </table>

</div>

<script>
function addFileInput() {
    const container = document.getElementById('file-inputs');
    const div = document.createElement('div');
    div.classList.add('file-input-group');
    div.innerHTML = `
        <input type="file" accept="image/*" class="no-print" onchange="previewImage(this)">
        <div class="preview-container"></div>
    `;
    container.appendChild(div);
}

function previewImage(input) {
    const container = input.nextElementSibling;
    container.innerHTML = '';
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            container.appendChild(img);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>

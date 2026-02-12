{{-- resources/views/ba_ddr.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Berita Acara Hitung DDR Stock Take</title>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 50px;
      line-height: 1.6;
      font-size: 16px;
      color: #000;
    }

    .logo {
      width: 110px;
    }

    h2, h3 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
    }

    td {
      padding: 5px;
      vertical-align: middle;
    }

    .input-text,
    .input-small,
    .input-medium,
    .input-long,
    input {
      font-size: 16px;
      font-family: inherit;
      color: #000;
      background: transparent;
    }

    .input-text {
      width: 100%;
      border: none;
      border-bottom: 1px dotted #000;
    }

    .input-small {
      width: 40px;
      border: none;
      border-bottom: 1px dotted #000;
    }

    .input-medium {
      width: 120px;
      border: none;
      border-bottom: 1px dotted #000;
    }

    .input-long {
      width: 200px;
      border: none;
      border-bottom: 1px dotted #000;
    }

    .signature-table {
      width: 100%;
      margin-top: 60px;
      text-align: center;
    }

    .no-print {
      display: inline;
    }

    .print-hidden {
      display: block;
      margin-bottom: 30px;
    }

    @media print {
      input {
        border: none;
        background: transparent;
        pointer-events: none;
      }

      .no-print {
        display: none !important;
      }

      .preview-container img {
        page-break-inside: avoid;
        break-inside: avoid;
        margin-bottom: 10px;
      }

      .image-grid {
        gap: 10px;
      }
    }

    .btn-download {
      padding: 10px 20px;
      background-color: #2196f3;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-download:hover {
      background-color: #1976d2;
    }

    /* Page 2: Grid gambar */
    .image-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;              /* jarak antar gambar */
  align-items: flex-start;
}

.file-input-group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.preview-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;              /* jarak antar preview */
}


    .add-file-btn {
      margin-top: 5px;
      padding: 5px 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .add-file-btn:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>



    {{-- Page 1 --}}
    <div>
      <div style="display: flex; align-items: center; gap: 20px;">
        <img src="https://1shamelin.com.my/wp-content/uploads/2020/09/MR-DIY-2-1.jpg" class="logo" alt="Logo MR.DIY" />
        <h2>Berita Acara Hitung DDR Stock Take</h2>
      </div>

      <p>Dengan Hormat</p>
      <p>Saya yang bertanda tangan di bawah ini:</p>

      <table>
        <tr><td style="width: 220px;">Nama</td><td><input type="text" class="input-text" /></td></tr>
        <tr><td>NIK</td><td><input type="text" class="input-text" /></td></tr>
        <tr><td>Jabatan</td><td><input type="text" class="input-text" /></td></tr>
        <tr><td>Store</td><td><input type="text" class="input-text" /></td></tr>
        <tr><td>Hari / Tanggal Stock Take</td><td><input type="text" class="input-text" /></td></tr>
      </table>

      {{-- Paragraf permanen --}}
      <p contenteditable="true"> 
        Berikut data perhitungan barang DDR Periode Cut Off Store SS1008-XPLA berdasarkan
        Intruksi dan Approval dari Bpk Ignatius Ryan, dari IB 340523 & 340526. Data tersebut sudah kami masukan dalam
        perhitungan stock take tanggal 24 Juli 2025 dengan data sebagai berikut :
      </p>

      <p>Demikian berita acara ini saya buat, untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <div style="page-break-before: always;"></div>

    {{-- Page 2 --}}
    <div>
      <h3>Bukti Approval Pengajuan Hitung DDR</h3>

      <form id="upload-form" enctype="multipart/form-data">
        <div id="file-inputs" class="image-grid">
          <div class="file-input-group">
            <input type="file" name="images[]" accept="image/*" class="no-print" onchange="previewImage(this)" />
            <div class="preview-container"></div>
          </div>
        </div>
        <button type="button" class="add-file-btn no-print" onclick="addFileInput()">Tambah Gambar</button>
      </form>
    </div>

    <div style="page-break-before: always;"></div>

    {{-- Page 3 --}}
    <div>
      {{-- Tanggal --}}
      <div style="margin-top: 30px;">
        <span class="no-print">Tempat, Tanggal:</span>&nbsp;
        <input type="text" class="input-medium" placeholder="Kota" />&nbsp;,&nbsp;
        <input type="text" class="input-long" placeholder="Tanggal" />&nbsp;&nbsp;
      </div>

      {{-- Tanda Tangan --}}
      <table class="signature-table">
        <tr><td>Branch Manager</td><td>Division Manager</td></tr>
        <tr style="height: 80px;"><td></td><td></td></tr>
        <tr>
          <td>
            <div style="text-align: center;">
              ( <span style="display: inline-block; width: 200px;">
                <input type="text" class="input-text" style="text-align: center;" />
              </span> )
            </div>
          </td>
          <td>
            <div style="text-align: center;">
              ( <span style="display: inline-block; width: 200px;">
                <input type="text" class="input-text" style="text-align: center;" />
              </span> )
            </div>
          </td>
        </tr>
      </table>
    </div>

  </div>

  <script>
    // Tambah input file baru
    function addFileInput() {
      const container = document.getElementById('file-inputs');
      const div = document.createElement('div');
      div.classList.add('file-input-group');
      div.innerHTML = `
        <input type="file" name="images[]" accept="image/*" class="no-print" onchange="previewImage(this)" />
        <div class="preview-container"></div>
      `;
      container.appendChild(div);
    }

    // Preview gambar saat pilih file
    // function previewImage(input) {
    //   const container = input.nextElementSibling; // preview-container
    //   container.innerHTML = '';
    //   if (input.files) {
    //     Array.from(input.files).forEach(file => {
    //       const reader = new FileReader();
    //       reader.onload = function(e) {
    //         const img = document.createElement('img');
    //         img.src = e.target.result;
    //         container.appendChild(img);
    //       }
    //       reader.readAsDataURL(file);
    //     });
    //   }
    // }
function previewImage(input) {
  const container = input.nextElementSibling;
  container.innerHTML = '';

  if (input.files) {
    Array.from(input.files).forEach(file => {
      const reader = new FileReader();
      reader.onload = function(e) {

        // Wrapper supaya bisa resize tanpa overlap
        const wrapper = document.createElement('div');
        wrapper.style.display = "inline-block";
        wrapper.style.resize = "both";
        wrapper.style.overflow = "hidden";
        wrapper.style.border = "1px solid #ccc";
        wrapper.style.padding = "5px";
        wrapper.style.background = "#fff";
        wrapper.style.width = "300px";        // ukuran default
        wrapper.style.minWidth = "150px";
        wrapper.style.minHeight = "100px";
        wrapper.style.boxSizing = "border-box";

        const img = document.createElement('img');
        img.src = e.target.result;
        img.style.width = "100%";
        img.style.height = "auto";
        img.style.display = "block";
        img.style.pointerEvents = "none";

        wrapper.appendChild(img);
        container.appendChild(wrapper);
      }
      reader.readAsDataURL(file);
    });
  }
}



  </script>

</body>
</html>

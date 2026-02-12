<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Berita Acara Pelaksanaan Stock Take</title>

  <!-- jsPDF & html2canvas CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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

    h2 {
      text-align: center;
      margin-top: -80px;
      margin-bottom: -75px;
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

      .print-hidden {
        display: none !important;
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
  </style>
</head>
<body>


    <div style="display: flex; align-items: center; gap: 20px;">
      <img src="https://1shamelin.com.my/wp-content/uploads/2020/09/MR-DIY-2-1.jpg" class="logo" alt="Logo MR.DIY" />
      <h2>Berita Acara Pelaksanaan Stock Take</h2>
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

    <p>
      Dengan ini menerangkan bahwa pelaksanaan <strong>stock take</strong> telah selesai dilakukan sesuai SOP dan sudah dipastikan tidak ada barang yang tidak lengkap (kurang part), tidak layak jual, dan/atau barang rusak yang terhitung / dihitung pada saat pelaksanaan ST, dengan data sebagai berikut:
    </p>

    <table>
      <tr><td>Barang DAMAGE</td><td><input type="text" class="input-small" /> SKU, <input type="text" class="input-small" /> PCS</td></tr>
 	<tr><td>Total Amount</td><td><input type="text" class="input"        /></td></tr>
    </table>

    <p>Demikian berita acara ini saya buat, untuk dapat dipergunakan sebagaimana mestinya.</p>

    <!-- Tanggal -->
    <div style="margin-top: 30px;">
      <span class="no-print">Tempat, Tanggal:</span>&nbsp;
      <input type="text" class="input-medium" placeholder="Kota" />&nbsp;,&nbsp;
      <input type="text" class="input-long" placeholder="Tanggal" />
    </div>

    <!-- Tanda Tangan -->
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

   <p style="font-size: 11px;"><i>*Lampirkan list SKU dan dokumentasi pemusnahan.</i></p>

  </div>

</body>
</html>

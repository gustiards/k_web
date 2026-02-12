<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DAMAGE REPORT</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0 auto;
    width: 793.7px;
    height: 1122.5px;
    padding: 20px;
    box-sizing: border-box;
    background-color: #f4f6f9;
    border: 1px solid #ddd;
    overflow: auto;
    position: relative;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #ffffff;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #4CAF50;
    color: white;
}

tfoot td {
    font-weight: bold;
}

.total-row {
    background-color: #f2f2f2;
}

/* MENU */
.menu {
    margin-bottom: 20px;
    text-align: center;
}

.menu button {
    margin: 5px;
    padding: 8px 15px;
    background-color: #4CAF50;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.menu button:hover {
    background-color: #000000;
}

/* PRINT TIDAK DIUBAH */
@media print {

    .menu {
        display: none;
    }

    body {
        width: auto;
        height: auto;
        margin: 0;
        padding: 0;
        background: white;
    }

    table, th, td {
        border: 1px solid black;
        color: black;
    }

    th {
        background-color: #fffb1b;
    }

    td {
        background-color: #ffffff;
    }

    th, td {
        height: 3px;
        padding: 3px;
        text-align: center;
    }

    tfoot {
        display: table-footer-group;
        page-break-before: always;
    }
}
</style>
</head>

<body>

<h2 id="reportTitle">DAMAGE REPORT</h2>

<!-- MENU -->
<div class="menu">
    <button onclick="addItem()">ADD ITEM</button>
    <button onclick="deleteItem()">DELETE ITEM</button>
    <button onclick="resetData()">RESET</button>
    <button onclick="editTitle()">EDIT TITLE</button>
    <button onclick="document.getElementById('fileUpload').click()">UPLOAD EXCEL</button>
    <button onclick="window.print()">PRINT</button>
    <input type="file" id="fileUpload" style="display:none" accept=".xlsx" onchange="uploadExcel(event)">
</div>

<table>
<thead>
<tr>
    <th>No</th>
    <th>SKU</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>QTY</th>
    <th>Harga Total</th>
    <th>Reason</th>
</tr>
</thead>

<tbody id="damageData"></tbody>

<tfoot>
<tr class="total-row">
    <td colspan="4">Total</td>
    <td id="totalQty">0</td>
    <td id="totalAmount">Rp 0</td>
    <td></td>
</tr>
</tfoot>
</table>

<script>

function formatCurrency(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID');
}

function displayData() {
    const data = JSON.parse(localStorage.getItem('damageData')) || [];
    let tbody = document.getElementById('damageData');
    tbody.innerHTML = '';
    let totalQty = 0;
    let totalAmount = 0;

    data.forEach((item, index) => {
        totalQty += item.qty;
        totalAmount += item.total;

        tbody.innerHTML += `
        <tr>
            <td>${index + 1}</td>
            <td>${item.sku}</td>
            <td>${item.nama}</td>
            <td>${formatCurrency(item.harga)}</td>
            <td>${item.qty}</td>
            <td>${formatCurrency(item.total)}</td>
            <td>${item.reason}</td>
        </tr>
        `;
    });

    document.getElementById('totalQty').innerText = totalQty;
    document.getElementById('totalAmount').innerText = formatCurrency(totalAmount);
}

function addItem() {
    let sku = prompt("SKU:");
    let nama = prompt("Nama Barang:");
    let harga = parseFloat(prompt("Harga:"));
    let qty = parseInt(prompt("QTY:"));
    let reason = prompt("Reason:");

    if (!sku || !nama || !harga || !qty) return alert("Data tidak lengkap!");

    let data = JSON.parse(localStorage.getItem('damageData')) || [];
    let total = harga * qty;

    data.push({ sku, nama, harga, qty, total, reason });
    localStorage.setItem('damageData', JSON.stringify(data));
    displayData();
}

function deleteItem() {
    let index = prompt("Nomor item yang ingin dihapus:");
    if (!index) return;

    let data = JSON.parse(localStorage.getItem('damageData')) || [];
    data.splice(index - 1, 1);
    localStorage.setItem('damageData', JSON.stringify(data));
    displayData();
}

function resetData() {
    if (confirm("Yakin reset semua data?")) {
        localStorage.removeItem('damageData');
        displayData();
    }
}

function editTitle() {
    let newTitle = prompt("Masukkan Judul Baru:");
    if (newTitle) {
        document.getElementById('reportTitle').innerText = newTitle;
        localStorage.setItem('reportTitle', newTitle);
    }
}

window.onload = function() {
    const savedTitle = localStorage.getItem('reportTitle');
    if (savedTitle) {
        document.getElementById('reportTitle').innerText = savedTitle;
    }
    displayData();
}

function uploadExcel(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: "array" });
        const sheet = workbook.Sheets[workbook.SheetNames[0]];
        const jsonData = XLSX.utils.sheet_to_json(sheet);

        const mappedData = jsonData.map((row) => {
            const harga = parseFloat(row.Harga);
            const qty = parseInt(row.QTY);
            return {
                sku: row.SKU || '',
                nama: row["Nama Barang"] || '',
                harga: harga,
                qty: qty,
                total: harga * qty,
                reason: row.Reason || ''
            };
        });

        localStorage.setItem("damageData", JSON.stringify(mappedData));
        displayData();
        alert("Data berhasil diunggah dari Excel!");
    };
    reader.readAsArrayBuffer(file);
}

</script>

</body>
</html>

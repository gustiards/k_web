@extends('layouts.app')

@section('title', 'Cetak Label A5')

@section('content')

<div class="container mx-auto px-6 py-10 no-print">

    <div class="bg-white shadow-xl rounded-xl p-8">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Cetak Label Keepstock - Stocktake A5
        </h1>

        <!-- Upload Section -->
        <div class="mb-6 flex flex-wrap items-center gap-4">
            <input type="file" 
                   id="excelFile" 
                   accept=".xlsx, .xls"
                   class="border p-3 rounded-lg w-64">

            <button onclick="generateLabels()" 
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                Generate Labels
            </button>

            <button onclick="window.print()" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                Print
            </button>
        </div>

    </div>

</div>

<!-- PRINT AREA -->
<div id="labelContainer"></div>

@endsection


@push('styles')
<style>

/* ===== PRINT FULL CONTROL ===== */
@page {
    size: A4 portrait;
    margin: 0;
}

body {
    margin: 0;
    font-family: 'Arial Black', Impact, sans-serif;
}

/* A4 PAGE */
.page {
    width: 210mm;
    height: 297mm;
    display: flex;
    flex-direction: column;
    background: white;
    page-break-after: always;
}

/* A5 LABEL */
.label-a5 {
    width: 210mm;
    height: 148.5mm;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* BOX */
.label-box {
    width: 180mm;
    height: 120mm;
    border: 2px solid black;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 10mm;
    box-sizing: border-box;
}

/* TEXT */
.kode-text {
    font-size: 110pt;
    font-weight: 950;
    text-align: center;
    border-bottom: 2px solid black;
}

.bottom-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.lokasi {
    font-size: 48pt;
    font-weight: 900;
}

.barcode svg {
    height: 60px;
}

.barcode-text {
    font-size: 14pt;
    font-family: Arial, sans-serif;
    margin-top: 5px;       /* Jarak dari barcode */
    width: 100%;
    text-align: center;    /* Pastikan sejajar */
}

/* ================= PRINT MODE ================= */
@media print {

    body * {
        visibility: hidden;
    }

    #labelContainer,
    #labelContainer * {
        visibility: visible;
    }

    #labelContainer {
        position: absolute;
        left: 0;
        top: 0;
        width: 210mm;
    }

    .no-print {
        display: none !important;
    }

}

</style>
@endpush


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script>
function generateLabels() {
    const fileInput = document.getElementById('excelFile');
    const file = fileInput.files[0];

    if (!file) {
        alert("Silakan upload file Excel terlebih dahulu.");
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {

        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: 'array' });

        const sheetName = workbook.SheetNames[0];
        const sheet = workbook.Sheets[sheetName];

        const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

        const headers = jsonData[0];
        const kodeIndex = headers.indexOf("KODE");
        const lokasiIndex = headers.indexOf("LOKASI");

        if (kodeIndex === -1 || lokasiIndex === -1) {
            alert("Kolom 'KODE' dan 'LOKASI' harus ada di file Excel!");
            return;
        }

        document.getElementById('labelContainer').innerHTML = '';

        for (let i = 1; i < jsonData.length; i += 2) {

            const page = document.createElement("div");
            page.className = "page";

            for (let j = 0; j < 2; j++) {

                const row = jsonData[i + j];

                if (row && row[kodeIndex] && row[lokasiIndex]) {

                    const kodeValue = row[kodeIndex];
                    const lokasiValue = row[lokasiIndex];

                    const label = document.createElement("div");
                    label.className = "label-a5";

                    const barcodeId = `barcode-${i + j}`;

                    label.innerHTML = `
                        <div class="label-box">
                            <div class="kode-text">${kodeValue}</div>
                            <div class="bottom-section">
                                <div class="lokasi">${lokasiValue}</div>
                                <div class="barcode">
                                    <svg id="${barcodeId}"></svg>
                                    <div class="barcode-text">${kodeValue}</div>
                                </div>
                            </div>
                        </div>
                    `;

                    page.appendChild(label);

                    setTimeout(() => {
                        JsBarcode(`#${barcodeId}`, kodeValue, {
                            format: "CODE128",
                            width: 2,
                            height: 60,
                            displayValue: false
                        });
                    }, 0);
                }
            }

            document.getElementById("labelContainer").appendChild(page);
        }
    };

    reader.readAsArrayBuffer(file);
}
</script>
@endpush

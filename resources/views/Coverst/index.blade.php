@extends('layouts.app')

@section('title', 'Rack Data Print')

@section('content')

<div class="container mx-auto px-6 py-8 no-print">

    <div class="bg-white shadow-xl rounded-xl p-6">

        <h2 class="text-xl font-bold mb-4">
            Upload file Excel dengan format kolom: NO | RACK | REFF | STATUS
        </h2>

        <input type="file" id="upload" accept=".xlsx, .xls"
               class="border p-2 rounded">

        <button onclick="window.print()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded ml-3">
            Print
        </button>

    </div>

</div>

<div id="output"></div>

@endsection


@push('styles')
 <style>
    body { 
      font-family: Arial, sans-serif; 
      margin: 20px; 
      text-align: center; 
    }
    h1 {
      margin: 10px 0;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 10px auto;
      font-size: 11px;
    }
    th, td {
      border: 1px solid black;
      padding: 5px;
      text-align: center;
    }
    th {
      background: #f2f2f2;
    }
    .section {
      margin: 10px auto;
      width: 95%;
    }
    .btn {
      margin: 10px;
      padding: 8px 16px;
      background: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }
    .btn:hover {
      background: #45a049;
    }

    /* PRINT SETTINGS */
    @media print {
      @page {
        size: A4 landscape; /* jadi A4 landscape */
        margin: 10mm;
      }
      body {
        margin: 0;
      }
      .no-print {
        display: none !important;
      }

      /* Layout kiri-kanan */
      .page {
        display: flex;
        flex-direction: row;
        height: 100%;
        page-break-before: always;
      }
      .page:first-child {
        page-break-before: auto;
      }

      .left {
        width: 50%;   /* tabel hanya di kiri */
        padding-right: 5mm;
      }
      .right {
        width: 50%;   /* kanan kosong */
      }
      
    }
  </style>
@endpush


@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>

document.getElementById('upload').addEventListener('change', handleFile, false);

function handleFile(e) {

    const file = e.target.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {

        const data = new Uint8Array(event.target.result);
        const workbook = XLSX.read(data, { type: 'array' });

        const sheetName = workbook.SheetNames[0];
        const sheet = workbook.Sheets[sheetName];
        const json = XLSX.utils.sheet_to_json(sheet, { header: 1 });

        const headers = json[0];
        const rows = json.slice(1);

        const grouped = {};

        rows.forEach(row => {

            if(row.length >= 2){

                let rack = row[1];
                let match = rack.match(/^([A-Z0-9]+)-(\d{1,3})$/i);

                if(match){

                    let prefix = match[1];
                    let endNum = parseInt(match[2]);

                    for(let i=1; i<=endNum; i++){

                        let num = i.toString().padStart(2, "0");
                        let expandedRack = `${prefix}-${num}`;

                        let newRow = [...row];
                        newRow[1] = expandedRack;

                        if (!grouped[prefix]) grouped[prefix] = [];
                        grouped[prefix].push(newRow);
                    }

                } else {

                    let groupKey = rack.substring(0,4);

                    if (!grouped[groupKey]) grouped[groupKey] = [];
                    grouped[groupKey].push([...row]);

                }
            }

        });

        // Reset numbering per group
        for (const group in grouped) {

            let counter = 1;

            grouped[group].forEach(r => {
                r[0] = counter++;
            });
        }

        let html = '';

        for (const group in grouped) {

            html += `
                <div class="page">
                    <div class="left">
                        <h1 style="font-size:20px; margin:0;">${group}</h1>
                        <p style="margin:5px 0 10px 0;">${grouped[group].length} ELEMENT</p>

                        <table>
                            <tr>
                                ${headers.map(h => `<th>${h}</th>`).join('')}
                            </tr>

                            ${grouped[group].map(r => `
                                <tr>
                                    ${headers.map((_,i) => `<td>${r[i]||''}</td>`).join('')}
                                </tr>
                            `).join('')}

                        </table>
                    </div>

                    <div class="right"></div>
                </div>
            `;
        }

        document.getElementById('output').innerHTML = html;
    };

    reader.readAsArrayBuffer(file);
}

</script>

@endpush

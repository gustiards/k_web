@extends('layouts.app')

@section('content')

<style>
    @media print {
        .no-print { display: none !important; }
        body { background: white; }
        .page { page-break-after: always; }
        input { border: none !important; }
    }

    .input-dotted {
        border: none;
        border-bottom: 1px dotted #000;
        outline: none;
        width: 100%;
    }

  .resizable {
    display: block;
    width: 100%;
    resize: both;
    overflow: auto;
    border: 1px dashed #aaa;
    padding: 6px;
    min-height: 200px;
    background: #fafafa;
    box-sizing: border-box;
}
#preview {
    align-items: start;
}
.resizable img {
    width: 100%;
    height: auto;
    display: block;
}
  h2 {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 10px;
    font-size: 40px;
}

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
        font-size: 14px;
    }

    th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    }

    thead {
        background: #f2f2f2;
        text-align: center;
    }

    @media print {
        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }
    }
</style>

{{-- ================= PAGE 1 ================= --}}
<div class="max-w-4xl mx-auto bg-white p-10 shadow page">

    <div class="flex items-center justify-center relative mb-6">
        <div class="absolute left-0">
            <img src="{{ asset('logo.png') }}" class="w-20">
        </div>

        <div class="text-center w-full">
            <input type="text"
                   class="text-xl font-bold text-center w-full"
                   value="{{ $heading ?? 'MR D.I.Y A YANI PLAJU TANGGA TAKAT' }}">

            <input type="text"
                   class="text-sm text-center w-full"
                   value="{{ $subheading ?? 'JL A YANI TANGGA TAKAT SEBERANG ULU II Palembang.' }}">
        </div>
    </div>

    <h2 class="text-lg font-calibri mb-6">
        <b>Berita Acara Penghancuran Barang Damage</b>
    </h2>
    <div class="h-4"></div>
    <p>Dengan Hormat,</p>
    <p>Saya yang bertanda tangan di bawah ini:</p>

    <div class="mt-4 space-y-3">
        @php
            $fields = ['Nama','NIK','Jabatan','Store','Hari/Tanggal Stock Take'];
        @endphp

        @foreach($fields as $field)
        <div class="flex items-center">
    <div class="w-40">{{ $field }}</div>
    <div class="mx-2">:</div>
    <div class="flex-1">
        <input type="text" class="input-dotted">
    </div>
</div>
        @endforeach
    </div>

    <div class="mt-6">
        <p contenteditable="true">
        Sehubungan dengan adanya Damage During Stock Take Store XPLA,
        sesuai SOP yang ada bahwa SKU tersebut harus dihancurkan
        pada saat Stock Take berlangsung.
        </p>
    </div>

    <div class="mt-6 space-y-2">
        <div class="flex items-center gap-2">
            <span class="w-32">Total SKU</span> :
            <input type="text" class="w-10"> SKU
        </div>
        <div class="flex items-center gap-2">
            <span class="w-32">Total QTY</span> :
            <input type="text" class="w-10"> PCS
        </div>
        <div class="flex items-center gap-2">
            <span class="w-32">Total Amount</span> :
            <input type="text" class="w-40">
        </div>
    </div>

    <p class="mt-6">
        Detail SKU dan QTY Damage During Stock Take yang dihancurkan sebagai berikut :
    </p>
</div>

{{-- ================= TABEL DAMAGE ================= --}}
<!-- <h3 style="margin-top:5px;">Lampiran List Damage</h3> -->

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>SKU</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>QTY</th>
            <th>Total</th>
            <th>Reason</th>
        </tr>
    </thead>
    <tbody id="damageListBA"></tbody>
    <tfoot>
        <tr style="font-weight:bold;">
            <td colspan="4" style="text-align:right;">TOTAL</td>
            <td id="totalQtyBA" style="text-align:center;">0</td>
            <td id="totalAmountBA" style="text-align:right;">Rp 0</td>
            <td></td>
        </tr>
    </tfoot>
</table>
<div style="page-break-before: always;"></div>
{{-- ================= PAGE 2 ================= --}}
<div class="max-w-4xl mx-auto bg-white p-10 shadow mt-10 page">
    <h2 class="text-lg font-semibold mb-6 text-center">
        Dokumentasi Penghancuran Damage
    </h2>

    <div class="no-print mb-4">
        <input type="file"
               id="imageUpload"
               multiple
               accept="image/*"
               class="border p-2">
    </div>

    <div id="preview" class="grid md:grid-cols-2 grid-cols-1 gap-6 items-start"></div>
</div>

{{-- ================= PAGE 3 ================= --}}
<div class="max-w-4xl mx-auto bg-white p-10 shadow mt-10 page">
    <p contenteditable="true">
        Demikian berita acara during stock take di store XPLA,
        atas perhatiannya saya ucapkan terima kasih.
    </p>

    <div class="mt-20 grid grid-cols-3 text-center">
        <div>
            <p>Hormat saya,</p>
            <p class="font-semibold">Asst. Branch Manager</p>
            <div class="h-24"></div>
            <span>(</span>
            <input type="text" class="border-b border-black text-center w-40 mx-1">
            <span>)</span>
        </div>

        <div>
            <p>Diketahui,</p>
            <p class="font-semibold">Branch Manager</p>
            <div class="h-24"></div>
            <span>(</span>
            <input type="text" class="border-b border-black text-center w-40 mx-1">
            <span>)</span>
        </div>

        <div>
            <p>Disetujui,</p>
            <p class="font-semibold">Division Manager</p>
            <div class="h-24"></div>
            <span>(</span>
            <input type="text" class="border-b border-black text-center w-40 mx-1">
            <span>)</span>
        </div>
    </div>

    <div class="text-center my-10 no-print">
        <button onclick="window.print()"
                class="bg-blue-600 text-white px-6 py-2 rounded shadow">
            Print
        </button>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>
function formatCurrency(amount) {
    return 'Rp ' + Number(amount).toLocaleString('id-ID');
}

function loadDamageFromStorage() {
    const data = JSON.parse(localStorage.getItem('damageData')) || [];
    const tbody = document.getElementById('damageListBA');

    let totalQty = 0;
    let totalAmount = 0;
    tbody.innerHTML = '';

    if (data.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align:center;">Tidak ada data damage</td>
            </tr>
        `;
    } else {
        data.forEach((item, index) => {
            const qty = Number(item.qty) || 0;
            const harga = Number(item.harga) || 0;
            const total = qty * harga;

            totalQty += qty;
            totalAmount += total;

            tbody.innerHTML += `
                <tr>
                    <td style="text-align:center;">${index + 1}</td>
                    <td>${item.sku ?? '-'}</td>
                    <td>${item.nama ?? '-'}</td>
                    <td style="text-align:right;">${formatCurrency(harga)}</td>
                    <td style="text-align:center;">${qty}</td>
                    <td style="text-align:right;">${formatCurrency(total)}</td>
                    <td>${item.reason ?? '-'}</td>
                </tr>
            `;
        });
    }

    document.getElementById('totalQtyBA').innerText = totalQty;
    document.getElementById('totalAmountBA').innerText = formatCurrency(totalAmount);
}

window.onload = function() {
    loadDamageFromStorage();
};

const upload = document.getElementById('imageUpload');
const preview = document.getElementById('preview');

if(upload){
    upload.addEventListener('change', function(e) {
        [...e.target.files].forEach(file => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const container = document.createElement('div');
                container.className = "resizable";
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = "w-full";
                container.appendChild(img);
                preview.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    });
}
</script>

@endsection
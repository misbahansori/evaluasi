<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title style="text-transform: uppercase">
        {{ $periode->pegawai->nama }} | {{ ucfirst($periode->tipe) }} | Periode {{ $periode->namaBulan }} {{ $periode->tahun }}
    </title>
    <style>
        @page {
            margin: 30px 20px ;
        }
        .table {
            border-collapse: collapse;
            /* width: 100%; */
        }

        .table td, .table th {
            border: 1px solid #111;
            padding: 5px;
        }

        .table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <img src="{{ asset('/img/logo-rsumm.png') }}" width="85" height="85" style="margin-left: 30; margin-top: 10; position: absolute">
    <div style="text-align: center; font-size: 8px; margin: 0px 20px;">
        <h1>HASIL PENILAIAN KINERJA PEGAWAI</h1>
        <h1>RSU MUHAMMADIYAH METRO</h1>
        <h1 style="text-transform: uppercase">PERIODE {{ $periode->tipe }} {{ $periode->namaBulan }} {{ $periode->tahun }}</h1>
        <hr>
    </div>
    <table style="margin: 20px;">
        <tr>
            <td style="width: 150px;">Nama Pegawai</td>
            <td>:</td>
            <td style="font-weight: bold">{{ $periode->pegawai->nama }}</td>
        </tr>
        <tr>
            <td style="width: 150px;">Unit Kerja</td>
            <td>:</td>
            <td>{{ $periode->pegawai->unit->name }}</td>
        </tr>
        <tr>
            <td style="width: 150px;">NBM</td>
            <td>:</td>
            <td>{{ $periode->pegawai->nbm }}</td>
        </tr>
        <tr>
            <td style="width: 150px;">Formasi Tugas</td>
            <td>:</td>
            <td>{{ $periode->pegawai->formasi->nama }}</td>
        </tr>
    </table>
    <div style="margin: 0 25px;">
        <h4>A. PENILAIAN</h4>
    </div>
    <table class="table" style="margin:10px 20px;">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle">No</th>
                <th rowspan="2" style="vertical-align: middle; text-align: center;">Aspek Penilaian</th>
                <th colspan="5" style="text-align: center">Nilai</th>
            </tr>
            <tr>
                <th style="text-align: center;">1</th>
                <th style="text-align: center;">2</th>
                <th style="text-align: center;">3</th>
                <th style="text-align: center;">4</th>
                <th style="text-align: center;">5</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->nilai->groupBy('kategori')->sortKeys() as $grouped)
                <tr>
                    <th colspan="7">{{ $grouped->first()->kategori }}</th>
                </tr>
                @foreach ($grouped as $key => $nilai)
                    <tr>
                        <td style="width: 20px; text-align:center;">{{ $loop->iteration }}</td>
                        <td>{{ $nilai->aspek }}</td>
                        @for ($i = 1; $i <= 5; $i++)
                            <td style="font-family: DejaVu Sans, sans-serif; text-align:center; width: 25px;">
                                {{ $nilai->nilai == $i ? '✔' : '' }}
                            </td>
                        @endfor
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td colspan="2">Element Penilaian</td>
                <td colspan="5" style="text-align: center; font-weight: bold;">{{ $periode->nilai->count() }}</td>
            </tr>
            <tr>
                <td colspan="2">Total Nilai</td>
                <td colspan="5" style="text-align: center; font-weight: bold;">{{ $periode->totalNilai() }}</td>
            </tr>
            <tr>
                <td colspan="2">Rata-rata Nilai</td>
                <td colspan="5" style="text-align: center; font-weight: bold;">{{ $periode->rataNilai() }}</td>
            </tr>
            <tr>
                <td colspan="2">Keterangan</td>
                <td colspan="5" style="text-align: center; font-weight: bold;">
                    @if ($periode->rataNilai() <= 3)
                        TIDAK DISARANKAN
                    @else
                        DISARANKAN
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <div style="margin: 0 25px;">
        <h4 style="margin-bottom: 3px;">B. CATATAN</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum laborum rem ipsum nam blanditiis dolore beatae pariatur qui, temporibus eaque! Rerum cupiditate vel quisquam maxime sit nemo eligendi repellendus quos?</p>
    </div>
    <div style="margin: 0 25px;">
        <h4 style="margin-bottom: 3px;">C. HAL YANG PERLU DITINGKATKAN</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum laborum rem ipsum nam blanditiis dolore beatae pariatur qui, temporibus eaque! Rerum cupiditate vel quisquam maxime sit nemo eligendi repellendus quos?</p>
    </div>
    <div style="margin: 0 25px;">
        <h4 style="margin-bottom: 3px;">D. HAL YANG PERLU DIPERTAHANKAN</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum laborum rem ipsum nam blanditiis dolore beatae pariatur qui, temporibus eaque! Rerum cupiditate vel quisquam maxime sit nemo eligendi repellendus quos?</p>
    </div>
    <table  class="table" style="margin:10px 20px; width: 100%;">
        <tr>
            <td style="text-align: center; width: 50%; padding: 10px;">
                <h4>PENILAI I</h4>
                <p style="margin-top: 70px;">@for ($i = 1; $i < 40; $i++).@endfor</p>
                <div style="margin-top:-17px;">NBM : @for ($i = 1; $i < 15; $i++) &nbsp; @endfor</div>
            </td>
            <td style="text-align: center; width: 50%; padding: 10px;">
                <h4>PEGAWAI</h4>
                <p style="margin-top: 70px; text-decoration: underline; font-weight: bold;">{{ $periode->pegawai->nama }}</p>
                <div style="margin-top:-17px;">NBM : {{ $periode->pegawai->nbm ?? '-' }}</div>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; width: 50%; padding: 10px">
                <h4>DIREKTUR/WAKIL DIREKTUR</h4>
                <p style="margin-top: 70px;">@for ($i = 1; $i < 40; $i++).@endfor</p>
                <div style="margin-top:-17px;">NBM : @for ($i = 1; $i < 15; $i++) &nbsp; @endfor</div>
            </td>
            <td style="text-align: center; width: 50%; padding : 10px;">
                <h4>PENILAI II</h4>
                <p style="margin-top: 70px; font">@for ($i = 1; $i < 40; $i++).@endfor</p>
                <div style="margin-top:-17px;">NBM : @for ($i = 1; $i < 15; $i++) &nbsp; @endfor</div>
            </td>
        </tr>
    </table>
</body>

</html>
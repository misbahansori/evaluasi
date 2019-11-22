<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        @page {
            margin: 0;
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
    <div style="text-align: center; font-size: 8px; margin: 20px;">
        <h1>HASIL PENILAIAN KINERJA PEGAWAI KONTRAK</h1>
        <h1>RSU MUHAMMADIYAH METRO</h1>
        <hr>
    </div>
    <table style="margin: 20px; width: 50%">
        <tr>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>{{ $periode->pegawai->unit->name }}</td>
        </tr>
        <tr>
            <td>Periode Penilaian</td>
            <td>:</td>
            <td>{{ $periode->bulan->nama }} {{ $periode->tahun }}</td>
        </tr>
        <tr>
            <td>Nama Pegawai</td>
            <td>:</td>
            <td>{{ $periode->pegawai->nama }}</td>
        </tr>
        <tr>
            <td>NBM</td>
            <td>:</td>
            <td>{{ $periode->pegawai->nbm }}</td>
        </tr>
        <tr>
            <td>Formasi Tugas</td>
            <td>:</td>
            <td>{{ $periode->pegawai->formasi->nama }}</td>
        </tr>
    </table>
    <table class="table" style="margin:20px;">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle">No</th>
                <th rowspan="2" style="vertical-align: middle">Aspek Penilaian</th>
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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $nilai->aspek }}</td>
                        @for ($i = 1; $i <= 5; $i++)
                            <td style="font-family: DejaVu Sans, sans-serif; text-align:center;">
                                {{ $nilai->nilai == $i ? '✔' : '' }}
                            </td>
                        @endfor
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
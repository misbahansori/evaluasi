<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title style="text-transform: uppercase">
        {{ $periode->pegawai->nama }} | {{ ucfirst($periode->tipe) }} | Periode {{ $periode->namaBulan }} {{ $periode->tahun }}
    </title>
    <link rel="stylesheet" href="{{ asset('css/report.css') }}">
</head>

<body>
    <table class="table">
        <tr>
            <td style="width: 25%; height: 52px;">
                <img src="{{ asset('/img/logo-rsumm.jpg') }}" height="52">
            </td>
            <td style="width: 50%" class="uppercase text-center leading-tight">
                <h4>Hasil Penilaian Kinerja Komite</h4>
                <h4>Rsu Muhammadiyah Metro</h4>
                <h4>Periode {{ $periode->tipe }} {{ $periode->namaBulan }} {{ $periode->tahun }}</h4>
            </td>
            <td style="width: 25%; height: 52px; text-align: right">
                <img src="{{ asset('/img/logo-kars.jpg') }}" height="46">
            </td>
        </tr>
    </table>
    <hr style="margin:0px;">
    <table class="table leading-tight">
        <tr>
            <td class="font-bold">Nama Karyawan</td>
            <td>:</td>
            <td>{{ $periode->pegawai->nama }}</td>

            <td class="font-bold">Unit Kerja</td>
            <td>:</td>
            <td>{{ $periode->pegawai->unit->name }}</td>
        </tr>
        <tr>
            <td class="font-bold">NBM</td>
            <td>:</td>
            <td>{{ $periode->pegawai->nbm }}</td>

            <td class="font-bold">Formasi Tugas</td>
            <td>:</td>
            <td>{{ $periode->pegawai->formasi->nama }}</td>
        </tr>
        <tr>
            <td class="font-bold">Komite</td>
            <td>:</td>
            <td>{{ $periode->pegawai->komite->nama }}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="margin-top: 5px; margin-right: 25px;">
        <thead>
            <tr>
                <th style="vertical-align: middle" class="leading-none">No</th>
                <th colspan="2" style="vertical-align: middle; text-align: center;" class="leading-none">Aspek Penilaian Komite</th>
                <th style="text-align: center" class="leading-none">Checklist</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->nilai->groupBy('kategori')->sortKeys() as $grouped)
                <tr>
                    <th colspan="4">{{ $grouped->first()->kategori }}</th>
                </tr>
                @foreach ($grouped as $key => $nilai)
                    <tr>
                        <td style="width: 20px; text-align:center;">{{ $loop->iteration }}</td>
                        <td colspan="2">{{ $nilai->aspek }}</td>
                        <td style="font-family: DejaVu Sans, sans-serif; text-align:center; width: 25px;">
                            {{ $nilai->nilai === 1 ? '✔' : '' }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td rowspan="4" colspan="2"></td>
                <td style="width: 180px">Dikerjakan</td>
                <td style="text-align: center; font-weight: bold;">{{ $periode->jumlahDikerjakan() }}</td>
            </tr>
            <tr>
                <td style="width: 180px">Tidak Dikerjakan</td>
                <td style="text-align: center; font-weight: bold;">{{ $periode->jumlahTidakDikerjakan() }}</td>
            </tr>
            <tr>
                <td style="width: 180px">Persentase</td>
                <td style="text-align: center; font-weight: bold;">{{ $periode->persentase() }} %</td>
            </tr>
            <tr>
                <td style="width: 180px">Total Elemen Penilaian</td>
                <td style="text-align: center; font-weight: bold;">{{ $periode->nilai->count() }}</td>
            </tr>
        </tbody>
    </table>   

    @foreach($periode->catatan as $catatan)
        <div style="margin: 10px 0">
            <h4>{{ $catatan->tipe }}</h4>
            <p>{{ $catatan->isi }}</p>
        </div>
    @endforeach

    <table class="table">
        <tr>
            <td class="text-center" style="padding: 10px;">
                <h4 style="margin-bottom: 40px">ATASAN LANGSUNG</h4>
                <p>@for ($i = 1; $i < 40; $i++).@endfor</p>
                <div>NBM : @for ($i = 1; $i < 15; $i++) &nbsp; @endfor</div>
            </td>
            <td class="text-center" style="padding: 10px;">
                <h4 style="margin-bottom: 40px">KARYAWAN</h4>
                <p class="underline">{{ $periode->pegawai->nama }}</p>
                <div>NBM : {{ $periode->pegawai->nbm ?? '-' }}</div>
            </td>
        </tr>
        <tr>
            <td class="text-center" style="padding: 10px;">
                <h4 style="margin-bottom: 40px">DIREKTUR/WAKIL DIREKTUR</h4>
                <p>@for ($i = 1; $i < 40; $i++).@endfor</p>
                <div>NBM : @for ($i = 1; $i < 15; $i++) &nbsp; @endfor</div>
            </td>
            <td class="text-center" style="padding: 10px;">
                <h4 style="margin-bottom: 40px">WAKIL DIREKTUR BINDATRA</h4>
                <p class="underline">Abdurrahim Hamdi, MA</p>
                <div>NBM : 993421</div>
            </td>
        </tr>
    </table>
</body>

</html>
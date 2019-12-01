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
            <td style="width: 84px; height: 84px;">
                <img src="{{ asset('/img/logo-rsumm.jpg') }}" width="84" height="84">
            </td>
            <td class="uppercase text-center leading-relaxed">
                <h4>Hasil Penilaian Kinerja Pegawai</h4>
                <h4>Rsu Muhammadiyah Metro</h4>
                <h4>Periode {{ $periode->tipe }} {{ $periode->namaBulan }} {{ $periode->tahun }}</h4>
            </td>
            <td style="width: 84px; height: 84px;">&nbsp;</td>
        </tr>
    </table>
    <hr>
    <table class="table leading-snug">
        <tr>
            <td>Nama Pegawai</td>
            <td>:</td>
            <td>{{ $periode->pegawai->nama }}</td>

            <td>Unit Kerja</td>
            <td>:</td>
            <td>{{ $periode->pegawai->unit->name }}</td>
        </tr>
        <tr>
            <td>NBM</td>
            <td>:</td>
            <td>{{ $periode->pegawai->nbm }}</td>

            <td>Formasi Tugas</td>
            <td>:</td>
            <td>{{ $periode->pegawai->formasi->nama }}</td>
        </tr>
    </table>

    <h4 style="margin: 15px 0">A. PENILAIAN</h4>

    <table class="table table-bordered">
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

    @if ($periode->catatan)
        <div style="margin: 10px 0">
            <h4 style="margin-bottom: 3px;">B. CATATAN</h4>
            <p>{{ $periode->catatan }}</p>
        </div>
    @endif
    @if ($periode->ditingkatkan)
        <div style="margin: 10px 0">
            <h4 style="margin-bottom: 3px;">C. HAL YANG PERLU DITINGKATKAN</h4>
            <p>{{ $periode->ditingkatkan }}</p>
        </div>
    @endif
    @if ($periode->dipertahankan)
        <div style="margin: 10px 0">
            <h4 style="margin-bottom: 3px;">D. HAL YANG PERLU DIPERTAHANKAN</h4>
            <p>{{ $periode->dipertahankan }}</p>
        </div>
    @endif

    <table class="table">
        <tr>
            <td class="text-center" style="padding: 15px;">
                <h4 style="margin-bottom: 50px">PENILAI I</h4>
                <p>@for ($i = 1; $i < 40; $i++).@endfor</p>
                <div>NBM : @for ($i = 1; $i < 15; $i++) &nbsp; @endfor</div>
            </td>
            <td class="text-center" style="padding: 15px;">
                <h4 style="margin-bottom: 50px">PEGAWAI</h4>
                <p class="underline">{{ $periode->pegawai->nama }}</p>
                <div>NBM : {{ $periode->pegawai->nbm ?? '-' }}</div>
            </td>
        </tr>
        <tr>
            <td class="text-center" style="padding: 15px;">
                <h4 style="margin-bottom: 50px">DIREKTUR/WAKIL DIREKTUR</h4>
                <p>@for ($i = 1; $i < 40; $i++).@endfor</p>
                <div>NBM : @for ($i = 1; $i < 15; $i++) &nbsp; @endfor</div>
            </td>
            <td class="text-center" style="padding: 15px;">
                <h4 style="margin-bottom: 50px">PENILAI II</h4>
                <p>@for ($i = 1; $i < 40; $i++).@endfor</p>
                <div>NBM : @for ($i = 1; $i < 15; $i++) &nbsp; @endfor</div>
            </td>
        </tr>
    </table>
</body>

</html>
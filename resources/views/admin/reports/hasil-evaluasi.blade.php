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
                <h4>Hasil Penilaian Kinerja Karyawan</h4>
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
            <td>Nama Karyawan</td>
            <td>:</td>
            <td class="font-bold">{{ $periode->pegawai->nama }}</td>

            <td>Unit Kerja</td>
            <td>:</td>
            <td class="font-bold">{{ $periode->pegawai->unit->name }}</td>
        </tr>
        <tr>
            <td>NBM</td>
            <td>:</td>
            <td class="font-bold">{{ $periode->pegawai->nbm }}</td>

            <td>Formasi Tugas</td>
            <td>:</td>
            <td class="font-bold">{{ $periode->pegawai->formasi->nama }}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="margin-top: 5px;">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle" class="leading-none">No</th>
                <th colspan="3" rowspan="2" style="vertical-align: middle; text-align: center;" class="leading-none">Aspek Penilaian</th>
                <th colspan="5" style="text-align: center" class="leading-none">Nilai</th>
            </tr>
            <tr>
                <th style="text-align: center;" class="leading-none">1</th>
                <th style="text-align: center;" class="leading-none">2</th>
                <th style="text-align: center;" class="leading-none">3</th>
                <th style="text-align: center;" class="leading-none">4</th>
                <th style="text-align: center;" class="leading-none">5</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->nilai->groupBy('kategori')->sortKeys() as $grouped)
                <tr>
                    <th colspan="9">{{ $grouped->first()->kategori }}</th>
                </tr>
                @foreach ($grouped as $key => $nilai)
                    <tr>
                        <td style="width: 20px; text-align:center;">{{ $loop->iteration }}</td>
                        <td colspan="3">{{ $nilai->aspek }}</td>
                        @for ($i = 1; $i <= 5; $i++)
                            <td style="font-family: DejaVu Sans, sans-serif; text-align:center; width: 25px;">
                                {{ $nilai->nilai == $i ? '✔' : '' }}
                            </td>
                        @endfor
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td rowspan="3" colspan="3" style="padding-left: 10px;">
                    <div class="font-bold">KETERANGAN</div>
                    {{-- jika status pegawai adalah pegawai kontrak --}}
                    @if ($periode->pegawai->status_id == 3)
                        <div style="margin:0; padding:0; line-height: .8em;">
                            <div>Rata-rata Al-Islam & Kemuhammadiyahan <span style="font-family: DejaVu Sans, sans-serif">&lt;</span> 3 &nbsp;: TIDAK DISARANKAN</div>
                            <div>Rata-rata Al-Islam & Kemuhammadiyahan <span style="font-family: DejaVu Sans, sans-serif">&ge;</span> 3  &nbsp;: DISARANKAN</div>
                            <div>Rata-rata Kompetensi <span style="font-family: DejaVu Sans, sans-serif">&lt;</span> 3 &nbsp;: TIDAK DISARANKAN</div>
                            <div>Rata-rata Kompetensi <span style="font-family: DejaVu Sans, sans-serif">&ge;</span> 3  &nbsp;: DISARANKAN</div>
                        <div>
                    @else
                        <div style="margin:0; padding:0; line-height: .8em;">
                            <div>Rata-rata <span style="font-family: DejaVu Sans, sans-serif">&ge;</span> 4,5 - 5,0  &nbsp;: ISTIMEWA</div>
                            <div>Rata-rata <span style="font-family: DejaVu Sans, sans-serif">&ge;</span> 3,5 - 4,49 &nbsp;: BAIK</div>
                            <div>Rata-rata <span style="font-family: DejaVu Sans, sans-serif">&ge;</span> 2,5 - 3,49 &nbsp;: CUKUP</div>
                            <div>Rata-rata <span style="font-family: DejaVu Sans, sans-serif">&ge;</span> 1,5 - 2,49 &nbsp;: KURANG</div>
                            <div>Rata-rata <span style="font-family: DejaVu Sans, sans-serif">&lt;</span> 1,5        &nbsp;: SANGAT KURANG</div>
                        <div>
                    @endif
                </td>
                <td style="width: 180px;">Rata-rata AIK</td>
                <td colspan="5" style="text-align: center; font-weight: bold;">{{ $periode->rataNilaiAik() }}</td>
            </tr>
            <tr>
                <td style="width: 180px;">Rata-rata Kompetensi</td>
                <td colspan="5" style="text-align: center; font-weight: bold;">{{ $periode->rataNilaiBiasa() }}</td>
            </tr>
            <tr>
                <td style="width: 180px;">
                    @if ($periode->pegawai->status_id == 3)
                        Rekomendasi
                    @else
                        Keterangan
                    @endif
                </td>
                <td colspan="5" style="text-align: center; font-weight: bold;">
                    {{-- jika status pegawai adalah pegawai kontrak --}}
                    @if ($periode->pegawai->status_id == 3)
                        @if ($periode->rataNilaiAik() < 3 || $periode->rataNilaiBiasa() < 3)
                            TIDAK DISARANKAN 
                        @else 
                            DISARANKAN
                        @endif
                    @else
                    @if ($periode->rataNilai() >= 4.5)
                        ISTIMEWA
                    @elseif($periode->rataNilai() >= 3.5 && $periode->rataNilai() < 4.5)
                        BAIK
                    @elseif($periode->rataNilai() >= 2.5 && $periode->rataNilai() < 3.5)
                        CUKUP
                    @elseif($periode->rataNilai() >= 1.5 && $periode->rataNilai() < 2.5)
                        KURANG
                    @else 
                        SANGAT KURANG
                    @endif
                    @endif
                </td>
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
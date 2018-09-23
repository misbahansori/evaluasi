<table class="table table-bordered">
    <tr>
        <td>NBM</td>
        <td>:</td>
        <td>{{ $pegawai->nbm }}</td>

        <td>Verifikasi Kabag / Kabid</td>
        <td>:</td>
        <td>
            @if ($periode->verif_kabag)
                <span class="badge badge-primary">Terverifikasi</span> 
                <br>
                <small>{{ $periode->verif_kabag->formatLocalized('%A, %d %B %Y') }}</small>
            @else
                <span class="badge badge-warning">Belum Diverifikasi</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $pegawai->nama }}</td>

        <td>Verifikasi Wakil Direktur</td>
        <td>:</td>
        <td>
            @if ($periode->verif_wadir)
                <span class="badge badge-primary">Terverifikasi</span>
                <br>
                <small>{{ $periode->verif_wadir->formatLocalized('%A, %d %B %Y') }}</small>
            @else
                <span class="badge badge-warning">Belum Diverifikasi</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Unit</td>
        <td>:</td>
        <td>{{ optional($periode->pegawai->unit)->nama }}</td>
    </tr>
    <tr>
        <td>Bagian</td>
        <td>:</td>
        <td>{{ optional($pegawai->bagian)->nama }}</td>
    </tr>
</table>
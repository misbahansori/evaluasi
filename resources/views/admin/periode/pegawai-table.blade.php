<table class="table table-bordered">
    <tr>
        <td>NBM</td>
        <td>:</td>
        <td>{{ $pegawai->nbm }}</td>

        <td>Update Karu / Kasie</td>
        <td>:</td>
        <td>{{ optional($periode->updated_at)->formatLocalized('%A, %d %B %Y') }}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><a href="{{ route('pegawai.show', $pegawai->id) }}">{{ $pegawai->nama }}</a></td>
        
        <td>Verifikasi Kabag / Kabid</td>
        <td>:</td>
        <td>
            <verifikasi-component 
                :can-verif="{{ auth()->user()->hasPermissionTo('verif kabag') ? 'true' : 'false' }}"
                verifikasi="{{ $periode->verif_kabag }}" 
                action="{{ route('verif.kabag', $periode->id) }}"
            ></verifikasi-component>
        </td>
    </tr>
    <tr>
        <td>Unit / Ruangan</td>
        <td>:</td>
        <td>{{ optional($periode->pegawai->unit)->name }}</td>

        <td>Verifikasi Wakil Direktur</td>
        <td>:</td>
        <td>
            <verifikasi-component 
                :can-verif="{{ auth()->user()->hasPermissionTo('verif wadir') ? 'true' : 'false' }}"
                verifikasi="{{ $periode->verif_wadir }}" 
                action="{{ route('verif.wadir', $periode->id) }}"
            ></verifikasi-component>
        </td>
    </tr>
    <tr>
        <td>Bagian</td>
        <td>:</td>
        <td>{{ optional($pegawai->bagian)->nama }}</td>

        <td>Verifikasi Direktur</td>
        <td>:</td>
        <td>
            <verifikasi-component 
                :can-verif="{{ auth()->user()->hasPermissionTo('verif direktur') ? 'true' : 'false' }}"
                verifikasi="{{ $periode->verif_direktur }}" 
                action="{{ route('verif.direktur', $periode->id) }}"
            ></verifikasi-component>
        </td>
    </tr>
    <tr>
        <td>Satus Kepegawaian</td>
        <td>:</td>
        <td>{{ optional($pegawai->status)->nama }}</td>

        <td>Komite</td>
        <td>:</td>
        <td>{{ optional($pegawai->komite)->nama }}</td>
    </tr>
</table>
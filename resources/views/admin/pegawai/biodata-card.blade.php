<div class="col-md-8">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between">
            <h4>Biodata Pegawai</h4>
            @can('edit pegawai')
                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-info btn-sm">
                    <i class="ti-pencil-alt"></i> Edit Pegawai
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table">
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $pegawai->nik }}</td>
                </tr>
                <tr>
                    <td>NBM</td>
                    <td>:</td>
                    <td>{{ $pegawai->nbm }}</td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>{{ $pegawai->nama }}</td>
                </tr>
                <tr>
                    <td>Tempat Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $pegawai->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $pegawai->alamat }}</td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>:</td>
                    <td>{{ $pegawai->no_hp }}</td>
                </tr>
                <tr>
                    <td>Formasi</td>
                    <td>:</td>
                    <td>{{ optional($pegawai->formasi)->nama }}</td>
                </tr>
                <tr>
                    <td>Unit / Ruangan</td>
                    <td>:</td>
                    <td>{{ optional($pegawai->unit)->name }}</td>
                </tr>
                <tr>
                    <td>Bagian</td>
                    <td>:</td>
                    <td>{{ optional($pegawai->bagian)->nama }}</td>
                </tr>
                <tr>
                    <td>Status Kepegawaian</td>
                    <td>:</td>
                    <td>{{ optional($pegawai->status)->nama }}</td>
                </tr>
                <tr>
                    <td>Tanggal Masuk</td>
                    <td>:</td>
                    <td>{{ $pegawai->tanggal_masuk }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
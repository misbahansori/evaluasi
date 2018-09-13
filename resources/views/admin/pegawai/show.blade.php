@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Biodata Pegawai</h4>
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
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>{{ $pegawai->kecamatan }}</td>
                    </tr>
                    <tr>
                        <td>Kabupaten / Kota</td>
                        <td>:</td>
                        <td>{{ $pegawai->kabupaten }}</td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>:</td>
                        <td>{{ $pegawai->provinsi }}</td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td>{{ $pegawai->no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Unit</td>
                        <td>:</td>
                        <td>{{ $pegawai->unit->nama }}</td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td>:</td>
                        <td>{{ $pegawai->bagian->nama }}</td>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Penilaian</h5>
                    <a href="{{ route('periode.create', $pegawai->id) }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-pencil"></i> Tambah Periode
                    </a>
                </div>
                <div class="card-body">
                    <table class="table">
                        @foreach ($pegawai->periode as $periode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $periode->bulan->nama }} {{ $periode->tahun }}</td>
                                <td>
                                    <form action="{{ route('periode.destroy', [$pegawai->id, $periode->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('periode.show', [$pegawai->id, $periode->id]) }}" class="btn btn-success btn-sm">
                                            <i class="ti ti-view-list-alt"></i> Detail
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus')">
                                            <i class="ti ti-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
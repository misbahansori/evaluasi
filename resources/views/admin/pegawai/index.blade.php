@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @can('tambah pegawai')
                    <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm mb-4">
                        <i class="ti-pencil"></i> Tambah Pegawai
                    </a>
                @endcan
            </div>
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Daftar Pegawai</h4>
                </div>

                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NBM</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>Unit</th>
                                <th>Bagian</th>
                                <th>Formasi</th>
                                <th>Status</th>
                                <th>Komite</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listPegawai as $pegawai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pegawai->nbm }}</td>
                                    <td>{{ $pegawai->nama }}</td>
                                    <td>{{ $pegawai->alamat }}</td>
                                    <td>{{ $pegawai->tanggal_lahir }}</td>
                                    <td>{{ optional($pegawai->unit)->name }}</td>
                                    <td>{{ optional($pegawai->bagian)->nama }}</td>
                                    <td>{{ optional($pegawai->formasi)->nama }}</td>
                                    <td>{{ optional($pegawai->status)->nama }}</td>
                                    <td>{{ optional($pegawai->komite)->nama }}</td>
                                    <th>
                                        <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-success btn-sm">
                                            <i class="ti ti-write"></i> Biodata
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('includes.datatable')
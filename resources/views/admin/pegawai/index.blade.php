@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar Pegawai</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tanggal Lahir</th>
                                <th>Unit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listPegawai as $pegawai)
                                <tr>
                                    <td>{{ $pegawai->nama }}</td>
                                    <td>{{ $pegawai->alamat }}</td>
                                    <td>{{ $pegawai->tanggal_lahir }}</td>
                                    <td>{{ $pegawai->unit->nama }}</td>
                                    <th>
                                        <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-success btn-sm">Biodata</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
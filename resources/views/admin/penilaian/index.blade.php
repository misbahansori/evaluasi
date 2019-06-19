@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>
                        Penilaian Pegawai Bulan 
                        {{ \Carbon\Carbon::createFromFormat('m', request()->bulan)->formatLocalized('%B') }} 
                        {{ request()->tahun }}
                    </h4>
                    <form action="{{ route('penilaian.index') }}" method="GET" class="form-inline">

                        <div class="custom-control custom-checkbox mr-5">
                            <input type="checkbox" class="custom-control-input" id="terverifikasiKabag" name="terverifikasiKabag" value="true" {{ request()->terverifikasiKabag == 'true' ? 'checked' : '' }} onclick="this.form.submit()">
                            <label class="custom-control-label" for="terverifikasiKabag">Tampilkan hanya yg terverifikasi Kabag</label>
                        </div>

                        <select name="bulan" id="bulan" class="form-control mr-2">
                            @foreach ($listBulan as $bulan)
                                <option {{ request()->bulan == $bulan->id ? 'selected' : '' }} value="{{ $bulan->id }}">{{ $bulan->nama }}</option>
                            @endforeach
                        </select>
                        <select name="tahun" id="tahun" class="form-control mr-2">
                            @for ($i = $tahunIni - 2; $i < $tahunIni + 5; $i++)
                                <option {{ request()->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <button type="submit" class="btn btn-info">
                            <i class="ti-search"></i> Cari
                        </button>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Unit</th>
                                <th>Formasi</th>
                                <th>Periode</th>
                                <th>Nilai</th>
                                <th>Verif Kabag</th>
                                <th>Verif Wadir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listPeriode as $periode)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('pegawai.show', $periode->pegawai->id) }}">
                                            {{ $periode->pegawai->nama }}
                                        </a>
                                    </td>
                                    <td>{{ $periode->pegawai->unit->name }}</td>
                                    <td>{{ $periode->pegawai->formasi->nama }}</td>
                                    <td>{{ $periode->bulan->nama }} {{ $periode->tahun }}</td>
                                    <td>{{ $periode->rataNilai() }}</td>
                                    <td>
                                        @if ($periode->verif_kabag)
                                            <span class="badge badge-primary">Terverifikasi</span> 
                                        @else
                                            <span class="badge badge-warning">Belum Diverifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($periode->verif_wadir)
                                            <span class="badge badge-primary">Terverifikasi</span>
                                        @else
                                            <span class="badge badge-warning">Belum Diverifikasi</span>
                                        @endif
                                    </td>
                                    <th>
                                        <a href="{{ route('periode.show', [ $periode->pegawai->id,  $periode->id]) }}" class="btn btn-success btn-sm">
                                            <i class="ti-view-list-alt"></i> Detail
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
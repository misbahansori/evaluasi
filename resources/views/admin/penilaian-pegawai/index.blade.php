@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @can('tambah periode')
                    <a href="{{ route('input.penilaian.index') }}" class="btn btn-success btn-sm mr-4 mb-4">
                        <i class="ti-bar-chart"></i> Tambah Penilaian Pegawai
                    </a>
                @endcan
            </div>
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>
                        Penilaian Pegawai Bulan 
                        {{ \Carbon\Carbon::createFromFormat('m', request()->bulan)->formatLocalized('%B') }} 
                        {{ request()->tahun }}
                    </h4>
                    <form action="{{ route('penilaian-pegawai.index') }}" method="GET" class="form-inline">
                        <div class="custom-control custom-checkbox mr-5">
                            <input type="checkbox" class="custom-control-input" id="terverifikasiKabag" name="terverifikasiKabag" value="true" {{ request()->terverifikasiKabag == 'true' ? 'checked' : '' }} onclick="this.form.submit()">
                            <label class="custom-control-label" for="terverifikasiKabag">Tampilkan hanya yg terverifikasi Kabag</label>
                        </div>
                        <div class="d-flex">
                            <div class="custom-control custom-radio mr-3">
                                <input type="radio" id="bulanan" name="tipe" value="bulanan" onchange="this.form.submit()" class="custom-control-input" checked>
                                <label class="custom-control-label" for="bulanan">Bulanan</label>
                            </div>
                            <div class="custom-control custom-radio mr-3">
                                <input type="radio" id="tahunan" name="tipe" value="tahunan" onchange="this.form.submit()" class="custom-control-input" {{ request('tipe') == 'tahunan' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="tahunan">Tahunan</label>
                            </div>
                        </div>

                        @if (request()->tipe == 'tahunan')
                            <select name="bulan" id="bulan" class="form-control mr-2" onchange="this.form.submit()">
                                <option {{ request()->bulan == 2 ? 'selected' : '' }} value="2">Februari</option>
                                <option {{ request()->bulan == 3 ? 'selected' : '' }} value="3">Maret</option>
                                <option {{ request()->bulan == 8 ? 'selected' : '' }} value="8">Agustus</option>
                                <option {{ request()->bulan == 12 ? 'selected' : '' }} value="12">Desember</option>
                            </select>
                        @else
                            <select name="bulan" id="bulan" class="form-control mr-2" onchange="this.form.submit()">
                                @for ($bulan = 1; $bulan <= 12; $bulan++)
                                    <option {{ request()->bulan == $bulan ? 'selected' : '' }} value="{{ $bulan }}">{{ \Carbon\Carbon::createFromFormat('m', $bulan)->formatLocalized('%B') }}</option>
                                @endfor
                            </select>
                        @endif

                        <select name="tahun" id="tahun" class="form-control mr-2" onchange="this.form.submit()">
                            @for ($i = date('Y') - 2; $i < date('Y') + 5; $i++)
                                <option {{ request()->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
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
                                    <td>{{ $periode->namaBulan}} {{ $periode->tahun }}</td>
                                    <td>{{ $periode->rataNilai() }}</td>
                                    <td>
                                        <verifikasi-component 
                                            :can-verif="{{ auth()->user()->hasPermissionTo('verif kabag') ? 'true' : 'false' }}"
                                            verifikasi="{{ $periode->verif_kabag }}" 
                                            action="{{ route('verif.kabag', $periode->id) }}"
                                        ></verifikasi-component>
                                    </td>
                                    <td>
                                        <verifikasi-component 
                                            :can-verif="{{ auth()->user()->hasPermissionTo('verif wadir') ? 'true' : 'false' }}"
                                            verifikasi="{{ $periode->verif_wadir }}" 
                                            action="{{ route('verif.wadir', $periode->id) }}"
                                        ></verifikasi-component>
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
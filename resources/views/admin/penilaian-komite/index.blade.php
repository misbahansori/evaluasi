@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                @can('tambah penilaian komite')
                    <a href="{{ route('penilaian-komite.create') }}" class="btn btn-success btn-sm mb-4">
                        <i class="ti-bar-chart-alt"></i> Tambah Penilaian Komite
                    </a>
                @endcan
            </div>
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>
                        Penilaian Komite Bulan 
                        {{ \Carbon\Carbon::createFromFormat('m', request()->bulan)->formatLocalized('%B') }} 
                        {{ request()->tahun }}
                    </h4>
                    <form action="{{ route('penilaian-komite.index') }}" method="GET" class="form-inline">
                        <div class="custom-control custom-checkbox mr-5">
                            <input type="checkbox" class="custom-control-input" id="terverifikasiKabag" name="terverifikasiKabag" value="true" {{ request()->terverifikasiKabag == 'true' ? 'checked' : '' }} onclick="this.form.submit()">
                            <label class="custom-control-label" for="terverifikasiKabag">Tampilkan hanya yg terverifikasi Kabag</label>
                        </div>

                        <select name="komite_id" id="komite_id" class="form-control mr-2" onchange="this.form.submit()">
                            <option value="all">--Semua Komite--</option>
                            @foreach ($listKomite as $komite)
                                <option value="{{ $komite->id }}" {{ request()->komite_id == $komite->id ? 'selected' : '' }}>{{ $komite->nama }}</option>
                            @endforeach
                        </select>
                        
                        <select name="bulan" id="bulan" class="form-control mr-2" onchange="this.form.submit()">
                            @for ($bulan = 1; $bulan <= 12; $bulan++)
                                <option {{ request()->bulan == $bulan ? 'selected' : '' }} value="{{ $bulan }}">{{ \Carbon\Carbon::createFromFormat('m', $bulan)->formatLocalized('%B') }}</option>
                            @endfor
                        </select>

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
                                <th>Komite</th>
                                <th>Unit</th>
                                <th>Formasi</th>
                                <th>Persentase</th>
                                @if (auth()->user()->hasRole([Role::ADMIN, Role::DIREKTUR]))                                        
                                    <th>Verif Direktur</th>
                                @endif
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
                                    <td>{{ $periode->pegawai->komite->nama }}</td>
                                    <td>{{ $periode->pegawai->unit->name }}</td>
                                    <td>{{ $periode->pegawai->formasi->nama }}</td>
                                    <td>{{ $periode->persentase() }} %</td>
                                    @if (auth()->user()->hasRole([Role::ADMIN, Role::DIREKTUR]))                                        
                                        <td>
                                            <verifikasi-component 
                                                :can-verif="{{ auth()->user()->hasPermissionTo('verif direktur') ? 'true' : 'false' }}"
                                                verifikasi="{{ $periode->verif_direktur }}" 
                                                action="{{ route('verif.direktur', $periode->id) }}"
                                            ></verifikasi-component>
                                        </td>
                                    @endif
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
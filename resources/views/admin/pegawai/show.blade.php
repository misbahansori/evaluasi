@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        @can('grafik pegawai')
            {{-- Chart js --}}
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header bg-white">
                       <div class="row">
                           <div class="col-md-6">
                               <h4>Grafik penilaian</h4>
                           </div>
                            <div class="col-md-6">
                                <form action="{{ url()->current() }}" method="GET" class="form-inline align-items-center justify-content-end">
                                    <div class="form-group">
                                        <select name="bulan_mulai" id="bulan_mulai" class="form-control{{ $errors->has('bulan_mulai') ? ' is-invalid' : '' }}">
                                            @foreach ($listBulan as $bulan)
                                                <option {{ old('bulan_mulai', date('m') - 3) == $bulan->id ? 'selected' : '' }} value="{{ $bulan->id }}">{{ $bulan->nama }}</option>
                                            @endforeach
                                        </select>
                                        <select name="tahun_mulai" class="form-control ml-1{{ $errors->has('tahun_mulai') ? ' is-invalid' : '' }}">
                                            @for ($i = $tahunIni - 2; $i < $tahunIni + 5; $i++)
                                                <option {{ old('tahun_mulai', $tahunIni) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <span class="mx-1">-</span>
                                    <div class="form-group">
                                        <select name="bulan_selesai" id="bulan_selesai" class="form-control{{ $errors->has('bulan_selesai') ? ' is-invalid' : '' }}">
                                            @foreach ($listBulan as $bulan)
                                                <option {{ old('bulan_selesai', date('m')) == $bulan->id ? 'selected' : '' }} value="{{ $bulan->id }}">{{ $bulan->nama }}</option>
                                            @endforeach
                                        </select>
                                        <select name="tahun_selesai" class="form-control ml-1{{ $errors->has('tahun_selesai') ? ' is-invalid' : '' }}">
                                            @for ($i = $tahunIni - 2; $i < $tahunIni + 5; $i++)
                                                <option {{ old('tahun_selesai', $tahunIni) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary ml-1">
                                            <i class="ti ti-filter"></i> 
                                            Filter
                                        </button>
                                    </div>
                                </form>
                            </div>
                       </div>
                    </div> --}}
                    <div class="card-body">
                        <div>{!! $chart->container() !!}</div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7">
            @include('admin.pegawai.biodata-card')
        </div>
        <div class="col-md-5">
            @include('admin.pegawai.periode-tahunan-card')
            @include('admin.pegawai.periode-card')
        </div>
        @include('admin.pegawai.tambah-periode-modal')
        @include('admin.pegawai.tambah-periode-tahunan-modal')
    </div>
@endsection

@push('js')
    <script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
    {!! $chart->script() !!}
@endpush
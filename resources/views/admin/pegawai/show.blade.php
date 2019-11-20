@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        @can('grafik pegawai')
            {{-- Chart js --}}
            <div class="col-md-12">
                <div class="card">
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
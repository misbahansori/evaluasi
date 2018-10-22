@extends('layouts.master')

@section('content')
    <div class="row">
        @can('grafik-pegawai')
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
    <div class="row">
        @include('admin.pegawai.biodata-card')
        @include('admin.pegawai.periode-card')
        @include('admin.pegawai.tambah-periode-modal')
    </div>
@endsection

@push('js')
    <script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
    {!! $chart->script() !!}
@endpush
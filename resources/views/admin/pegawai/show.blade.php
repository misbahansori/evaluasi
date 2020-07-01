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
    <div class="row">
        <div class="col-md-8">
            @include('admin.pegawai.biodata-card')
        </div>
        <div class="col-md-4">
            <div class="card">
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> 
                        <a class="nav-link active" data-toggle="tab" href="#bulanan" role="tab" aria-selected="false"><span>Bulanan</span></a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#tahunan" role="tab" aria-selected="false"><span>Tahunan</span></a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#komite" role="tab" aria-selected="true"><span>Komite</span></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="bulanan" role="tabpanel">
                        @include('admin.pegawai.periode-card')
                    </div>
                    <div class="tab-pane" id="tahunan" role="tabpanel">
                        @include('admin.pegawai.periode-tahunan-card')
                    </div>
                    <div class="tab-pane" id="komite" role="tabpanel">
                        @include('admin.pegawai.periode-komite-card')
                    </div>
                </div>
            </div>
        </div>
        @include('admin.pegawai.tambah-periode-modal')
        @include('admin.pegawai.tambah-periode-tahunan-modal')
        @include('admin.pegawai.tambah-periode-komite-modal')
    </div>
@endsection

@push('js')
    <script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
    {!! $chart->script() !!}
@endpush
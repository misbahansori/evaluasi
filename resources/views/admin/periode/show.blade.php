@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Periode Penilaian {{ $periode->bulan->nama }} {{ $periode->tahun }}</h4>
                    <div class="button-group form-inline">
                        @if (!$periode->verif_kabag)
                            @can('verif kabag')
                                <form action="{{ route('verif.kabag', $periode->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin untuk mem-verifikasi nilai?')">Verifikasi Kabag/Kabid</button>
                                </form>
                            @endcan
                        @endif
                        @if (!$periode->verif_wadir)
                            @can('verif wadir')
                                <form action="{{ route('verif.wadir', $periode->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin untuk mem-verifikasi nilai?')">Verifikasi Wakil Direktur</button>
                                </form>
                            @endcan
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.periode.pegawai-table')
                    @include('admin.periode.penilaian-form')
                </div>
            </div>
        </div>
    </div>
@endsection
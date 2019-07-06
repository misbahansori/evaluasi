@extends('layouts.master')

@section('content')
    @if ($periode->tidakBisaDiedit())
        <div class="alert badge-danger text-white fade show" role="alert" style="border-radius:0">
            <strong>Peringatan!</strong> Tidak Bisa mengisi nilai
        </div>
    @endif
    <div class="row justify-content-center">
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
                    {{-- @include('admin.periode.penilaian-form') --}}
                    
                    <form action="{{ route('nilai.update', $periode->id) }}" method="POST">
                        @csrf
                        @method('put')

                        <penilaian-form
                            :grouped="{{ $periode->nilai->groupBy('kategori')->sortKeys() }}"
                            :disabled="{{ $periode->tidakBisaDiedit() }}"
                        ></penilaian-form>

                        <div class="button-group">
                            <button type="submit" class="btn btn-success btn-block btn-lg">
                                <i class="ti-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
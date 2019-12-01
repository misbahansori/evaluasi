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
                    <h4>Periode Penilaian {{ $periode->namaBulan }} {{ $periode->tahun }}</h4>
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
                            :grouped="{{ $penilaian }}"
                            :disabled="{{ $periode->tidakBisaDiedit() ? 'true' : 'false'}}"
                        ></penilaian-form>

                        @can('catatan penilaian')
                            <div class="form-group mt-4">
                                <label for="catatan" style="font-weight: 500">Catatan</label>
                                <textarea name="catatan" id="catatan" rows="5" class="form-control" placeholder="Silahkan tulis..." {{ $periode->tidakBisaDiedit() ? 'disabled' : ''}}>{{ $periode->catatan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="ditingkatkan" style="font-weight: 500">Hal yang perlu ditingkatkan</label>
                                <textarea name="ditingkatkan" id="ditingkatkan" rows="3" class="form-control" placeholder="Silahkan tulis..." {{ $periode->tidakBisaDiedit() ? 'disabled' : ''}}>{{ $periode->ditingkatkan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="dipertahankan" style="font-weight: 500">Hal yang perlu dipertahankan</label>
                                <textarea name="dipertahankan" id="dipertahankan" rows="3" class="form-control" placeholder="Silahkan tulis..." {{ $periode->tidakBisaDiedit() ? 'disabled' : ''}}>{{ $periode->dipertahankan }}</textarea>
                            </div>
                        @endcan

                        <div class="button-group">
                            <button type="submit" class="btn btn-success btn-block btn-lg" {{ $periode->tidakBisaDiedit() ? 'disabled' : ''}}>
                                <i class="ti-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
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

                    @can('catatan penilaian')
                        <div class="float-right mb-3">
                            <button type="button" class="btn btn-primary d-block" data-toggle="modal" data-target="#catatanModal">
                                <i class="ti ti-pencil"></i> Tambah Catatan Penilaian
                            </button>
                        </div>
                    @endcan

                    <form class="mb-5" action="{{ route('nilai.update', $periode->id) }}" method="POST">
                        @csrf
                        @method('put')

                        @if ($periode->tipe === App\Domain\Penilaian\Models\Periode::PENILAIAN_KOMITE)
                            <penilaian-komite-form
                                :grouped="{{ $penilaian }}"
                                :disabled="{{ $periode->tidakBisaDiedit() ? 'true' : 'false'}}"
                            ></penilaian-komite-form>
                        @else
                            <penilaian-form
                                :grouped="{{ $penilaian }}"
                                :disabled="{{ $periode->tidakBisaDiedit() ? 'true' : 'false'}}"
                            ></penilaian-form>
                        @endif

                        <div class="button-group mt-3">
                            <button type="submit" class="btn btn-success btn-block btn-lg" {{ $periode->tidakBisaDiedit() ? 'disabled' : ''}}>
                                <i class="ti-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                    @foreach ($periode->catatan as $catatan)
                        <div class="ml-3 d-flex justify-content-between">
                            <div>
                                <h5>{{ $catatan->tipe }}</h5>
                                <p class="mb-1">{{ $catatan->isi }} <span class="font-italic">({{ $catatan->user->name }})</span></p>
                            </div>
                            <div>
                                @can('delete', $catatan)
                                    <form action="{{ route('catatan.destroy', [$periode, $catatan]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin akan menghapus catatan?')">
                                            <span class="ti-trash"></span>
                                        </button>
                                    </form> 
                                @endcan
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    @include('admin.periode.tambah-catatan-modal')
                </div>
            </div>
        </div>
    </div>
@endsection
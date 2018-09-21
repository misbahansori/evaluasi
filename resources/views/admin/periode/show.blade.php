@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Periode Penilaian {{ $periode->bulan->nama }} {{ $periode->tahun }}</h4>
                    <div class="button-group form-inline">
                        @can('verif kabag')
                            <form action="{{ route('verif.kabag', $periode->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Verifikasi Kabag/Kabid</button>
                            </form>
                        @endcan
                        @can('verif wadir')
                            <form action="{{ route('verif.wadir', $periode->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Verifikasi Wakil Direktur</button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>NBM</td>
                            <td>:</td>
                            <td>{{ $pegawai->nbm }}</td>

                            <td>Verifikasi Kabag / Kabid</td>
                            <td>:</td>
                            <td>
                                @if ($periode->verif_kabag)
                                    <span class="badge badge-primary">Terverifikasi</span> 
                                    <br>
                                    <small>{{ $periode->verif_kabag->formatLocalized('%A, %d %B %Y') }}</small>
                                @else
                                    <span class="badge badge-warning">Belum Diverifikasi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $pegawai->nama }}</td>

                            <td>Verifikasi Wakil Direktur</td>
                            <td>:</td>
                            <td>
                                @if ($periode->verif_wadir)
                                    <span class="badge badge-primary">Terverifikasi</span>
                                    <br>
                                    <small>{{ $periode->verif_wadir->formatLocalized('%A, %d %B %Y') }}</small>
                                @else
                                    <span class="badge badge-warning">Belum Diverifikasi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Unit</td>
                            <td>:</td>
                            <td>{{ optional($periode->pegawai->unit)->nama }}</td>
                        </tr>
                        <tr>
                            <td>Bagian</td>
                            <td>:</td>
                            <td>{{ optional($pegawai->bagian)->nama }}</td>
                        </tr>
                    </table>
                    <form action="{{ route('nilai.update') }}" method="POST">
                        @csrf
                        @method('put')
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle">No</th>
                                    <th rowspan="2" style="vertical-align: middle">Aspek Penilaian</th>
                                    <th colspan="5" style="text-align: center">Nilai</th>
                                </tr>
                                <tr>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($periode->nilai->groupBy('kategori')->sortKeys() as $grouped)
                                    
                                    <tr>
                                        <th colspan="9"> {{ $grouped->first()->kategori }}</th>
                                    </tr>
                                    @foreach ($grouped as $nilai)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nilai->aspek }}</td>
                                            <td style="width: 50px;">
                                                <input type="radio" name="{{ $nilai->id }}" id="{{ $nilai->id }}" value="1" {{ $nilai->nilai == 1 ? 'checked=checked' : '' }}>
                                            </td>
                                            <td style="width: 50px;">
                                                <input type="radio" name="{{ $nilai->id }}" id="{{ $nilai->id }}" value="2" {{ $nilai->nilai == 2 ? 'checked=checked' : '' }}>
                                            </td>
                                            <td style="width: 50px;">
                                                <input type="radio" name="{{ $nilai->id }}" id="{{ $nilai->id }}" value="3" {{ $nilai->nilai == 3 ? 'checked=checked' : '' }}>
                                            </td>
                                            <td style="width: 50px;">
                                                <input type="radio" name="{{ $nilai->id }}" id="{{ $nilai->id }}" value="4" {{ $nilai->nilai == 4 ? 'checked=checked' : '' }}>
                                            </td>
                                            <td style="width: 50px;">
                                                <input type="radio" name="{{ $nilai->id }}" id="{{ $nilai->id }}" value="5" {{ $nilai->nilai == 5 ? 'checked=checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr>
                                    <td colspan="2">Total Nilai</td>
                                    <td colspan="6">{{ $periode->totalNilai() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Rata-rata Nilai</td>
                                    <td colspan="6">{{ $periode->rataNilai() }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Element Penilaian</td>
                                    <td colspan="6">{{ $periode->nilai->count() }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="button-group">
                            <button type="submit" class="btn btn-success btn-block btn-lg">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Biodata Pegawai</h4>
                </div>

                <div class="card-body">
                    <table class="table">
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>{{ $pegawai->nik }}</td>
                    </tr>
                    <tr>
                        <td>NBM</td>
                        <td>:</td>
                        <td>{{ $pegawai->nbm }}</td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td>{{ $pegawai->nama }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $pegawai->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $pegawai->alamat }}</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>{{ $pegawai->kecamatan }}</td>
                    </tr>
                    <tr>
                        <td>Kabupaten / Kota</td>
                        <td>:</td>
                        <td>{{ $pegawai->kabupaten }}</td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>:</td>
                        <td>{{ $pegawai->provinsi }}</td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td>{{ $pegawai->no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Formasi</td>
                        <td>:</td>
                        <td>{{ optional($pegawai->formasi)->nama }}</td>
                    </tr>
                    <tr>
                        <td>Unit</td>
                        <td>:</td>
                        <td>{{ optional($pegawai->unit)->nama }}</td>
                    </tr>
                    <tr>
                        <td>Bagian</td>
                        <td>:</td>
                        <td>{{ optional($pegawai->bagian)->nama }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Masuk</td>
                        <td>:</td>
                        <td>{{ $pegawai->tanggal_masuk }}</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Penilaian</h5>
                    @can('tambah periode')
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <i class="ti ti-pencil"></i> Tambah Penilaian
                        </button>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table">
                        @forelse ($pegawai->periode as $periode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $periode->bulan->nama }} {{ $periode->tahun }}</td>
                                <td>
                                    <form action="{{ route('periode.destroy', [$pegawai->id, $periode->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('periode.show', [$pegawai->id, $periode->id]) }}" class="btn btn-success btn-sm">
                                            <i class="ti-view-list-alt"></i> Detail
                                        </a>
                                        @can('hapus periode')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus')">
                                                <i class="ti-trash"></i> Hapus
                                            </button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center"><i>Belum ada data</i></td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog" role="document">
                <form action="{{ route('periode.store', $pegawai->id) }}" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Penilaian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label for="bulan" class="col-sm-4 col-form-label text-md-right">Bulan</label>
                            <div class="col-md-6">
                                <select name="bulan" id="bulan" class="form-control{{ $errors->has('bulan') ? ' is-invalid' : '' }}">
                                    @foreach ($listBulan as $bulan)
                                        <option {{ old('bulan') == $bulan->id ? 'selected' : '' }} value="{{ $bulan->id }}">{{ $bulan->nama }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bulan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bulan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun" class="col-sm-4 col-form-label text-md-right">Tahun</label>
                            <div class="col-md-6">
                                <select name="tahun" id="tahun" class="form-control{{ $errors->has('tahun') ? ' is-invalid' : '' }}">
                                    @for ($i = $year - 2; $i < $year + 5; $i++)
                                        <option {{ old('tahun', $year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('tahun'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tahun') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@if(Session::has('errors'))
    @push('js')
        <script>
            $(document).ready(function(){
                $('#exampleModal').modal({show: true});
            });
        </script>
    @endpush
@endif
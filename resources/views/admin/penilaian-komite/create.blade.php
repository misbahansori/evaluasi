@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('penilaian-komite.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert badge-danger text-white alert-dismissible fade show" role="alert" style="border-radius:0">
                            <strong>Peringatan!</strong> {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif

                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between form-inline">
                        <h4>Silahkan pilih Pegawai</h4>
                        <div class="d-flex align-items-center">
                            
                            <select name="bulan" id="bulan" class="form-control mr-2">
                                @for ($bulan = 1; $bulan <= 12; $bulan++)
                                    <option {{ date('m', strtotime("-1 month")) == $bulan ? 'selected' : '' }} value="{{ $bulan }}">{{ \Carbon\Carbon::createFromFormat('m', $bulan)->formatLocalized('%B') }}</option>
                                @endfor
                            </select>
                            
                            <select name="tahun" id="tahun" class="form-control mr-2">
                                @for ($i = date('Y') - 2; $i < date('Y') + 5; $i++)
                                    <option {{ date('Y') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Komite</th>
                                    <th>Unit</th>
                                    <th>Bagian</th>
                                    <th>Formasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPegawai as $pegawai)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{ $pegawai->id }}" name="pegawai[]" value="{{ $pegawai->id }}">
                                                <label class="custom-control-label" for="{{ $pegawai->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $pegawai->nama }}</td>
                                        <td>{{ optional($pegawai->komite)->nama }}</td>
                                        <td>{{ optional($pegawai->unit)->name }}</td>
                                        <td>{{ optional($pegawai->bagian)->nama }}</td>
                                        <td>{{ optional($pegawai->formasi)->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Tambah Penilaian</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@include('includes.datatable', ['page' => 25])

@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <form action="{{ route('input.penilaian.store') }}" method="POST">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between form-inline">
                        <h4>Silahkan pilih Pegawai</h4>
                        <div>
                            <select name="bulan" id="bulan" class="form-control mr-2">
                                @foreach ($listBulan as $bulan)
                                    <option {{ date('m') == $bulan->id ? 'selected' : '' }} value="{{ $bulan->id }}">{{ $bulan->nama }}</option>
                                @endforeach
                            </select>
                            <select name="tahun" id="tahun" class="form-control mr-2">
                                @for ($i = $tahunIni - 2; $i < $tahunIni + 5; $i++)
                                    <option {{ $tahunIni == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Unit</th>
                                    <th>Bagian</th>
                                    <th>Formasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPegawai as $pegawai)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{ $pegawai->id }}" name="{{ $pegawai->id }}" value="{{ $pegawai->id }}">
                                                <label class="custom-control-label" for="{{ $pegawai->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('pegawai.show', $pegawai->id) }}">
                                                {{ $pegawai->nama }}
                                            </a>
                                        </td>
                                        <td>{{ optional($pegawai->unit)->name }}</td>
                                        <td>{{ optional($pegawai->bagian)->nama }}</td>
                                        <td>{{ optional($pegawai->formasi)->nama }}</td>
                                        <td>{{ optional($pegawai->status)->nama }}</td>
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

@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">

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
                    <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center">
                        <div class="d-flex">
                            <div class="custom-control custom-radio mr-3">
                                <input type="radio" id="bulanan" name="tipe" value="bulanan" class="custom-control-input" checked onchange="this.form.submit()">
                                <label class="custom-control-label" for="bulanan">Bulanan</label>
                            </div>
                            <div class="custom-control custom-radio mr-3">
                                <input type="radio" id="tahunan" name="tipe" value="tahunan" class="custom-control-input" {{ request()->tipe == 'tahunan' ? 'checked' : '' }} onchange="this.form.submit()">
                                <label class="custom-control-label" for="tahunan">Tahunan</label>
                            </div>
                        </div>
                        
                        <select name="bulan" id="bulan" class="form-control mr-2" onchange="this.form.submit()">
                            @for ($bulan = 1; $bulan <= 12; $bulan++)
                                <option {{ request()->bulan == $bulan ? 'selected' : '' }} value="{{ $bulan }}">{{ \Carbon\Carbon::createFromFormat('m', $bulan)->formatLocalized('%B') }}</option>
                            @endfor
                        </select>
                        
                        <select name="tahun" id="tahun" class="form-control mr-2" onchange="this.form.submit()">
                            @for ($i = date('Y') - 2; $i < date('Y') + 5; $i++)
                                <option {{ request()->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </form>
                </div>
                <div class="card-body">
                    <form action="{{ route('penilaian-pegawai.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="bulan" value="{{ request()->bulan }}">
                        <input type="hidden" name="tahun" value="{{ request()->tahun }}">
                        <input type="hidden" name="tipe" value="{{ request()->tipe }}">
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
                                                <input type="checkbox" class="custom-control-input" id="{{ $pegawai->id }}" name="pegawai[]" value="{{ $pegawai->id }}">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('includes.datatable', ['page' => 25])

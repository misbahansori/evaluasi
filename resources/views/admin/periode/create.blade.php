@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Periode Penilaian</div>

                <div class="card-body">
                    <form action="{{ route('periode.store', $pegawai->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="bulan" class="col-sm-4 col-form-label text-md-right">Bulan</label>
                            <div class="col-md-6">
                                <select name="bulan" id="bulan" class="form-control{{ $errors->has('bulan') ? ' is-invalid' : '' }}">
                                    <option value="">Silahkan pilih...</option>
                                    @foreach ($listBulan as $bulan)
                                        <option {{ old('bulan') == $bulan->id }} value="{{ $bulan->id }}">{{ $bulan->nama }}</option>
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

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary ">Simpan</button>
                            </div>
                        </div>
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

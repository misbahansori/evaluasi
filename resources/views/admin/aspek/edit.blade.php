@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Edit Data Aspek</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('aspek.update', $aspek->id) }}" class="form" method="POST">
                        @csrf
                        @method('put')
                        
                        <div class="form-group row">
                            <label for="bagian_id" class="col-sm-4 col-form-label text-md-right">Bagian</label>
                            <div class="col-md-6">
                                <select name="bagian_id" id="bagian_id" class="form-control{{ $errors->has('bagian_id') ? ' is-invalid' : '' }}">
                                    @foreach ($listBagian as $bagian)
                                        <option {{ old('bagian_id', $aspek->bagian_id) == $bagian->id ? 'selected' : '' }} value="{{ $bagian->id }}">{{ $bagian->nama }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bagian_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bagian_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label text-md-right">Nama Aspek Penilaian</label>

                            <div class="col-md-6">
                                <textarea id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" rows="3" required autofocus>{{ old('nama', $aspek->nama) }}</textarea>

                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-sm-4 col-form-label text-md-right">Kategori</label>
                            <div class="col-md-6">
                                <select name="kategori" id="kategori" class="form-control{{ $errors->has('kategori') ? ' is-invalid' : '' }}">
                                    <option {{ old('kategori', $aspek->kategori) == 'Profesi'? 'selected' : '' }}>Profesi</option>
                                    <option {{ old('kategori', $aspek->kategori) == 'Prestasi Kerja'? 'selected' : '' }}>Prestasi Kerja</option>
                                    <option {{ old('kategori', $aspek->kategori) == 'Sikap Kerja'? 'selected' : '' }}>Sikap Kerja</option>
                                </select>
                                @if ($errors->has('kategori'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kategori') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipe" class="col-sm-4 col-form-label text-md-right">Tipe</label>
                            <div class="col-md-6">
                                <div class="d-flex mt-2">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="bulanan" name="tipe" value="bulanan" class="custom-control-input" {{ old('tipe', $aspek->tipe) == 'bulanan' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="bulanan">Bulanan</label>
                                    </div>
                                    <div class="custom-control custom-radio ml-2">
                                        <input type="radio" id="tahunan" name="tipe" value="tahunan" class="custom-control-input" {{ old('tipe', $aspek->tipe) == 'tahunan' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="tahunan">Tahunan</label>
                                    </div>
                                </div>
                                @if ($errors->has('tipe'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipe') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

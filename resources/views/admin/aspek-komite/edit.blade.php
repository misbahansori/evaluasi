@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Edit Data Aspek Komite</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('aspek-komite.update', $aspekKomite) }}" class="form" method="POST">
                        @csrf
                        @method('put')
                        
                        <div class="form-group row">
                            <label for="komite_id" class="col-sm-4 col-form-label text-md-right">Komite</label>
                            <div class="col-md-6">
                                <select name="komite_id" id="komite_id" class="form-control{{ $errors->has('komite_id') ? ' is-invalid' : '' }}">
                                    @foreach ($listKomite as $komite)
                                        <option {{ old('komite_id', $aspekKomite->komite_id) == $komite->id ? 'selected' : '' }} value="{{ $komite->id }}">{{ $komite->nama }}</option>
                                    @endforeach
                                </select>
                                @error('komite_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label text-md-right">Nama Aspek Komite</label>

                            <div class="col-md-6">
                                <textarea id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" rows="3" required autofocus>{{ old('nama', $aspekKomite->nama) }}</textarea>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kategori" class="col-sm-4 col-form-label text-md-right">Kategori</label>
                            <div class="col-md-6">
                                <input id="kategori" type="text" class="form-control{{ $errors->has('kategori') ? ' is-invalid' : '' }}" name="kategori" value="{{ old('kategori', $aspekKomite->kategori) }}" required placeholder="Ketikan kategori">

                                @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
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

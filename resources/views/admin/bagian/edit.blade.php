@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Edit Bagian</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('bagian.update', $bagian) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name" class="">Nama Bagian</label>

                            <input id="name" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama', $bagian->nama) }}" required autofocus>

                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

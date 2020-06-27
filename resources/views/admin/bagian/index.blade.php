@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Daftar Bagian</h4>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#komiteModal">
                        <i class="ti ti-pencil"></i> Tambah Bagian
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:20px">No</th>
                                <th>Nama Bagian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listBagian as $bagian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-flex justify-content-between">
                                        {{ $bagian->nama }}
                                        <form action="{{ route('bagian.destroy', $bagian) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <a href="{{ route('bagian.edit', $bagian) }}" class="btn btn-info btn-sm">
                                                <i class="ti ti-pencil-alt"></i> Edit
                                            </a>
                                            
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus?');">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal Tambah Group/Unit -->
        <div class="modal fade" id="komiteModal" tabindex="-1" role="dialog" aria-labelledby="komiteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('bagian.store') }}" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="komiteModalLabel">Tambahkan Bagian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="">Nama Bagian</label>    
                            <input id="name" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required placeholder="Tuliskan nama komite">
                            @error ('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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

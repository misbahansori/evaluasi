@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Data User</h4>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Group/Bagian</h4>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#roleModal">
                        <i class="ti ti-plus"></i> Tambah Group
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th>Nama Group</th>
                                <th style="width:10px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user->roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <form action="{{ route('user.role.destroy', [$user->id, $role->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>  
                            @empty
                                <tr>
                                    <td colspan="3">Tidak ada Grup untuk user ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Hak Akses</h4>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#permissionModal">
                        <i class="ti ti-plus"></i> Tambah Hak Akses
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th>Nama Hak Akses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->getAllPermissions()->diff($user->getDirectPermissions()) as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td></td>
                                </tr>  
                            @endforeach
                            @foreach ($user->getDirectPermissions() as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <form action="{{ route('user.permission.destroy', [$user->id, $permission->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">
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
    </div>
    <!-- Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('user.role.store', $user->id) }}" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleModalLabel">Tambahkan Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="role" class="">Silahkan pilih Group</label>
                        <select class="form-control select2{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role[]" multiple="multiple">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
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
    <!-- Modal -->
    <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('user.permission.store', $user->id) }}" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionModalLabel">Tambahkan Hak Akses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="permission" class="">Silahkan pilih Hak Akses</label>
                        <select class="form-control select2{{ $errors->has('permission') ? ' is-invalid' : '' }}" name="permission[]" multiple="multiple">
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('permission'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('permission') }}</strong>
                            </span>
                        @endif
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
@endsection

@include('includes.select2')
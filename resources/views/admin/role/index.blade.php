@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Daftar Group/Unit</h4>
                    <a href="/master/group/create" class="btn btn-primary btn-sm">
                        <i class="ti ti-pencil"></i> Tambah Group
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:20px">No</th>
                                <th>Nama Group</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr {{ optional($selectedRole)->id == $role->id ? 'class=table-active' : ''}} onclick="window.location.href='{{ route('role.index', ['role' => $role->id]) }}'">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('role.index', ['role' => $role->id]) }}">{{ $role->name }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if ($selectedRole)
            <div class="col-md-6" >
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between">
                        <h4>Hak Akses {{ $selectedRole->name }}</h4>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <i class="ti ti-pencil"></i> Tambah Hak Akses
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width:20px">No</th>
                                <th>Hak Akses</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($selectedRole->permissions as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td style="width:20px;">
                                        <form action="{{ route('role.permission.destroy', [$selectedRole->id, $permission->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('role.permission.store', $selectedRole->id) }}" method="POST" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambahkan Group</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <select class="form-control mr-2" name="permission_id">
                                <option value="" selected disabled>--- Silahkan pilih hak akses ---</option>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
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
        @endif
    </div>
@endsection

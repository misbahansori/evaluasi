@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Daftar User</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-pencil"></i> Tambah User
                    </a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Group/Bagian</th>
                                <th>Hak Akses</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->getRoleNames() as $role)
                                            <span class="badge badge-primary">{{ $role }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($user->getAllPermissions() as $permission)
                                            <span class="badge badge-cyan">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <th>
                                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-success btn-sm">
                                            <i class="ti ti-write"></i> Detail
                                        </a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">
                                            <i class="ti ti-pencil-alt"></i> Edit
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

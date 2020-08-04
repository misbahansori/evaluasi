@extends('layouts.master')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Daftar User</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-pencil"></i> Tambah User
                    </a>
                </div>

                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <th class="d-flex">
                                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-success btn-sm">
                                            <i class="ti ti-write"></i> Detail
                                        </a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm ml-1">
                                            <i class="ti ti-pencil-alt"></i> Edit
                                        </a>
                                        <form action="{{ route('user.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm ml-1">Hapus</button>
                                        </form>
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

@include('includes.datatable')


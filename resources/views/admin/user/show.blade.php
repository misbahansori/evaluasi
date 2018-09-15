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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Group/Bagian</h4>
                </div>
                <div class="card-body">
                    @forelse ($user->getRoleNames() as $role)
                        <span class="badge badge-primary">{{ $role->name }}</span>
                    @empty
                        <i>Tidak ada bagian</i>
                    @endforelse
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white">
                    <h4>Hak Akses</h4>
                </div>
                <div class="card-body">
                    @forelse ($user->getAllPermissions() as $permision)
                        <span class="badge badge-primary">{{ $permision->name }}</span>
                    @empty
                        <i>Tidak ada bagian</i>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

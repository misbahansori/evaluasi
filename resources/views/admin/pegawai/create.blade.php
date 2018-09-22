@extends('layouts.master')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Tambah Data Pegawai</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('pegawai.store') }}" method="POST">
                        @csrf
                        @include('admin.pegawai.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
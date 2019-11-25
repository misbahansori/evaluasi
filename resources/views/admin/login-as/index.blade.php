@extends('layouts.master')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Daftar User</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('login-as.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Please select User</label>
                            <select name="user_id" id="user_id" class="form-control select2">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('includes.select2')
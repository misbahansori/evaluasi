@extends('layouts.master')

@section('content')
    <roles-component :roles="{{ json_encode($roles) }}" :permissions="{{ json_encode($permissions) }}"></roles-component>
@endsection

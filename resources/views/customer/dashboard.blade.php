@extends('layouts.app')

@section('content')
    <h1>Customer Dashboard</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
@endsection
